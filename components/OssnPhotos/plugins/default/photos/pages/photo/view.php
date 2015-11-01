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
$album = new OssnAlbums;
$image = $params['entity'];

$name = $album->GetAlbum($image->owner_guid)->album->title;
$img = str_replace('album/photos/', '', $image->value);
?>
<div class="ossn-photo-view">
    <h2> <?php echo $name; ?></h2>
    <a href="<?php echo ossn_site_url("album/view/{$image->owner_guid}");?>"> <?php echo ossn_print('back:to:album'); ?>  </a>
    <br/>
    <table border="0" class="ossn-photo-viewer">
        <tr>
            <td class="image-block" style="text-align: center;width:465px;min-height:200px;">
                <img
                    src="<?php echo ossn_site_url("album/getphoto/") . $image->owner_guid; ?>/<?php echo $img; ?>?size=view"/>
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
    if (ossn_is_hook('photo:view', 'album:controls')) {
        echo ossn_call_hook('photo:view', 'album:controls', $image);
    }
    ?>
</div>
