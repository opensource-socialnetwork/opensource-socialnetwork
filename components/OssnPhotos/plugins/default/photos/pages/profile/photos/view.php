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
$image = $params['entity'];
$img = str_replace('profile/photo/', '', $image->value);
?>
<div class="ossn-photo-view">
    <a href="<?php echo ossn_site_url("album/profile/{$image->owner_guid}"); ?>"> <?php echo ossn_print('back:to:album'); ?>  </a>
    <br/>
    <table border="0" class="ossn-photo-viewer">
        <tr>
            <td class="image-block" style="text-align: center;width:465px;min-height:200px;">
                <img
                    src="<?php echo ossn_site_url("album/getphoto/") . $image->owner_guid; ?>/<?php echo $img; ?>?type=1"/>
            </td>
        </tr>
    </table>

</div>
<br/>
<br/>
<?php
	$vars['entity'] = $image;
	$vars['full_view'] = true;
	echo ossn_plugin_view('entity/comment/like/share/view', $vars);
?>
<div class="ossn-photo-view-controls">
    <?php
    if (ossn_is_hook('photo:view', 'profile:controls')) {
        echo ossn_call_hook('photo:view', 'profile:controls', $image);
    }
    ?>
</div>
