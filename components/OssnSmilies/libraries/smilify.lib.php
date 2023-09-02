<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
function smilify($text) {

    $ascii_pattern = array(
            ':(',
            ':)',
            '=D',
            ';)',
            ':p',
            '8|',
            'o.O',
            ':O',
            ':*',
            'a:',
            ':h:',
            '3:|',
            'u:',
            ':v',
            'g:',
            '8)',
            'c:'
    );
    
    $smiley_icon = array(
            "&#x1f641;",
            "&#x1f642;",
            "&#x1f600;",
            "&#x1f609;",
            "&#x1f61b;",
            "&#x1f60e;",
            "&#x1f62f;",
            "&#x1f632;",
            "&#x1f618;",
            "&#x1f607;",
            "&#x2764;",
            "&#x1f608;",
            "&#x1f620;",
            "&#x1f47b;",
            "&#x1f61f;",
            "&#x1f60e;",
            "&#x1f62a;"
    );

    return str_replace($ascii_pattern, $smiley_icon, $text);
}


