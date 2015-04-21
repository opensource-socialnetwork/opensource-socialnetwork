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
                    echo ossn_plugin_view('ads/page/view');
                }
                ?>
            </div>
        </div>

    </div>
</div>
