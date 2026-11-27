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
$zh = array(
		'ossnaddressbook:menu'               => '通讯录',
		'ossnaddressbook:title'              => '通讯录',
		'ossnaddressbook:subtitle:contacts'  => '位联系人',
		'ossnaddressbook:subtitle:favorites' => '位收藏',
		'ossnaddressbook:search:placeholder' => '按姓名、电话、邮箱或公司搜索联系人...',
		'ossnaddressbook:add'                => '添加联系人',
		'ossnaddressbook:add:toggle'         => '新建联系人',
		'ossnaddressbook:name:placeholder'   => '姓名 *',
		'ossnaddressbook:phone:placeholder'  => '电话 / WhatsApp',
		'ossnaddressbook:email:placeholder'  => '电子邮箱',
		'ossnaddressbook:company:placeholder' => '公司 / 组织',
		'ossnaddressbook:address:placeholder' => '地址 / 城市',
		'ossnaddressbook:note:placeholder'   => '个人备注（可选）...',
		'ossnaddressbook:category'           => '分组',
		'ossnaddressbook:category:all'       => '全部',
		'ossnaddressbook:category:favorites' => '收藏',
		'ossnaddressbook:category:personal'  => '个人',
		'ossnaddressbook:category:work'      => '工作',
		'ossnaddressbook:category:family'    => '家人',
		'ossnaddressbook:category:other'     => '其他',
		'ossnaddressbook:favorite'           => '收藏',
		'ossnaddressbook:edit'               => '编辑',
		'ossnaddressbook:save'               => '保存',
		'ossnaddressbook:cancel'             => '取消',
		'ossnaddressbook:delete'             => '删除',
		'ossnaddressbook:delete:all'         => '全部删除',
		'ossnaddressbook:delete:all:confirm' => '您确定要删除所有联系人吗？此操作无法撤销。',
		'ossnaddressbook:empty'              => '您的通讯录为空。请在上方添加第一个联系人！',
		'ossnaddressbook:add:error'          => '无法添加联系人。请输入姓名。',
		'ossnaddressbook:edit:error'         => '无法更新联系人。',
		'ossnaddressbook:delete:error'       => '无法删除联系人。',
		'ossnaddressbook:import'             => '导入',
		'ossnaddressbook:export:csv'         => '导出 CSV',
		'ossnaddressbook:export:vcf'         => '导出 vCard',
		'ossnaddressbook:import:success'     => '已成功导入 %s 位联系人。',
		'ossnaddressbook:import:error'       => '请选择要导入的 CSV 或 vCard (.vcf) 文件。',
		'ossnaddressbook:import:invalid'     => '不支持的文件格式。仅允许 .csv 和 .vcf 文件。',
		'ossnaddressbook:import:empty'       => '在上传的文件中未找到有效联系人。',
);
ossn_register_languages('zh', $zh);
