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
$lang = input('language');

$component = new OssnComponents();
$settings  = array(
		'fallback_language' => $lang,
);

$component->setSettings('OssnSitePages', $settings);
redirect(REF);