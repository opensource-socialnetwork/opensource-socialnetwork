<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossn-privacy">
    <table border="0">
        <tr>
            <td style="vertical-align:top;">
                <label><?php echo ossn_print('privacy'); ?></label>

            </td>
            <td>
                <input type="radio" name="privacy" value="2" checked="checked"/>
                <span><?php echo ossn_print('public'); ?></span>

                <p> <?php echo ossn_print('privacy:public:note'); ?> </p>

                <input type="radio" name="privacy" value="3"/>
                <span><?php echo ossn_print('friends'); ?></span>

                <p> <?php echo ossn_print('privacy:friends:note'); ?> </p>
            </td>
        </tr>
    </table>
</div>
