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
?>
<div class="ossn-admin-components-list">
   	<?php
	$OssnComs = new OssnComponents;
	$list = $OssnComs->getComponents();
	if($list){
		foreach($list as $com_id) {
			$manifest = $OssnComs->getCom($com_id);
			if(!$manifest){
					error_log("Invalid component manifest file or not found");
					ossn_trigger_message("{$com_id}: ".ossn_print("ossn:com:installer:xml:incomplete:error"), 'error');
					continue;
			}
			
			$vars = array();
			$vars['xml'] = $manifest;
			$vars['com_id'] = $com_id;
			
			//[E] Add ids in components and themes lists item so can be utilized later #2313
			echo "<div class='ossn-admin-component-list-item' data-com-id='{$com_id}' data-com-version='{$vars['xml']->version}'>";
			echo ossn_plugin_view("admin/components/list/item", $vars);
			echo "</div>";
		}
	}
	?>
</div> 
<div id="ossn-com-lightbox" onclick="this.style.display='none'">
    <img id="lightbox-img" src="" alt="Preview">
</div>
<script>
function showOssnPreview(src) {
    const lightbox = document.getElementById('ossn-com-lightbox');
    const img = document.getElementById('lightbox-img');
    img.src = src;
    lightbox.style.display = 'flex';
}
</script>
