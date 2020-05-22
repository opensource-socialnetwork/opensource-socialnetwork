<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div>
<label><?php echo ossn_print('group:name'); ?></label>
<input type="text" name="groupname"/>
<input type="submit" class="ossn-hidden" id="ossn-group-submit"/>
</div>
<div class="group-add-privacy">
<?php
echo ossn_plugin_view('input/privacy', array(
			'options' => array(
			    OSSN_PUBLIC => 	 ossn_print('public') . ' ('. ossn_print('privacy:group:public').')',		   
			    OSSN_PRIVATE =>  ossn_print('close') . ' ('. ossn_print('privacy:group:close').')',		   
			 ),											 
));
?>
</div>