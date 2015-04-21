<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.Open Source Social Network.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */
echo ossn_view_form('add', array(
    'action' => ossn_site_url() . 'action/ossnads/add',
    'component' => 'OssnAds',
    'class' => 'ossn-admin-form',
), false);
