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
<label><?php echo ossn_print('group:name'); ?></label>
<input type="text" name="groupname"/>
<input type="submit" class="ossn-hidden" id="ossn-group-submit"/>

<div class="ossn-privacy">
    <table border="0">
        <tr>
            <td style="vertical-align:top;">
                <label><?php echo ossn_print('privacy'); ?></label>
            </td>
            <td>
                <input type="radio" name="privacy" value="2" checked="checked"/>
                <span><?php echo ossn_print('public'); ?></span>

                <p><?php echo ossn_print('privacy:group:public'); ?></p>

                <input type="radio" name="privacy" value="1"/>
                <span><?php echo ossn_print('close'); ?></span>

                <p> <?php echo ossn_print('privacy:group:close'); ?></p>
            </td>
        </tr>
    </table>
</div>
