<?php
/* File:        smilify.lib.php
 * Version:     20150212_0001
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
    
    $icon = ossn_site_url() . 'components/OssnChat/images/emoticons/';
    $smiley_icon = array(
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-sad.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-smile.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-happy.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-wink.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-tongue.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-sunglasses.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-confused.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-gasp.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-kiss.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-angel.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-heart.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-devil.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-upset.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-pacman.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-grumpy.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-glasses.gif' />",
            "<img class='ossn-smiley-item' src='{$icon}ossnchat-cry.gif' />"
    );

    return str_replace($ascii_pattern, $smiley_icon, $text);
}


