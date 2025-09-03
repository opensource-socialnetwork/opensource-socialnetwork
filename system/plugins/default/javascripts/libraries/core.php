<?php
/**
 * 	Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
 */

echo ossn_plugin_view('javascripts/libraries/ossn.lib.system');
echo ossn_plugin_view('javascripts/libraries/ossn.lib.cookie');
echo ossn_plugin_view('javascripts/libraries/ossn.lib.xhr');
echo ossn_plugin_view('javascripts/libraries/ossn.lib.securitytoken');
echo ossn_plugin_view('javascripts/libraries/ossn.lib.languages');
echo ossn_plugin_view('javascripts/libraries/ossn.lib.messageboxes');
echo ossn_plugin_view('javascripts/libraries/ossn.lib.initialize');  //this must be at end
