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
$ta = array(
	'com:ossn:invite' => 'அழைப்பிதழ்',			
	'com:ossn:invite:friends' => 'நண்பர்களுக்கு அழைப்புவிடுங்கள்',
	'com:ossn:invite:friends:note' => 'இந்தப் பிணையத்தில் உங்களோடு இணைய நண்பர்களை வரச்சொல்வதற்கு, அவர்களுடைய மின்னஞ்சல் முகவரிகளையும் ஒரு குறுஞ்செய்தியையும் நிரப்புக. உங்கள் அழைப்பிதழோடு ஒரு மின்னஞ்சலை அவர்கள் பெறுவார்கள்.',
	'com:ossn:invite:emails:note' => 'மின்னஞ்சல் முகவரிகள் (அரைப்புள்ளிகளால் பிரிக்கப்பட வேண்டும்)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'குறுஞ்செய்தி',
		
    	'com:ossn:invite:mail:subject' => '%s இல் இணைவதற்கான அழைப்பிதழ்',	
    	'com:ossn:invite:mail:message' => '%s இல் இணையும்படி %s என்பவர் அழைப்பிதல் கொடுத்துள்ளார். அவர் இந்தக் குறுஞ்செய்தியைச் சேர்த்துள்ளார்:

%s

இணைய, பின்வரும் பிணைப்பைச் சொடுக்குக:

%s

சுயவிவரப் பிணைப்பு: %s
',	
	'com:ossn:invite:mail:message:default' => 'வணக்கம்,

%s இல் உள்ள என் பிணையத்தில் இணையும்படி உங்களுக்கு அழைப்புவிடுக்கிறேன்.

சுயவிவரப் பிணைப்பு : %s

இங்ஙணம்.
%s',
	'com:ossn:invite:sent' => 'உங்கள் நண்பர்களுக்கு அழைப்பு விடுக்கப்பட்டது. அனுப்பிய அழைப்பிதல்கள்: %s.',
	'com:ossn:invite:wrong:emails' => 'பின்வரும் முகவரிகள் செல்லாதவை: %s.',
	'com:ossn:invite:sent:failed' => 'பின்வரும் முகவரிகளுக்கு அழைப்புவிடுக்க முடியாது: %s.',
	'com:ossn:invite:already:members' => 'பின்வரும் முகவரிகள் ஏற்கெனவே உறுப்பினர்கள் தான்: %s',
	'com:ossn:invite:empty:emails' => 'தயவுசெய்து ஒரு மின்னஞ்சல் முகவரியாவது சேர்த்திடுங்கள்',
);
ossn_register_languages('ta', $ta); 
