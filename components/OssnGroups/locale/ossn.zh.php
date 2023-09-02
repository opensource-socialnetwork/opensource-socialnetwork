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
    'groups' => '群組',
    'add:group' => '新增群組',
    'requests' => '加入群組申請',

    'members' => '成員',
    'member:add:error' => '發生了點問題! 請稍後再試一次.',
    'member:added' => '已同意加入群組!',

    'member:request:deleted' => '加入群組申請被拒絶!',
    'member:request:delete:fail' => '無法拒絶加入群組請求! 請稍後再試一次.',
    'membership:cancel:succes' => '加入群組申請已取消!',
    'membership:cancel:fail' => '無法取消加入群組請求! 請稍後再試一次.',

    'group:added' => '群組已建立!',
    'group:add:fail' => '無法建立群組! 請稍後再試一次.',

    'memebership:sent' => '加入群組申請已送出!',
    'memebership:sent:fail' => '無法送出申請! 請稍後再試一次.',

    'group:updated' => '群組設定已經更新!',
    'group:update:fail' => '無法更新群組設定! 請稍後再試一次.',

    'group:name' => '群組名稱',
    'group:desc' => '群組描述',
    'privacy:group:public' => '所有人可以看到貼文. 但只有成員能張貼.',
    'privacy:group:close' => '所有人可以看到群組. 但只有成員可以看到貼文及張貼.',

    'group:memb:remove' => '移出群組',
    'group:memb:make:owner' => '設定為群組管理員',
    'group:memb:make:owner:confirm' => '注意! 這個動作將設定 >> %s << 為新的群組管理員你將會失去群組的管理權限. 你確定要執行嗎?',
    'group:memb:make:owner:admin:confirm' => '注意! 這個動作將設定 >> %s << 為新的群組管理員,原管理員將會失去群組的管理權限. 你確定要執行嗎?',
    'leave:group' => '退出群組',
    'join:group' => '加入群組',
    'total:members' => '總共成員',
    'group:members' => "成員 (%s)",
    'view:all' => '瀏覽所有申請',
    'member:requests' => '加入群組申請 (%s)',
    'about:group' => '關於群組',
    'cancel:membership' => '取消加入',

    'no:requests' => '沒有申請',
    'approve' => '允許',
    'decline' => '拒絕',
    'search:groups' => '搜尋群組',

    'close:group:notice' => '加入這個群組後可以 張貼文章,張貼照片及回覆留言.',
    'closed:group' => '關閉群組',
    'group:admin' => 'Admin',
	
	'title:access:private:group' => '群組貼文',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s 申請加入 %s 群組',
	'ossn:group:by' => '管理員:',
	
	'group:deleted' => '群組及群組的內容已被刪除',
	'group:delete:fail' => '無法刪除群組',

	'group:delete:cover' => '刪除封面圖片',
	'group:delete:cover:error' => '發生錯誤無法刪除封面圖片',
	'group:delete:cover:success' => '封面圖片已刪除',

);
ossn_register_languages('zh', $zh); 
