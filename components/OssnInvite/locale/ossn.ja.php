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
$ja = array(
	'com:ossn:invite' => 'Invite',			
	'com:ossn:invite:friends' => '友達を招待',
	'com:ossn:invite:friends:note' => '友人をこのネットワークに招待するために、友人のメールアドレスと簡単なメッセージを入力してください。 彼らはあなたの招待状を含むメールを受け取ります。',
	'com:ossn:invite:emails:note' => '電子メールアドレス (separated by a comma)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'メッセージ',
		
    	'com:ossn:invite:mail:subject' => 'Invitation to join %s',	
    	'com:ossn:invite:mail:message' => '%sによって%sに参加するよう招待されました。 次のメッセージが含まれていました。

%s

参加するには、次のリンクをクリックしてください。

%s

プロフィールリンク：%s
',	
	'com:ossn:invite:mail:message:default' => 'こんにちは、

私はここ%sに招待します。

プロフィールリンク：%s

宜しくお願いします。
%s',
	'com:ossn:invite:sent' => '友達が招待されました。 送信された招待状： %s.',
	'com:ossn:invite:wrong:emails' => '次のアドレスは無効です： %s.',
	'com:ossn:invite:sent:failed' => '次のアドレスを招待できません： %s.',
	'com:ossn:invite:already:members' => '次のアドレスは既にメンバーです： %s',
	'com:ossn:invite:empty:emails' => '少なくとも1つのメールアドレスを追加してください',
);
ossn_register_languages('ja', $ja); 
