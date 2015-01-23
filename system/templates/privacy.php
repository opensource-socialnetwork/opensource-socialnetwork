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
<script type="text/javascript">
    var OSSN_PUBLIC = 2;
    var OSSN_FRIENDS = 3;
    var wallprivacy = $('#ossn-wall-privacy').val();
    
    if (wallprivacy == OSSN_PUBLIC) {
        $('#radio-public-privacy').attr('checked',true);
    } else if (wallprivacy == OSSN_FRIENDS) {
        $('#radio-private-privacy').attr('checked',true);
    }
</script>
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
