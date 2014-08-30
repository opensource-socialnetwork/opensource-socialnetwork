<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
echo ossn_view_form('add', array(
							   'action' => ossn_site_url().'action/ossnads/add',
							   'component' => 'OssnAds',
							   'class' => 'ossn-admin-form',
							    ), false);
