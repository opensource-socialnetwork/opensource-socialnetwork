<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
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