<?php
/**
 * Abstract minifier class
 *
 * Please report bugs on https://github.com/matthiasmullie/minify/issues
 *
 * @author Matthias Mullie <minify@mullie.eu>
 * @copyright Copyright (c) 2012, Matthias Mullie. All rights reserved
 * @license MIT License
 */

use Psr\Cache\CacheItemInterface;

/**
 * Abstract minifier class.
 *
 * Please report bugs on https://github.com/matthiasmullie/minify/issues
 *
 * @package Minify
 * @author Matthias Mullie <minify@mullie.eu>
 * @copyright Copyright (c) 2012, Matthias Mullie. All rights reserved
 * @license MIT License
 */
abstract class Minify
{
    /**
     * The data to be minified.
     *
     * @var string[]
     */
    protected $data = array();

    /**
     * Array of patterns to match.
     *
     * @var string[]
     */
    protected $patterns = array();

    /**
     * This array will hold content of strings and regular expressions that have
     * been extracted from the JS source code, so we can reliably match "code",
     * without having to worry about potential "code-like" characters inside.
     *
     * @var string[]
     */
    public $extracted = array();

    /**
     * Init the minify class - optionally, code may be passed along already.
     */
    public function __construct(/* $data = null, ... */)
    {
        // it's possible to add the source through the constructor as well ;)
        if (func_num_args()) {
            call_user_func_array(array($this, 'add'), func_get_args());
        }
    }

    /**
     * Add a file or straight-up code to be minified.
     *
     * @param string|string[] $data
     *
     * @return static
     */
    public function add($data /* $data = null, ... */)
    {
        // bogus "usage" of parameter $data: scrutinizer warns this variable is
        // not used (we're using func_get_args instead to support overloading),
        // but it still needs to be defined because it makes no sense to have
        // this function without argument :)
        $args = array($data) + func_get_args();

        // this method can be overloaded
        foreach ($args as $data) {
            if (is_array($data)) {
                call_user_func_array(array($this, 'add'), $data);
                continue;
            }

            // redefine var
            $data = (string) $data;

            // load data
            $value = $this->load($data);
            $key = ($data != $value) ? $data : count($this->data);

            // replace CR linefeeds etc.
            // @see https://github.com/matthiasmullie/minify/pull/139
            $value = str_replace(array("\r\n", "\r"), "\n", $value);

            // store data
            $this->data[$key] = $value;
        }

        return $this;
    }

    /**
     * Add a file to be minified.
     *
     * @param string|string[] $data
     *
     * @return static
     *
     * @throws Exception
     */
    public function addFile($data /* $data = null, ... */)
    {
        // bogus "usage" of parameter $data: scrutinizer warns this variable is
        // not used (we're using func_get_args instead to support overloading),
        // but it still needs to be defined because it makes no sense to have
        // this function without argument :)
        $args = array($data) + func_get_args();

        // this method can be overloaded
        foreach ($args as $path) {
            if (is_array($path)) {
                call_user_func_array(array($this, 'addFile'), $path);
                continue;
            }

            // redefine var
            $path = (string) $path;

            // check if we can read the file
            if (!$this->canImportFile($path)) {
                throw new Exception('The file "'.$path.'" could not be opened for reading. Check if PHP has enough permissions.');
            }

            $this->add($path);
        }

        return $this;
    }

    /**
     * Minify the data & (optionally) saves it to a file.
     *
     * @param string[optional] $path Path to write the data to
     *
     * @return string The minified data
     */
    public function minify($path = null)
    {
        $content = $this->execute($path);

        // save to path
        if ($path !== null) {
            $this->save($content, $path);
        }

        return $content;
    }

    /**
     * Minify & gzip the data & (optionally) saves it to a file.
     *
     * @param string[optional] $path  Path to write the data to
     * @param int[optional]    $level Compression level, from 0 to 9
     *
     * @return string The minified & gzipped data
     */
    public function gzip($path = null, $level = 9)
    {
        $content = $this->execute($path);
        $content = gzencode($content, $level, FORCE_GZIP);

        // save to path
        if ($path !== null) {
            $this->save($content, $path);
        }

        return $content;
    }

    /**
     * Minify the data & write it to a CacheItemInterface object.
     *
     * @param CacheItemInterface $item Cache item to write the data to
     *
     * @return CacheItemInterface Cache item with the minifier data
     */
    public function cache(CacheItemInterface $item)
    {
        $content = $this->execute();
        $item->set($content);

        return $item;
    }

