<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$grouppage_bg = ossn_call_hook('css', 'group:background', NULL, '#E9EAED');
?>
<style> body {
        background: <?php echo $grouppage_bg;?>;
    } </style>
<div class="ossn-layout-group">
    <div class="ossn-inner">
        <div class="coloum-left">
            &nbsp;
            <?php
            if (ossn_is_hook('newsfeed', "sidebar:left")) {
                $newsfeed_left = ossn_call_hook('newsfeed', "sidebar:left", NULL, array());
                echo implode('', $newsfeed_left);
            }
            ?>
        </div>
        <div class="coloum-middle">
            <?php echo $params['content']; ?>
        </div>

    </div>
</div>