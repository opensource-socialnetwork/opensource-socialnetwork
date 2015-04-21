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
<div class="messages-inner">
    <?php
    echo '<div class="ossn-notifications-all">';
    if (!empty($params['notifications'])) {
        foreach ($params['notifications'] as $not) {
            echo $not;
        }
    }
    echo '</div>';

    ?>
</div>
<div class="bottom-all">
    <?php if (isset($params['seeall'])) { ?>
        <a href="<?php echo $params['seeall']; ?>"><?php echo ossn_print('see:all'); ?></a>
    <?php } ?>
</div>