    /**
     * Minify the data.
     *
     * @param string[optional] $path Path to write the data to
     *
     * @return string The minified data
     */
    abstract public function execute($path = null);

    /**
     * Load data.
     *
     * @param string $data Either a path to a file or the content itself
     *
     * @return string
     */
    protected function load($data)
    {
        // check if the data is a file
        if ($this->canImportFile($data)) {
            $data = file_get_contents($data);

            // strip BOM, if any
            if (substr($data, 0, 3) == "\xef\xbb\xbf") {
                $data = substr($data, 3);
            }
        }

        return $data;
    }

    /**
     * Save to file.
     *
     * @param string $content The minified data
     * @param string $path    The path to save the minified data to
     *
     * @throws Exception
     */
    protected function save($content, $path)
    {
        $handler = $this->openFileForWriting($path);

        $this->writeToFile($handler, $content);

        @fclose($handler);
    }

    /**
     * Register a pattern to execute against the source content.
     *
     * If $replacement is a string, it must be plain text. Placeholders like $1 or \2 don't work.
     * If you need that functionality, use a callback instead.
     *
     * @param string          $pattern     PCRE pattern
     * @param string|callable $replacement Replacement value for matched pattern
     */
    protected function registerPattern($pattern, $replacement = '')
    {
        // study the pattern, we'll execute it more than once
        $pattern .= 'S';

        $this->patterns[] = array($pattern, $replacement);
    }

    /**
     * We can't "just" run some regular expressions against JavaScript: it's a
     * complex language. E.g. having an occurrence of // xyz would be a comment,
     * unless it's used within a string. Of you could have something that looks
     * like a 'string', but inside a comment.
     * The only way to accurately replace these pieces is to traverse the JS one
     * character at a time and try to find whatever starts first.
     *
     * @param string $content The content to replace patterns in
     *
     * @return string The (manipulated) content
     */
    protected function replace($content)
    {
        $contentLength = strlen($content);
        $output = '';
        $processedOffset = 0;
        $positions = array_fill(0, count($this->patterns), -1);
        $matches = array();

        while ($processedOffset < $contentLength) {
            // find first match for all patterns
            foreach ($this->patterns as $i => $pattern) {
                list($pattern, $replacement) = $pattern;

                // we can safely ignore patterns for positions we've unset earlier,
                // because we know these won't show up anymore
                if (array_key_exists($i, $positions) == false) {
                    continue;
                }

                // no need to re-run matches that are still in the part of the
                // content that hasn't been processed
                if ($positions[$i] >= $processedOffset) {
                    continue;
                }

                $match = null;
                if (preg_match($pattern, $content, $match, PREG_OFFSET_CAPTURE, $processedOffset)) {
                    $matches[$i] = $match;

                    // we'll store the match position as well; that way, we
                    // don't have to redo all preg_matches after changing only
                    // the first (we'll still know where those others are)
                    $positions[$i] = $match[0][1];
                } else {
                    // if the pattern couldn't be matched, there's no point in
                    // executing it again in later runs on this same content;
                    // ignore this one until we reach end of content
                    unset($matches[$i], $positions[$i]);
                }
            }

            // no more matches to find: everything's been processed, break out
            if (!$matches) {
                // output the remaining content
                $output .= substr($content, $processedOffset);
                break;
            }

            // see which of the patterns actually found the first thing (we'll
            // only want to execute that one, since we're unsure if what the
            // other found was not inside what the first found)
            $matchOffset = min($positions);
            $firstPattern = array_search($matchOffset, $positions);
            $match = $matches[$firstPattern];

            // execute the pattern that matches earliest in the content string
            list(, $replacement) = $this->patterns[$firstPattern];

            // add the part of the input between $processedOffset and the first match;
            // that content wasn't matched by anything
            $output .= substr($content, $processedOffset, $matchOffset - $processedOffset);
            // add the replacement for the match
            $output .= $this->executeReplacement($replacement, $match);
            // advance $processedOffset past the match
            $processedOffset = $matchOffset + strlen($match[0][0]);
        }

        return $output;
    }

