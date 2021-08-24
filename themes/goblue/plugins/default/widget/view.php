<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $class = 'ossn-widget';
 if(isset($params['class'])){ 
 	$class = 'ossn-widget '.$params['class'];
 }
 unset($params['class']);
 if(empty($params['title'])){
	 return;
 } 
$defaults = array(
	'class' => $class,
);

$title 	  = $params['title'];
$contents = $params['contents'];

$params   = array_merge($defaults, $params);
unset($params['title']);
unset($params['contents']);
$attributes = ossn_args($params); 
?>
<div <?php echo $attributes;?>>
	<div class="widget-heading"><?php echo $title;?></div>
	<div class="widget-contents">
		<?php echo $contents;?>
	</div>
</div>
