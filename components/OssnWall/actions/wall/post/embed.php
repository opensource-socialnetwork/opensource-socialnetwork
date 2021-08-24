<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
//Post on edit not returning JSON type callback #1506
header('Content-Type: application/json'); 
// restore html linebreaks and remove double backslashes
$text = str_replace('\n', "<br/>\n", input('text'));
$text = str_replace("\\\\", "\\", $text);

/* LinkPreview support --------------------------------- */
$preview_state = 'unchanged';
$preview_html  = '';
$post_guid     = input('guid');

if (com_is_active('LinkPreview')) {
	$preview_url   = input('preview');
	// check whether a preview is already attached to the post 
	if($len = strlen($preview_url)) {
		// if yes, check whether this url is still included in the text
		// (reduce length of url because LinkPreview adds extra / at the end)
		if(strpos($text, substr($preview_url, 0, $len - 1)) === false) {
			// no, old link no longer included
			// so fetch old Preview object and delete it
			$linkpreview = new \Ossn\Component\LinkPreview(false, $post_guid);
			$linkpreview->deletePreview();
			// we need to delete 1 entity manually which is still attached to post
			$entity = new OssnEntities;
			$params = array(
				'subtype' => 'linkPreview',
				'type' => 'object',
				'owner_guid' => $post_guid
			);
			$preview_entity = $entity->searchEntities($params);
			$entity->deleteEntity($preview_entity[0]->guid);
			$preview_state = 'removed';
			
			// now that the old preview has been removed, 
			// let's check for another valid url inside the text to build a new preview from ...
			$linkpreview      = new \Ossn\Component\LinkPreview($text, $post_guid);
			$linkpreview_guid = $linkpreview->addLinkPreview();
			if($linkpreview_guid) {
				// yes, there's a new preview, attach it to the post !
				$wall = new OssnWall;
				$post = $wall->GetPost($post_guid);
				$post->data->linkPreview = $linkpreview_guid;
				$json = html_entity_decode($post->description);
				$data = json_decode($json, true);
				// make sure we restore new linse back to \r\n
				$data['post'] = htmlspecialchars($data['post'], ENT_QUOTES, 'UTF-8');
				$data['post'] = ossn_input_escape($data['post']);
				$post->description = json_encode($data, JSON_UNESCAPED_UNICODE);
				$post->save();
				// ok, new entity has been created now
				// let's fetch the new html for passing back via json
				$object = new OssnObject;
				$params = array(
					'subtype' => 'LinkPreview',
					'type' => 'object',
					'owner_guid' => $post_guid
				);
				$preview_object = $object->searchObject($params);
        			$preview_html = ossn_plugin_view('linkpreview/item_inner', array(
					'item' => $preview_object[0],
					'guid' => $post_guid
				));
				$preview_state = 'changed';
			}	
		}
		// no change - former preview kept in place
	} else {
		// initially this posting had no preview
		// let's check for a new valid url inside the text to build a preview from ...
		$linkpreview      = new \Ossn\Component\LinkPreview($text, $post_guid);
		$linkpreview_guid = $linkpreview->addLinkPreview();
		if($linkpreview_guid) {
			// yes, there's a new preview, attach it to the post !
			$wall = new OssnWall;
			$post = $wall->GetPost($post_guid);
			$post->data->linkPreview = $linkpreview_guid;
			$json = html_entity_decode($post->description);
			$data = json_decode($json, true);
			$data['post'] = htmlspecialchars($data['post'], ENT_QUOTES, 'UTF-8');
			$data['post'] = ossn_input_escape($data['post']);
			$post->description = json_encode($data, JSON_UNESCAPED_UNICODE);
			$post->save();
			// ok, entity has been created now
			// let's fetch the preview html for passing back via json
			$object = new OssnObject;
			$params = array(
				'subtype' => 'LinkPreview',
				'type' => 'object',
				'owner_guid' => $post_guid
			);
			$preview_object = $object->searchObject($params);
			$preview_html = ossn_plugin_view('linkpreview/item_inner', array(
				'item' => $preview_object[0],
				'guid' => $post_guid
			));
			$preview_state = 'created';
		}
	}
}

/* ------------------------------------------------------- */

// restore embedded stuff
$return = ossn_call_hook('wall', 'templates:item', NULL, array('text' => $text));
$embed  = $return['text'];
echo json_encode(array(
	"text" => $embed,
	"preview_state" => $preview_state,
	"preview" => $preview_html,
	"item_guid" => 'id="activity-item-' . $post_guid . '"'
));
exit;
