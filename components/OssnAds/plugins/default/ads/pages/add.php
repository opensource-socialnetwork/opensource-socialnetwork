<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo ossn_view_form('add', array(
    'action' => ossn_site_url() . 'action/ossnads/add',
    'component' => 'OssnAds',
    'class' => 'ossn-ads-form',
), false);
