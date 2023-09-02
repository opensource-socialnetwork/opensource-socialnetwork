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
$image = $params['entity'];
$img = $image->getURL();
?>
<div class="ossn-photo-view">
    <a class="button-grey" href="<?php echo ossn_site_url("album/profile/{$image->owner_guid}"); ?>"> <?php echo ossn_print('back:to:album'); ?>  </a>
    <br/>
    <table border="0" class="ossn-photo-viewer">
        <tr>
            <td class="image-block">
                <img src="<?php echo $img; ?>"/>
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
