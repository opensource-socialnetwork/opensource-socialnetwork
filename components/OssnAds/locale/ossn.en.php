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
$en = array(
	'ossnads'                       => 'Ads Manager',
	'fields:required'               => 'All fields are required!',
	'ad:created'                    => 'Ad has been created!',
	'ad:create:fail'                => 'Cannot create ad!',
	'ad:title'                      => 'Title',
	'ad:site:url'                   => 'Siteurl',
	'ad:desc'                       => 'Description',
	'ad:browse'                     => 'Browse',
	'ad:clicks'                     => 'Clicks',
	'sponsored'                     => 'SPONSORED',
	'ad:deleted'                    => "Ad with the title of '%s' has been successfully deleted.",
	'ad:delete:fail'                => 'Cannot delete ad! Please try again later.',
	'ad:edited'                     => 'Ad successfully modified.',
	'ad:edit:fail'                  => 'Cannot edit ad! Please try again later.',
	'ads:manager'                   => 'Advertisement Manager',
	'ads:boost:community'           => 'Boost your community. Create a new ad campaign or manage existing ones.',
	'ads:create'                    => 'Create Ad',

	'ad:placement'                  => 'Display Placement Areas',
	'ad:gender:target'              => 'Demographic Gender Targeting',
	'ad:end:date'                   => 'Campaign Expiry Date (Optional)',
	'ad:photo'                      => 'Banner Creative Image',
	'add'                           => 'Create Campaign',

	'ad:placement:newsfeed'         => 'Activity Newsfeed (Sidebar)',
	'ad:placement:profile'          => 'User Profiles (Sidebar)',
	'ad:placement:groups'           => 'Group Pages (Sidebar)',
	'ad:placement:global'           => 'All Other Theme Sidebars (Global)',

	'ad:file:choose'                => 'Choose or Drag Ad Image Here...',
	'ad:file:restriction'           => 'Strictly image files only (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Remove Image',
	'ad:char:left'                  => '%s left',
	'ad:status:expired'             => 'Expired',
	'ad:status:active'              => 'Active',
	'ad:views'                      => 'Views',
	'ad:status'                     => 'Status',
	'ad:end:date:infinity'          => 'Never',

	//cron
	'ossn:adscron:title'            => 'Required Setup: Automate Ad Expirations',
	'ossn:adscron:last:run'         => 'Last Cron Run:',
	'ossn:adscron:never'            => 'Never',
	'ossn:adscron:configure'        => 'Configure',
	'ossn:adscron:description'      => 'To automatically switch ad statuses to %s, you must configure a system cron job to run once a day at midday (12:00 PM).',
	'ossn:adscron:expired'          => 'Expired',
	'ossn:adscron:command:label'    => 'Crontab Command',
	'ossn:adscron:path:placeholder' => 'YOUR_SERVER_PHP_PATH',
	'ossn:adscron:warning:title'    => 'Important Notice:',
	'ossn:adscron:warning:text'     => 'Once an advertisement expires, it %s. Advertisers must create a new ad from scratch.',
	'ossn:adscron:cannot:edit'      => 'cannot be edited or renewed',
);
ossn_register_languages('en', $en);