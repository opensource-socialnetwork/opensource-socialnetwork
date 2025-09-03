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
$si = array(
	'com:ossn:invite' => 'ආරාධනා',			
	'com:ossn:invite:friends' => 'මිතුරන්ට ආරාධනා කරන්න',
	'com:ossn:invite:friends:note' => 'මෙම සමාජ ජාලයට ඔබේ මිතුරන්ට එක්වීමට ඇරයුම් කරන්න ඔවුන්ගේ ඊමේල් ලිපිනය සහ සංක්ෂිප්ත පණිවිඩයක් මෙහි ඇතුලත් කරන්න.ඔවුනට ඔබගේ ඇරයුම එමගින් ලැබේ.',
	'com:ossn:invite:emails:note' => 'ඊමේල් ලිපිනය (කොමා මගින් බෙදන ලද)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'පණිවිඩය',
		
    	'com:ossn:invite:mail:subject' => '%s වෙත එක්වීම සදහා ඇරයුම',	
    	'com:ossn:invite:mail:message' => '%s වෙත එක්වීම සදහා ඔබ වෙත ඇරයුමක්  %s විසින් ඒවා ඇත, එහි මෙම පණිවිඩය අන්තර්ගතය:

%s

ට එක්වීම සදහා පහල ලින්ක් එක වෙත යන්න:

%s

ප්‍රොෆයිල් ලින්ක්: %s
',	
	'com:ossn:invite:mail:message:default' => 'හායි,

මම ඔබට ඇරයුම් කරනවා මගේ මිතුරු ජලයට එක්වීමට %s.

ප්‍රොෆයිල් ලින්ක්: %s

සුභ පැතුම්.
%s',
	'com:ossn:invite:sent' => 'ඔබගේ මිතුරන් හට ඇරයුම් කරන ලදී. ඇරයුම් යැවුම්: %s.',
	'com:ossn:invite:wrong:emails' => 'මෙම ලිපින වලංගු නැත: %s.',
	'com:ossn:invite:sent:failed' => 'පහත ලිපින වලට ඇරයුම් යැවිය නොහැක: %s.',
	'com:ossn:invite:already:members' => 'මෙම ලිපිනයන් හිමිකරුවන් දැනටමත් අපේ සාමාජිකයන්ය: %s',
	'com:ossn:invite:empty:emails' => 'අවම වශයෙන් එක ඊමේල් ලිපිනයක් හරි ඇතුලත් කරන්න',
);
ossn_register_languages('si', $si); 
