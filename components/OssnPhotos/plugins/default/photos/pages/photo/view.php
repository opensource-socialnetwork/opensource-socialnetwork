<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$album = new OssnAlbums;
$image = $params['entity'];

$name = $album->GetAlbum($image->owner_guid)->album->title;
$img =  $image->getURL();
?>
<div class="ossn-photo-view">
    <h2> <?php echo $name; ?></h2>
    <a class="button-grey" href="<?php echo ossn_site_url("album/view/{$image->owner_guid}");?>"> <?php echo ossn_print('back:to:album'); ?>  </a>
    <br/>
    <table border="0" class="ossn-photo-viewer">
        <tr>
            <td class="image-block">
                <img src="<?php echo $img; ?>?size=view"/>
            </td>
        </tr>
    </table>

</div>
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
