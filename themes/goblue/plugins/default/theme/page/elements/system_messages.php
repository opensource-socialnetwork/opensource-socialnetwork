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
$col = "col-lg-11";
if(isset($params['admin']) && $params['admin'] === true){
	$col = "col-lg-12";
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
