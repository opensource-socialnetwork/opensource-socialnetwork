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
            if (ossn_is_hook('search', "left")) {
                $searchleft = ossn_call_hook('search', "left", NULL, array());
                echo implode('', $searchleft);
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
                ?>
            </div>
        </div>

    </div>
</div>
