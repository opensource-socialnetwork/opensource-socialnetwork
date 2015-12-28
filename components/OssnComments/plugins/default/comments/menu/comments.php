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