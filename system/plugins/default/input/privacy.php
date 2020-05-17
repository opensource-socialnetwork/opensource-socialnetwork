<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossn-privacy">
	<div>
    	<label><?php echo ossn_print('privacy'); ?></label>
    </div>
	<?php
	echo ossn_plugin_view('input/radio', array(
			'name' => 'privacy',
			'value' => $params['value'],
			'options' => array(
			    OSSN_PUBLIC => 	 ossn_print('public') . ' ('. ossn_print('privacy:public:note').')',		   
			    OSSN_FRIENDS =>  ossn_print('friends') . ' ('. ossn_print('privacy:friends:note').')',		   
			 ),
	));
	?>
</div>
