<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 
echo ossn_view_form('administrator/settings', array(
    'action' => ossn_site_url() . 'action/wall/admin/settings',
    'component' => 'OssnWall',
    'class' => 'ossn-admin-form'	
), false);