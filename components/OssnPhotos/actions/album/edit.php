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
$guid   = input('guid');
$name   = input('title');
$access = input('privacy');
$album  = ossn_get_object($guid);
if(isset($album->guid) && $album->subtype == 'ossn:album' && ($album->owner_guid == ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate())){
		if(!empty($name) && !empty($access)){
				$album->title        = $name;
				$album->data->access = $access;
				if($album->save()){
						ossn_trigger_message(ossn_print('settings:saved'));
						redirect(REF);
				}
		}
		
}
redirect(REF);