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
$ko = array(
	'com:ossn:invite' => '초대',			
	'com:ossn:invite:friends' => '친구 초대',
	'com:ossn:invite:friends:note' => '친구를 초대하시려면 친구분의 이메일 주소와 간단한 초대 문구를 넣어 주세요. 친구분은 초대장을 담은 이메일을 받으실 거에요.',
	'com:ossn:invite:emails:note' => '이메일 주소 (쉼표로 구분하세요)',
	'com:ossn:invite:emails:placeholder' => 'myfriend@example.com, bestfriend@example.com',
	'com:ossn:invite:message' => '초대 문구',
		
    	'com:ossn:invite:mail:subject' => ' %s 에 초대합니다.',	
    	'com:ossn:invite:mail:message' => '안녕하세요.  %s 에 초대합니다.  %s 님께서 아래와 같이 보내셨습니다. 

%s

초대에 응하시려면 아래를 눌러주세요.

%s

보내신 분: %s
',	
	'com:ossn:invite:mail:message:default' => '안녕하세요,

 %s 에서 보고 싶습니다.

보내신 분 : %s

행복하세요.
%s',
	'com:ossn:invite:sent' => '친구 %s 명에게 초대장을 보냈습니다.',
	'com:ossn:invite:wrong:emails' => ' %s 이메일 주소는 유효하지 않습니다.',
	'com:ossn:invite:sent:failed' => ' %s 이메일 주소로 초대장을 보낼 수 없습니다.',
	'com:ossn:invite:already:members' => ' %s 님은 이미 가입하셨습니다 ',
	'com:ossn:invite:empty:emails' => '이메일 주소 하나 정도는 입력해 주세요',
);
ossn_register_languages('ko', $ko); 
