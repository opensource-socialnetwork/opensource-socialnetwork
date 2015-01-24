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
echo '<div style="font-size:12px;">' . ossn_print('post:select:privacy') . '</div>';
?>
<div class="ossn-privacy">
    <table border="0">
        <tr>
            <td style="vertical-align:top;">
                <label><?php echo ossn_print('privacy'); ?></label>

            </td>
            <td>
                <input id="radio-public-privacy" type="radio" name="privacy" value="2"/>
                <span><?php echo ossn_print('public'); ?></span>

                <p> <?php echo ossn_print('privacy:public:note'); ?> </p>

                <input id="radio-private-privacy" type="radio" name="privacy" value="3"/>
                <span><?php echo ossn_print('friends'); ?></span>

                <p> <?php echo ossn_print('privacy:friends:note'); ?> </p>
            </td>
        </tr>
    </table>
</div>
