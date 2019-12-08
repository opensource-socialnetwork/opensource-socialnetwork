<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
echo ossn_view_form('administrator/settings', array(
    'action' => ossn_site_url() . 'action/notifications/admin/settings',
    'component' => 'OssnNotifications',
    'class' => 'ossn-admin-form'	
), false);
