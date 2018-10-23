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
$commentmenu = $params['menu'];
if($commentmenu){
?>
<a id="dLabel" role="button" data-toggle="dropdown" data-target="#">
	<i class="fa fa-sort-desc"></i>
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