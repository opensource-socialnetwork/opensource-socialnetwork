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
$title = ossn_print('site:index');
$content = ossn_set_page_layout('startup', array('content' => ossn_plugin_view('pages/contents/index')));
echo ossn_view_page($title, $content);
