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
$title = ossn_print('site:index');
$content = ossn_set_page_layout('startup', array('content' => ossn_plugin_view('pages/contents/index')));
echo ossn_view_page($title, $content);
