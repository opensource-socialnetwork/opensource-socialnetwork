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
 ?>
<div class="ossn-layout-admin">
	<?php echo ossn_plugin_view('theme/page/elements/system_messages', array(
						'admin' => true
	  	  )); 
	?>    
	<div class="row">
    	<div class="col-md-12 contents">
    	 	<?php echo $params['contents']; ?>
    	</div>
	</div>
</div>    