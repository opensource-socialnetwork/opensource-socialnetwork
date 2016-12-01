<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $class = '';
 if(isset($params['class'])){ 
 	$class = $params['class'];
 }
 if(empty($params['title'])){
	 return;
 }  
?>
<div class="ossn-widget <?php echo $class;?>">
	<div class="widget-heading"><?php echo $params['title'];?></div>
	<div class="widget-contents">
		<?php echo $params['contents'];?>
	</div>
</div>