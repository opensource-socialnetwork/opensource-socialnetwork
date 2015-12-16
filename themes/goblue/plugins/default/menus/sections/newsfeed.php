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
$menus = $params['menu'];
?>
<div class="sidebar-menu-nav">
          <div class="sidebar-menu">
                 <ul id="menu-content" class="menu-content collapse out">
<?php                        
foreach ($menus as $key => $menu) {
    $section = ossn_print($key);
	$expend = '';
	$icon = "fa-angle-right";
	if($key == 'links'){
		$expend = 'in';
		$icon = "fa-newspaper-o";
	}
	if($key == 'groups'){
		$icon = "fa-users";
	}
	$hash = md5($key);
	
    ?>
     <li data-toggle="collapse" data-target="#<?php echo $hash;?>" class="collapsed active">
        	<a href="#"><i class="fa <?php echo $icon;?> fa-lg"></i><?php echo $section;?><span class="arrow"></span></a>
     </li>
    <ul class="sub-menu collapse <?php echo $expend;?>" id="<?php echo $hash;?>"> 
    <?php
    foreach ($menu as $text => $data) {
        $menu = str_replace(':', '-', $text);
        $icon = $data[1];
        if (!is_array($data[2])) {
            $data[2] = array();
        }
        $args = ossn_args($data[2]);
        echo "<li><a {$args} href='{$data[0]}'>{$text}</a></li>";
    }
	echo "</ul>";
}
?>

         </ul>
    </div>
</div>
