<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
echo ossn_view_form('admin/users/list_search', array(
    'action' => ossn_site_url('administrator/users'),
    'class' => 'ossn-admin-form',
));
echo ossn_view_form('admin/users/list', array(
    'action' => ossn_site_url('action/admin/users/delete'),
    'class' => 'ossn-admin-form',
));