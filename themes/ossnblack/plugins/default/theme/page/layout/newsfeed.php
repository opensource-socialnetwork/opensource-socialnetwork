<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
<style> body {
        background: #FDFDFD;
    } </style>
<div class="ossn-layout-newsfeed">
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
        <div class="coloum-right">
            <div style="padding:12px;min-height:300px;">
                <?php
                if (com_is_active('OssnAds')) {
                    echo ossn_plugin_view('ads/page/view');
                }
         	if (ossn_is_hook('newsfeed', "sidebar:right")) {
            	        $newsfeed_right = ossn_call_hook('newsfeed', "sidebar:right", NULL, array());
                	echo implode('', $newsfeed_right);
            	}	                
                ?>
            </div>
        </div>
    </div>
</div>
