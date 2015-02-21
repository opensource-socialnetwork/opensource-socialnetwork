<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
?>
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
                    echo ossn_view('components/OssnAds/page/view');
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