    /**
     * If $replacement is a callback, execute it, passing in the match data.
     * If it's a string, just pass it through.
     *
     * @param string|callable $replacement Replacement value
     * @param array           $match       Match data, in PREG_OFFSET_CAPTURE form
     *
     * @return string
     */
    protected function executeReplacement($replacement, $match)
    {
        if (!is_callable($replacement)) {
            return $replacement;
        }
        // convert $match from the PREG_OFFSET_CAPTURE form to the form the callback expects
        foreach ($match as &$matchItem) {
            $matchItem = $matchItem[0];
        }
        return $replacement($match);
    }

    /**
     * Strings are a pattern we need to match, in order to ignore potential
     * code-like content inside them, but we just want all of the string
     * content to remain untouched.
     *
     * This method will replace all string content with simple STRING#
     * placeholder text, so we've rid all strings from characters that may be
     * misinterpreted. Original string content will be saved in $this->extracted
     * and after doing all other minifying, we can restore the original content
     * via restoreStrings().
     *
     * @param string[optional] $chars
     * @param string[optional] $placeholderPrefix
     */
    protected function extractStrings($chars = '\'"', $placeholderPrefix = '')
    {
        // PHP only supports $this inside anonymous functions since 5.4
        $minifier = $this;
        $callback = function ($match) use ($minifier, $placeholderPrefix) {
            // check the second index here, because the first always contains a quote
            if ($match[2] === '') {
                /*
                 * Empty strings need no placeholder; they can't be confused for
                 * anything else anyway.
                 * But we still needed to match them, for the extraction routine
                 * to skip over this particular string.
                 */
                return $match[0];
            }

            $count = count($minifier->extracted);
            $placeholder = $match[1].$placeholderPrefix.$count.$match[1];
            $minifier->extracted[$placeholder] = $match[1].$match[2].$match[1];

            return $placeholder;
        };

        /*
         * The \\ messiness explained:
         * * Don't count ' or " as end-of-string if it's escaped (has backslash
         * in front of it)
         * * Unless... that backslash itself is escaped (another leading slash),
         * in which case it's no longer escaping the ' or "
         * * So there can be either no backslash, or an even number
         * * multiply all of that times 4, to account for the escaping that has
         * to be done to pass the backslash into the PHP string without it being
         * considered as escape-char (times 2) and to get it in the regex,
         * escaped (times 2)
         */
        $this->registerPattern('/(['.$chars.'])(.*?(?<!\\\\)(\\\\\\\\)*+)\\1/s', $callback);
    }

    /**
     * This method will restore all extracted data (strings, regexes) that were
     * replaced with placeholder text in extract*(). The original content was
     * saved in $this->extracted.
     *
     * @param string $content
     *
     * @return string
     */
    protected function restoreExtractedData($content)
    {
        if (!$this->extracted) {
            // nothing was extracted, nothing to restore
            return $content;
        }

        $content = strtr($content, $this->extracted);

        $this->extracted = array();

        return $content;
    }

    /**
     * Check if the path is a regular file and can be read.
     *
     * @param string $path
     *
     * @return bool
     */
    protected function canImportFile($path)
    {
        $parsed = parse_url($path);
        if (
            // file is elsewhere
            isset($parsed['host']) ||
            // file responds to queries (may change, or need to bypass cache)
            isset($parsed['query'])
        ) {
            return false;
        }

        return strlen($path) < PHP_MAXPATHLEN && @is_file($path) && is_readable($path);
    }

    /**
     * Attempts to open file specified by $path for writing.
     *
     * @param string $path The path to the file
     *
     * @return resource Specifier for the target file
     *
     * @throws Exception
     */
    protected function openFileForWriting($path)
    {
        if ($path === '' || ($handler = @fopen($path, 'w')) === false) {
            throw new Exception('The file "'.$path.'" could not be opened for writing. Check if PHP has enough permissions.');
        }

        return $handler;
    }

    /**
     * Attempts to write $content to the file specified by $handler. $path is used for printing exceptions.
     *
     * @param resource $handler The resource to write to
     * @param string   $content The content to write
     * @param string   $path    The path to the file (for exception printing only)
     *
     * @throws Exception
     */
    protected function writeToFile($handler, $content, $path = '')
    {
        if (
            !is_resource($handler) ||
            ($result = @fwrite($handler, $content)) === false ||
            ($result < strlen($content))
        ) {
            throw new Exception('The file "'.$path.'" could not be written to. Check your disk space and file permissions.');
        }
    }
}
class Converter {
    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $to;

