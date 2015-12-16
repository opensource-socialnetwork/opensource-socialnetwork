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
 	$col = "col-md-11";
	if($params['admin'] === true){
		$col = "col-md-12";
	}
 ?>
<div class="ossn-system-messages">
   <div class="row">
	   <div class="<?php echo $col;?> ossn-system-messages-inner">
    		<?php echo ossn_display_system_messages(); ?>
   		</div>
	</div>
</div>    