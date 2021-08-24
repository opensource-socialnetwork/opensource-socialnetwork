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
$col = "col-md-11";
if(isset($params['admin']) && $params['admin'] === true){
	$col = "col-md-12";
}
 ?>
<div class="ossn-system-messages">
	   <div class="row">
	  	 <div class="<?php echo $col;?>">
       			<div class="ossn-system-messages-inner">
    				<?php echo ossn_display_system_messages(); ?>
            		</div>
	   	</div>
	</div>
</div>    