    /**
     * @param string $from The original base path (directory, not file!)
     * @param string $to   The new base path (directory, not file!)
     * @param string $root Root directory (defaults to `getcwd`)
     */
    public function __construct($from, $to, $root = '')
    {
        $shared = $this->shared($from, $to);
        if ($shared === '') {
            // when both paths have nothing in common, one of them is probably
            // absolute while the other is relative
            $root = $root ?: getcwd();
            $from = strpos($from, $root) === 0 ? $from : preg_replace('/\/+/', '/', $root.'/'.$from);
            $to = strpos($to, $root) === 0 ? $to : preg_replace('/\/+/', '/', $root.'/'.$to);

            // or traveling the tree via `..`
            // attempt to resolve path, or assume it's fine if it doesn't exist
            $from = @realpath($from) ?: $from;
            $to = @realpath($to) ?: $to;
        }

        $from = $this->dirname($from);
        $to = $this->dirname($to);

        $from = $this->normalize($from);
        $to = $this->normalize($to);

        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Normalize path.
     *
     * @param string $path
     *
     * @return string
     */
    protected function normalize($path)
    {
        // deal with different operating systems' directory structure
        $path = rtrim(str_replace(DIRECTORY_SEPARATOR, '/', $path), '/');

        // remove leading current directory.
        if (substr($path, 0, 2) === './') {
            $path = substr($path, 2);
        }

        // remove references to current directory in the path.
        $path = str_replace('/./', '/', $path);

        /*
         * Example:
         *     /home/forkcms/frontend/cache/compiled_templates/../../core/layout/css/../images/img.gif
         * to
         *     /home/forkcms/frontend/core/layout/images/img.gif
         */
        do {
            $path = preg_replace('/[^\/]+(?<!\.\.)\/\.\.\//', '', $path, -1, $count);
        } while ($count);

        return $path;
    }

    /**
     * Figure out the shared path of 2 locations.
     *
     * Example:
     *     /home/forkcms/frontend/core/layout/images/img.gif
     * and
     *     /home/forkcms/frontend/cache/minified_css
     * share
     *     /home/forkcms/frontend
     *
     * @param string $path1
     * @param string $path2
     *
     * @return string
     */
    protected function shared($path1, $path2)
    {
        // $path could theoretically be empty (e.g. no path is given), in which
        // case it shouldn't expand to array(''), which would compare to one's
        // root /
        $path1 = $path1 ? explode('/', $path1) : array();
        $path2 = $path2 ? explode('/', $path2) : array();

        $shared = array();

        // compare paths & strip identical ancestors
        foreach ($path1 as $i => $chunk) {
            if (isset($path2[$i]) && $path1[$i] == $path2[$i]) {
                $shared[] = $chunk;
            } else {
                break;
            }
        }

        return implode('/', $shared);
    }

    /**
     * Convert paths relative from 1 file to another.
     *
     * E.g.
     *     ../images/img.gif relative to /home/forkcms/frontend/core/layout/css
     * should become:
     *     ../../core/layout/images/img.gif relative to
     *     /home/forkcms/frontend/cache/minified_css
     *
     * @param string $path The relative path that needs to be converted
     *
     * @return string The new relative path
     */
    public function convert($path)
    {
        // quit early if conversion makes no sense
        if ($this->from === $this->to) {
            return $path;
        }

        $path = $this->normalize($path);
        // if we're not dealing with a relative path, just return absolute
        if (strpos($path, '/') === 0) {
            return $path;
        }

        // normalize paths
        $path = $this->normalize($this->from.'/'.$path);

        // strip shared ancestor paths
        $shared = $this->shared($path, $this->to);
        $path = mb_substr($path, mb_strlen($shared));
        $to = mb_substr($this->to, mb_strlen($shared));

        // add .. for every directory that needs to be traversed to new path
        $to = str_repeat('../', count(array_filter(explode('/', $to))));

        return $to.ltrim($path, '/');
    }

    /**
     * Attempt to get the directory name from a path.
     *
     * @param string $path
     *
     * @return string
     */
    protected function dirname($path)
    {
        if (@is_file($path)) {
            return dirname($path);
        }

        if (@is_dir($path)) {
            return rtrim($path, '/');
        }

        // no known file/dir, start making assumptions

        // ends in / = dir
        if (mb_substr($path, -1) === '/') {
            return rtrim($path, '/');
        }

        // has a dot in the name, likely a file
        if (preg_match('/.*\..*$/', basename($path)) !== 0) {
            return dirname($path);
        }

        // you're on your own here!
        return $path;
    }
}