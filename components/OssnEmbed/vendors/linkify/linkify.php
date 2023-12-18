<?php
/** 
 * Linkify the URLs in text
 *
 * License : GNU Public License version 2
 * Taken from hypeJunction
 * https://github.com/hypeJunction/hypeScraper/blob/master/classes/hypeJunction/Scraper/Linkify.php
 * By Ismayil Khayredinov - (ismayil@hypejunction.com)
 **/
function linkify($text) {
		// match entire anchor <a></a> so we can exclude it from matches
		$REGEX_MATCH_ANCHOR = '<a[^>]*?>.*?<\/a>';
	
		// non-greedy match of a single tag name and attributes
		// we need to exclude e.g. hex color codes when matchin hashes
		$REGEX_MATCH_TAG = '<.*?>';
	
		// we want at least one non space or punctuation character before the match
		$REGEX_CHAR_BACK = '(^|\s|\!|\.|\?|>|\G)+';
		$REGEX_URL       = '(h?[t|f]??tps*:\/\/[^\s\r\n\t<>"\'\)\(]+)';

		$regex = '/' . $REGEX_MATCH_ANCHOR . '|' . $REGEX_MATCH_TAG . '|' . $REGEX_CHAR_BACK . $REGEX_URL . '/i';

		$callback = function ($matches) {
				if(empty($matches[2])) {
						return $matches[0];
				}
				$text = $matches[2];
				return $matches[1] . "<a rel='noreferrer' target='_blank' href='" . $matches[2] . "'>" . $text . '</a>';
		};
		return preg_replace_callback($regex, $callback, $text);
}
