<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
echo ossn_view_form('golive/admin/settings', array(
    'action' => ossn_site_url() . 'action/golive/admin/settings',
    'component' => 'OssnGoLive',
    'class' => 'ossn-admin-form'	
));