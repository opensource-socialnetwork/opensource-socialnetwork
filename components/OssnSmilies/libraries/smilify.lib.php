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
            "<img src='{$icon}ossnchat-sad.gif' />",
            "<img src='{$icon}ossnchat-smile.gif' />",
            "<img src='{$icon}ossnchat-happy.gif' />",
            "<img src='{$icon}ossnchat-wink.gif' />",
            "<img src='{$icon}ossnchat-tongue.gif' />",
            "<img src='{$icon}ossnchat-sunglasses.gif' />",
            "<img src='{$icon}ossnchat-confused.gif' />",
            "<img src='{$icon}ossnchat-gasp.gif' />",
            "<img src='{$icon}ossnchat-kiss.gif' />",
            "<img src='{$icon}ossnchat-angel.gif' />",
            "<img src='{$icon}ossnchat-heart.gif' />",
            "<img src='{$icon}ossnchat-devil.gif' />",
            "<img src='{$icon}ossnchat-upset.gif' />",
            "<img src='{$icon}ossnchat-pacman.gif' />",
            "<img src='{$icon}ossnchat-grumpy.gif' />",
            "<img src='{$icon}ossnchat-glasses.gif' />",
            "<img src='{$icon}ossnchat-cry.gif' />"
    );

    return str_replace($ascii_pattern, $smiley_icon, $text);
}


