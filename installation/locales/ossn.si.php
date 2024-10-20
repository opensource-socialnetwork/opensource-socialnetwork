<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


$sinhala = array(
	'site:settings' => 'වෙබ් අඩවි සැකසුම්',
	'ossn:installed' => 'ස්ථාපනය කරනඅද ලද',
	'ossn:installation' => 'ස්ථාපනය',
	'ossn:check' => 'වලංගු',
	'ossn:installed' => 'ස්ථාපනය කරනඅද ලද',
	'ossn:installed:message' => 'Open Source Social Network ස්ථාපනය කරන ලදී.',
    'ossn:prerequisites' => 'ස්ථාපනයට පෙර අවශ්‍යතා',
    'ossn:settings' => 'Server සැකසුම්',
    'ossn:dbsettings' => 'Database',
	'ossn:dbuser' => 'Database පාරිශිලක',
	'ossn:dbpassword' => 'Database මුරපදය',
	'ossn:dbname' => 'Database නම',
	'ossn:dbhost' => 'Database හොස්ට්',
    'ossn:sitesettings' => 'වෙබ් අඩවිය',
    'ossn:websitename' => 'වෙබ් අඩවි නාමය',
    'ossn:mainsettings' => 'පාත්ස්',
	'ossn:weburl' => 'OssnSite Url',
	'installation:notes' => 'මෙම ගොනු දත්ත ඩිරෙක්ටරියේ පරිශීලක ගොනු අඩංගු වේ. ගොනු දත්ත ඩිරෙක්ටරිය OSSN installation path එකෙන් පිට තැබිය යුතුය.', 
	'ossn:datadir' => 'දත්ත ඩිරෙක්ටරිය',
	'owner_email' => 'වෙබ් අඩවි හිමිකරුගේ ඊ-මේල් ලිපිනය',
	'notification_email' => 'දැනුම්දීම් ඊමේල් ලිපිනය (noreply@domain.com)',
	'create:admin:account' => 'පරිපලක ගිණුමක් සකසන්න',
	'ossn:setting:account' => 'ගිණුම් සැකසුම්',
	
	'data:directory:invalid' => 'වැරදි දත්ත ඩිරෙක්ටරිය හෝ ඩිරෙක්ටරිය  මත ලිවීමට නොහැක.',	
	'data:directory:outside' => 'දත්ත ඩිරෙක්ටරිය ස්ථාපන ගොනුවෙන් පිටත තැබිය යුතුය.',
	'all:files:required' => 'සියලු ගොනු අවශ්‍යයි.ඔබගේ ගොනු පරික්ෂා කරන්න.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "ඔබගේ PHP වර්ෂන් එක පැරණිය , " . PHP_VERSION . " අවම වශයෙන්  PHP 8.0 or 8.x වත් අවශ්‍ය වේ",
	
	'ossn:install:mysqli' => 'MYSQLI සක්‍රීයයි',
	'ossn:install:mysqli:required' => 'MYSQLI PHP EXTENSION අවශ්‍යයි',
	
	'ossn:install:apache' => 'APACHE සක්‍රීයයි',
	'ossn:install:apache:required' => 'APACHE අවශ්‍යයි',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE අවශ්‍යයි',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL අවශ්‍යයි',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'PHP GD LIBRARY අවශ්‍යයි',
	
	'ossn:install:config' => 'CONFIGURATION DIRECTORY WRITEABLE',
	'ossn:install:config:error' => 'CONFIGURATION DIRECTORY IS NOT WRITEABLE',
	
	'ossn:install:next' => 'මීලගට',
    'ossn:install:install' => 'ස්ථාපනය කරන්න',
    'ossn:install:create' => 'සාදන්න',
    'ossn:install:finish' => 'නිම කරන්න',
	
	'fields:require' => 'සැම ඉන්පුට් එකක්ම අවශ්‍යයි!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen සක්‍රීයයි',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen අවශ්‍යයි',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive සක්‍රීයයි',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive EXTENSION අවශ්‍යයි',
	'ossn:install:cachedir:note:failed' => 'තහවුරු කරගන්න ,ඔබගේ ගොනු සහ ඩිරෙක්ටරියන වල අයිතිය නිවැරදි apache user සතුවද යන්න.',
);

ossn_installation_register_languages($sinhala);
