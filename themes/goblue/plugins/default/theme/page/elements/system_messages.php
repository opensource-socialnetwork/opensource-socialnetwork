<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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