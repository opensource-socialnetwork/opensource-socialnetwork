<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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