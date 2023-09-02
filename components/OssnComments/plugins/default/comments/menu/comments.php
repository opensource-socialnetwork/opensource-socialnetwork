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
$commentmenu = $params['menu'];
if($commentmenu){
?>
<a role="button" data-bs-toggle="dropdown" data-bs-target="#">
	<i class="fa fa-ellipsis-h"></i>
</a>
<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
		<?php
            if (!empty($commentmenu)) {
    			foreach ($params['menu'] as $menu) {
        			foreach ($menu as $link) {
            			unset($link['name']);
            			$link = ossn_plugin_view('output/url', $link);
            			echo "<li>{$link}</li>";
        			}
    			}
            }?>
    </ul>
<?php 
}