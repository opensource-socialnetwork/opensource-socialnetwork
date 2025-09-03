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
$zh = array(
	'com:ossn:invite' => '邀請',			
	'com:ossn:invite:friends' => '邀請朋友',
	'com:ossn:invite:friends:note' => 'To invite friends to join you on this network, enter their email addresses and a brief message. They will receive an email containing your invitation.',
	'com:ossn:invite:emails:note' => '電子郵件 (使用逗號分隔每一個郵件)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => '訊息',
		
    	'com:ossn:invite:mail:subject' => '邀請你一起加入 %s',	
    	'com:ossn:invite:mail:message' => '你有一個邀請加入 %s 由 %s. 訊息是:

%s
點擊下面的連結一起加入:
To join, click the following link:

%s

Profile link: %s
',	
	'com:ossn:invite:mail:message:default' => 'Hi,

I wanted to invite you to join my network here on %s.

個人頁 : %s

Best regards.
%s',
	'com:ossn:invite:sent' => '你的朋友已被邀請 : %s.',
	'com:ossn:invite:wrong:emails' => '以下電子郵件無效: %s.',
	'com:ossn:invite:sent:failed' => '無法邀請下面的電子郵件: %s.',
	'com:ossn:invite:already:members' => '以下的電子郵件已經是使用者了: %s',
	'com:ossn:invite:empty:emails' => '請增加至少一筆電子郵件',
);
ossn_register_languages('zh', $zh); 
