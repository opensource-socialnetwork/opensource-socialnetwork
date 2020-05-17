<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
echo '<p>' . ossn_print('post:select:privacy') . '</p>';
echo ossn_plugin_view('input/privacy', array(
		'value' => OSSN_PUBLIC,											 
));
