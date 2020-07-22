<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$image = $params['entity'];
$img = str_replace('profile/cover/', '', $image->value);
?>
<div class="ossn-photo-view">
    <a class="button-grey" href="<?php echo ossn_site_url("album/covers/profile/{$image->owner_guid}"); ?>"> <?php echo ossn_print('back:to:album'); ?>  </a>
    <br/>
    <table border="0" class="ossn-photo-viewer">
        <tr>
            <td class="image-block">
                <img
                    src="<?php echo ossn_site_url("album/getcover/") . $image->owner_guid; ?>/<?php echo $img; ?>"/>
            </td>
        </tr>
    </table>

</div>
<br/>
<br/>
<?php
	$vars['entity'] = $image;
	$vars['full_view'] = $params['full_view'];
	echo ossn_plugin_view('entity/comment/like/share/view', $vars);
?>
<div class="ossn-photo-view-controls">
    <?php
    if (ossn_is_hook('cover:view', 'profile:controls')) {
        echo ossn_call_hook('cover:view', 'profile:controls', $image);
    }
    ?>
</div>
