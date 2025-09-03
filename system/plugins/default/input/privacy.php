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
 if(!isset($params) || isset($params) && !is_array($params)){
		$params = array(); 
 }	
?>
<div class="ossn-privacy">
	<div>
    	<label><?php echo ossn_print('privacy'); ?></label>
    </div>
	<?php
	$default = array(
			'name' => 'privacy',
			'value' => (isset($params['value'])) ? $params['value'] : OSSN_PUBLIC,
			'options' => array(
			    OSSN_PUBLIC => 	 ossn_print('public') . ' ('. ossn_print('privacy:public:note').')',		   
			    OSSN_FRIENDS =>  ossn_print('friends') . ' ('. ossn_print('privacy:friends:note').')',		   
			 ),
	);
	$args = array_merge($default, $params);
	echo ossn_plugin_view('input/radio', $args);
	?>
</div>
