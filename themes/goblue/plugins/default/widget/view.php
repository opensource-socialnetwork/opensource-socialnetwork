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