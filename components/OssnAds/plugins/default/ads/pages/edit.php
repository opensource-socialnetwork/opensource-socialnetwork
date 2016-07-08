<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo ossn_view_form('edit', array(
    'action' => ossn_site_url() . 'action/ossnads/edit',
    'component' => 'OssnAds',
    'class' => 'ossn-ads-form',
	'params' => $params,
), false);
