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
 
?>
<div>
    <?php
    if (!empty($params['menu'])) {
		echo '<a role="button" data-toggle="dropdown" class="btn-action" data-target="#" aria-expanded="true"><i class="fa fa-sort-desc"></i></a>';
		echo '<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';
        foreach ($params['menu'] as $menu) {
            foreach ($menu as  $link) {
				$class = "profile-menu-extra-".$link['name'];
				if(isset($link['class'])){
					$link['class'] = $class.' '.$link['class'];	
				} else {
					$link['class'] = $class;
				}
				unset($link['name']);
				$link = ossn_plugin_view('output/url', $link);
                echo "<li>{$link}</li>";
            }
        }
		echo "</ul>";
    }
    ?>
</div>