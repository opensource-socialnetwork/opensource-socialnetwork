<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$post_guid = $params['guid'][0];

$wall_obj = new OssnWall;

$posts = $wall_obj->GetPost($post_guid);

if($posts->access !== '3'){

	$vars = ossn_wallpost_to_item($posts);
    echo ossn_wall_view_template($vars);

}else{
	echo trigger_error("This post have friend only privacy", 'denied');
}
