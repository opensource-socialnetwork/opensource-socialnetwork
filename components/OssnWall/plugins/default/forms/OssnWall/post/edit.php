<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $description = json_decode(html_entity_decode($params['post']->description));
 $description = $description->post;
 $description = preg_replace('/<span class="emojii">(.*?)<\/span>/', '$1', $description);
 ?>
 <div>
 	<textarea id="post-edit" name="post"><?php echo $description;?></textarea>
    <input type="hidden"  name="guid" value="<?php echo $params['post']->guid;?>" />
    <input type="submit" class="hidden" id="ossn-post-edit-save" />
 </div>
