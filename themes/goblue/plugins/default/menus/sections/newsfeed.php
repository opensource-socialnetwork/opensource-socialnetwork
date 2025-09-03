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
$menus = $params['menu'];
?>
<div class="sidebar-menu-nav">
          <div class="sidebar-menu">
                 <ul id="menu-content" class="menu-content collapse out">
<?php                        
foreach ($menus as $name => $menu) {
	$section = 'menu-section-'.OssnTranslit::urlize($name).' ';
	$items = 'menu-section-items-'.OssnTranslit::urlize($name).' ';
	
	$expend = '';
	$icon = "fa-angle-right";
	if($name == 'links'){
		$expend = 'show';
		$icon = "fa-newspaper";
	}
	if($name  == 'groups'){
		$icon = "fa-users";
	}
	$hash = 'nm'.md5($name);
    ?>
     <li data-bs-toggle="collapse" data-bs-target="#<?php echo $hash;?>" class="<?php echo $section;?>collapsed active <?php echo $expend;?>">
        	<a href="javascript:void(0);"><i class="fa <?php echo $icon;?>"></i><?php echo ossn_print($name);?><span class="arrow"></span></a>
     </li>
    <ul class="sub-menu collapse <?php echo $expend;?>" id="<?php echo $hash;?>" class="<?php echo $items;?>"> 
    <?php
	if(is_array($menu)){
	    foreach ($menu as $data) {
		    $data['li_class'] = 'menu-section-item-'.OssnTranslit::urlize($data['name']);
			$data['class'] = 'menu-section-item-a-'.OssnTranslit::urlize($data['name']);
			unset($data['name']);			
			if(isset($data['icon'])){
				unset($data['icon']);
			}
			unset($data['section']);
			
			if(isset($data['parent'])){
				unset($data['parent']);
			}
		    echo ossn_plugin_view('output/section_submenu_url', $data);
			if(isset($data['li_class'])){
			    unset($data['li_class']);
			}
			if(isset($data['class'])){
			    unset($data['class']);
			}
    	}
	}
	echo "</ul>";
}
?>

         </ul>
    </div>
</div>
