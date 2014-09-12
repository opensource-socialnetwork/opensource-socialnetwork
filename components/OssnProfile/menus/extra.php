<div>
<?php
foreach($params['menu'] as $menu){
	foreach($menu as $text => $link){
       echo "<li><a href='{$link}'>{$text}</a></li>";	
	}
}
?>
</div>