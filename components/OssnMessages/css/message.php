.ossn-messages {
 width: 735px;
 height: 420px;
}
.ossn-messages .messages-from{
display: inline-table;
width: 200px;
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
display: inline-table;
width: 527px;
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
 height:120px;
 width:100%;
 
}

.ossn-messages .message-with .messages-inner {
  height:400px;	
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
	height:40px;
	
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

height: 30px;
margin-top: -2px;
width: 479px;
}

.ossn-messages 
.message-form 
.message-form-form
.controls input[type='submit']{
float: right;
background: #fff;
padding: 7px;
border-left: 1px solid #eee;
}
.ossn-messages 
.message-form 
.message-form-form
.controls input[type='submit']:hover{
background: #F8FAFC;
cursor:pointer;
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
 width: 450px;
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
	background:url("<?php echo ossn_site_url();?>components/OssnMessages/images/backward-arrow.png");
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
.ossn-arrow-back {
	background:url(<?php echo ossn_site_url();?>components/OssnMessages/images/backward-arrow.png");
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
.ossn-notification-messages .user-item-inner .time {
 color: #999;	
 float:right;
}
.user-item-inner {
padding: 5px;
}