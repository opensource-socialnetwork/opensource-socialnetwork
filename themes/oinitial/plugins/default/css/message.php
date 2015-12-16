.ossn-messages {
	width: 735px;
	height: 420px;
}
.ossn-messages .messages-from{
	display: inline-table;
	width: 216px;
	border: 1px solid #ddd;
	height: 574px;
}
.ossn-messages .messages-from .title {
	border-bottom: 1px solid #ddd;
	padding:14px;

}
.ossn-messages .messages-from .title a{
	font-weight: bold;

}
.ossn-messages .message-with{
	display: inline-block;
	width: 512px;
	border: 1px solid #ddd;
	min-height: 200px;
	float: right;
}
.ossn-messages .message-with .title {
	padding: 17px;
	font-size: 16px;
	font-weight: bold;
	border-bottom: 1px solid #ddd;
}
.ossn-messages .message-with .message-form {
	background:#F2F2F2;
	height:150px;
	width:100%;
}
.ossn-messages .message-with .messages-inner {
	height:369px;
	overflow:hidden;
	overflow-y:scroll;
}
.ossn-messages .message-form textarea {
	outline:none;
	width: 471px;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
	border-top: 1px solid #ccc;
	resize: none;
	padding: 4px;
	height:75px;
}
.ossn-messages .message-form .message-form-form {
	padding: 22px;
}
.ossn-messages .message-form .message-form-form .controls{
	background: #fff;
	border-top: 1px solid #eee;
	border-bottom: 1px solid #ccc;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
	height: 0px;
	margin-top: -2px;
	width: 479px;
}
.ossn-messages
.message-form
.message-form-form
.controls input[type='submit']{
	float: right;
	cursor: pointer;
	border: 1px solid #3d5e74;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	font-size: 12px;
	font-family: arial, helvetica, sans-serif;
	padding: 8px 8px 8px 8px;
	text-decoration: none;
	display: inline-block;
	text-shadow: -1px -1px 0 rgba(0,0,0,0.3);
	font-weight: bold;
	color: #FFFFFF;
	background-color: #507C99;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#507C99), to(#3C5D73));
	background-image: -webkit-linear-gradient(top, #507C99, #3C5D73);
	background-image: -moz-linear-gradient(top, #507C99, #3C5D73);
	background-image: -ms-linear-gradient(top, #507C99, #3C5D73);
	background-image: -o-linear-gradient(top, #507C99, #3C5D73);
	background-image: linear-gradient(to bottom, #507C99, #3C5D73);
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#507C99, endColorstr=#3C5D73);
}
.ossn-messages
.message-form
.message-form-form
.controls input[type='submit']:hover{
	border: 1px solid #2d4656;
	background-color: #38586B;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#38586B), to(#2F495A));
	background-image: -webkit-linear-gradient(top, #38586B, #2F495A);
	background-image: -moz-linear-gradient(top, #38586B, #2F495A);
	background-image: -ms-linear-gradient(top, #38586B, #2F495A);
	background-image: -o-linear-gradient(top, #38586B, #2F495A);
	background-image: linear-gradient(to bottom, #38586B, #2F495A);
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#38586B, endColorstr=#2F495A);
}
.message-item {
	padding:10px;
}
.message-item img{
	display:inline-table;
	width:32px;
	height:32px;
	float: left;
	margin-right: 6px;
}
.message-item .data{
	display:inline-table;
	width: 436px;
}
.message-item .data .name {
	margin-left: 5px;
}
.message-item .text {
	margin-left: 5px;
	font-size: 13px;
}
.message-item .data .name a{
	font-size: 13px;
	font-weight: bold;
}
.messate-item .data .text {
	width: 460px;
}
.messages-from .inner .user-item {
	padding: 4px;
	border-bottom: 1px solid #eee;
}
.messages-from .inner .user-item:hover {
	background:#F6F7F8;
	cursor:pointer;
}
.messages-from .inner .message-new {
	background:#eee;
}
.messages-from .inner .user-item .image {
	display:inline-table;
	width:50px;
	height:50px;
}
.messages-from .inner .user-item .data{
	display:inline-table;
	float:right;
	width: 139px;
}
.messages-from .inner .user-item .data .name{
	font-size: 13px;
	font-weight: bold;
	padding: 3px;
}
.ossn-arrow-back {
	background:url("<?php echo ossn_site_url(); ?>components/OssnMessages/images/backward-arrow.png");
	width:9px;
	height:9px;
	margin-top: -6px;
	margin-left: 4px;
}
.reply-text {
	margin-top: -12px;
	margin-left: 17px;
}
.reply-text-from {
	margin-top: -12px;
	margin-left: 4px;
}
.messages-from .time {
	color: #999;
	float:right;
}
.ossn-notification-messages  .user-item {
	padding: 4px;
	border-bottom: 1px solid #eee;
}
.ossn-notification-messages .user-item:hover {
	background:#F6F7F8;
	cursor:pointer;
}
.ossn-notification-messages .message-new {
	background:#eee;
}
.ossn-notification-messages  .user-item .image {
	display:inline-table;
	width:50px;
	height:50px;
}
.ossn-notification-messages .user-item .data{
	display:inline-table;
	float:right;
	width: 340px;
}
.ossn-notification-messages .user-item .data .name{
	font-size: 13px;
	font-weight: bold;
	padding: 3px;
}
.ossn-notification-messages .user-item-inner .time {
	color: #999;
	float:right;
}
.user-item-inner {
	padding: 5px;
}
.message-none {
	font-size: 13px;
	width: 735px;
	border: 1px solid #eee;
	height: 200px;
}
.message-none div {
	font-size: 14px;
	padding: 25px;
}
.message-form-form input[type='submit']{
	margin-top:10px;
}
.message-form-form .ossn-loading {
	margin-top:10px;
    float:right;
}
.messages-from .inner {
    height: 532px;
    overflow: hidden;
    overflow-y:scroll;
}
