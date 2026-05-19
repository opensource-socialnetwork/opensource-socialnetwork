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
		'ossnads'                       => '广告管理器',
		'fields:required'               => '所有字段均为必填项！',
		'ad:created'                    => '广告已成功创建！',
		'ad:create:fail'                => '无法创建广告！',
		'ad:title'                      => '标题',
		'ad:site:url'                   => '网站网址',
		'ad:desc'                       => '描述',
		'ad:photo'                      => '照片',
		'ad:browse'                     => '浏览',
		'ad:clicks'                     => '点击量',
		'sponsored'                     => '赞助广告',
		'ad:deleted'                    => "标题为 '%s' 的广告已成功删除。",
		'ad:delete:fail'                => '无法删除广告！请稍后再试。',
		'ad:edited'                     => '广告修改成功。',
		'ad:edit:fail'                  => '无法编辑广告！请稍后再试。',
		'ads:manager'                   => '广告管理',
		'ads:boost:community'           => '助力您的社区。创建新的广告活动或管理现有广告。',
		'ads:create'                    => '创建广告',

		'ad:placement'                  => '广告投放位置',
		'ad:gender:target'              => '受众性别定向',
		'ad:end:date'                   => '广告活动结束日期（选填）',
		'ad:photo'                      => '横幅广告图片',
		'add'                           => '创建广告活动',

		'ad:placement:newsfeed'         => '动态消息（侧边栏）',
		'ad:placement:profile'          => '用户个人主页（侧边栏）',
		'ad:placement:groups'           => '群组页面（侧边栏）',
		'ad:placement:global'           => '所有其他主题侧边栏（全局）',

		'ad:file:choose'                => '选择或将广告图片拖拽到此处...',
		'ad:file:restriction'           => '仅限图片文件（PNG, JPG, WebP）',
		'ad:file:remove'                => '移除图片',
		'ad:char:left'                  => '还可输入 %s 个字符',
		'ad:status:expired'             => '已过期',
		'ad:status:active'              => '投放中',
		'ad:views'                      => '展现量',
		'ad:status'                     => '状态',
		'ad:end:date:infinity'          => '永不过期',

		//cron
		'ossn:adscron:title'            => '必要设置：自动处理广告过期',
		'ossn:adscron:last:run'         => '上次 Cron 运行时间：',
		'ossn:adscron:never'            => '从未运行',
		'ossn:adscron:configure'        => '配置',
		'ossn:adscron:description'      => '为了自动将广告状态切换为 %s，您必须配置系统 Cron 定时任务，使其在每天中午（12:00 PM）运行一次。',
		'ossn:adscron:expired'          => '已过期',
		'ossn:adscron:command:label'    => 'Crontab 命令',
		'ossn:adscron:path:placeholder' => '您的服务器_PHP_路径',
		'ossn:adscron:warning:title'    => '重要提示：',
		'ossn:adscron:warning:text'     => '广告一旦过期，将 %s。广告主必须重新创建新广告。',
		'ossn:adscron:cannot:edit'      => '无法被编辑或续期',
);
ossn_register_languages('zh', $zh); 