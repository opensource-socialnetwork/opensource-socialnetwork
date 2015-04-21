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
<style>
    body {
        background: #fff;
    }
</style>
<div class="ossn-layout-media"><br/>

    <div class="content">
        <?php echo $params['content']; ?>
    </div>
    <div class="sidebar">
        <?php
        if (com_is_active('OssnAds')) {
            echo ossn_plugin_view('ads/page/view');
        }
        ?>
    </div>
</div>