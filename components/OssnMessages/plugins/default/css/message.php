.ossn-messages {
	background: #fff;
	padding: 10px;
}

.ossn-messages .messages-recent .widget-contents {
	padding: 0px;
}

.ossn-messages .messages-recent .messages-from {
	max-height: 555px;
	overflow-x: hidden;
	overflow-y: auto;
}

.ossn-messages .messages-recent .messages-from .user-item {
	padding: 10px;
	margin: 0px;
	cursor: pointer;
	border-bottom: 1px solid #eee;
}

.ossn-messages .messages-recent .messages-from .user-item .image {
	margin-top: 3px;
	border-radius: 16px;
}

.ossn-messages .messages-recent .messages-from .user-item .name {
	font-weight: bold;
	display: inline-block;
	font-size: 13px;
}

.ossn-messages .messages-recent .messages-from .message-new {
	background: #F7F7F7;
}

.ossn-messages .messages-recent .messages-from .user-item .col-md-10,
.ossn-messages .messages-recent .messages-from .user-item .col-md-2 {
	padding: 0px;
}

.ossn-messages .messages-recent .messages-from .user-item .reply {
	margin-top: -4px;
	font-size: 13px;
}

.ossn-notification-messages .fa-reply,
.ossn-messages .messages-recent .messages-from .user-item .reply .fa-reply {
	font-size: 10px;
	display: inline-block;
	margin-top: 0px;
}

.ossn-messages .messages-recent .messages-from .user-item .reply .reply-text {
	display: inline-block;
}

.ossn-messages .messages-recent .messages-from .user-item .time {
	display: inline-block;
	float: right;
}

.ossn-messages .message-with  .user-icon {
	margin-top: 9px;
	border-radius: 25px;
}

.ossn-messages. message-form-form .textarea {
}

.ossn-messages .message-inner {
	max-height: 400px;
	padding-right: 20px;
	overflow-y: auto;
	overflow-x: hidden;
}

.ossn-messages .message-inner .row {
    /*margin-left: -10px;*/;
}

.message-form-form {
	margin-top: 10px;
	border-top: 1px solid #eee;
	padding: 10px 10px 0;
}

.ossn-messages .message-with .time-created {
	float: right;
	margin-left: 5px;
}
/*************************
	Notifications
**************************/

.ossn-notification-messages  .user-item {
	padding: 4px;
	border-bottom: 1px solid #eee;
}

.ossn-notification-messages .user-item:hover {
	background: #F6F7F8;
	cursor: pointer;
}

.ossn-notification-messages .message-new {
	background: #eee;
}

.ossn-notification-messages  .user-item .image {
	display: inline-table;
	width: 50px;
	height: 50px;
}

.ossn-notification-messages .user-item .data {
	float: right;
	width: 335px;
}

.ossn-notification-messages .user-item .data .name {
	font-size: 13px;
	font-weight: bold;
	padding: 3px;
	margin-top: -3px;
	text-overflow: ellipsis;
	width: 210px;
	white-space: nowrap;
	overflow: hidden;
}

.ossn-notification-messages .user-item-inner .time {
	color: #999;
	float: right;
	font-size: 14px;
	font-style: italic;
	margin-top: -24px;
}

.ossn-notification-messages .reply-text,
.ossn-notification-messages .reply-text-from {
	margin-top: -0px;
	margin-left: 4px;
	text-overflow: ellipsis;
	width: 320px;
	white-space: nowrap;
	overflow: hidden;
	display: inline;
}

.ossn-notification-messages .messages-from .time {
	color: #999;
	float: right;
}

.ossn-notification-messages .user-item-inner {
	padding: 5px;
}
/************************
	v4.0 chat message
*************************/
.message-box-recieved {
	background-color: #F2F2F2;
	display: inline-block;
	padding: 5px 18px;
	position: relative;
	vertical-align: top;
	float: left;
	margin: 10px 0px 10px 10px;
	word-break: break-word;
	text-align: justify;
	border-radius: 15px;
	box-shadow: 0 1px 0 #c9d4bc;
}

.message-box-sent {
	word-break: break-word;
	text-align: justify;
	float: right;
	background-color: #dfeecf;
	display: inline-block;
	padding: 5px 18px;
	position: relative;
	vertical-align: top;
	margin: 10px 0px;
	border-color: #cdecb0;
	border-radius: 15px;
	box-shadow: 0 1px 0 #c9d4bc;
}

.messages-with .widget-contents {
	padding: 10px 0px;
}
/*** Pagination ***/
.ossn-messages .messages-recent .messages-from .inner .pagination {
	margin: 10px;
}

.ossn-messages .ossn-widget .message-with .message-inner .container-table-pagination .pagination {
	margin: 0;
}

.ossn-messages .ossn-widget .message-with .message-inner .container-table-pagination,
.ossn-notification-messages .container-table-pagination,
.ossn-messages .messages-recent .messages-from .inner .container-table-pagination {
	visibility: hidden;
}

.ossn-messages .messages-recent .messages-from .inner .ossn-pagination .ossn-loading {
	margin: 0 auto;
}

.ossn-messages-notification-pagination-loading .ossn-loading,
.ossn-messages-pagination-loading .ossn-loading,
.ossn-messages-with-pagination-loading .ossn-loading {
	margin: 0 auto;
}

.ossn-messages-pagination-loading {
	display: block;
	margin-top: -40px;
}

.ossn-messages-with-pagination-loading {
	display: block;
	margin-top: 10px;
}

.ossn-messages-notification-pagination-loading {
	display: block;
	margin-top: -55px;
}

.ossn-message-delete {
	margin-left: 10px;
	color: #c77878 !important;
	visibility: hidden;
	cursor: pointer;
}

.message-box-recieved:hover .ossn-message-delete,
.message-box-sent:hover .ossn-message-delete {
	visibility: visible;
}

.ossn-message-deleted span {
	font-style: italic;
	color: #d27a7a;
}

#ossn-message-delete-form .ossn-loading {
	margin: 40px auto;
}

.message-with .ossn-message-show-image-attachment {
	max-width: 200px;
}

.ossn-message-attach-photo:hover,
.ossn-message-icon-attachment:hover {
	background: #eee;
}

.ossn-message-attach-photo,
.ossn-message-icon-attachment {
	float: right;
	width: 30px;
	height: 30px;
	cursor: pointer;
	border-radius: 50%;
	text-align: center;
}

.ossn-message-icon-attachment:before {
	content: "\f0c6";
	font-family: 'Font Awesome 5 Free';
	font-style: normal;
	font-weight: bold;
	font-size: 20px;
	color: #0b769c;
}

.ossn-message-attach-photo .fa-smile {
	font-style: normal;
	font-weight: bold;
	font-size: 20px;
	color: #0b769c;
	margin-top: 0px !important;
}

.ossn-messages .widget-heading {
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;
}

#message-with-user-widget {
	border-left: 1px solid #eee;
}

#message-with-user-widget .widget-heading .user-icon-smaller {
	border-radius: 50%;
	float: left;
	margin-top: -5px;
	margin-right: 5px;
}

.ossn-omessage-attachment-remove {
	color: red;
	float: right;
	cursor: pointer;
}

.ossn-omessage-attachment-name {
	max-width: 250px;
	white-space: nowrap;
	display: inline-block;
	overflow: hidden;
	text-overflow: ellipsis;
}
.ossn-inmessage-status-circle {
    position: absolute;
    margin-left: -18px;
    margin-top: 11px;
    border-radius: 100%;
    border: 2px solid white;
    height: 12px;
    width: 12px;
}

.ossn-inmessage-status-offline .ossn-inmessage-status-circle {
	background:#D23636;
}
.ossn-inmessage-status-online .ossn-inmessage-status-circle {
    background: #4cae4c;
}

.ossn-message-delete-conversation {
    float: right;
    color: #ec2828;
}
#ossn-message-delete-conv-form .ossn-loading {
    margin: 45px auto;
}
.ossn-msgrecent-check-read.fa.fa-check {
    font-size: 10px;
    color: #53bdeb;
    margin-left: 5px;
}
.ossn-recent-message-status-offline .ossn-inmessage-status-circle {
		background: #D23636;
}
.ossn-recent-message-status-online .ossn-inmessage-status-circle {
		background: #4cae4c;
}
.ossn-recent-message-item .ossn-inmessage-status-circle {
    position: absolute;
    margin-left: -13px;
    margin-top: 20px;
    border-radius: 100%;
    border: 2px solid white;
    height: 12px;
    width: 12px;
}
.msg-flex-c1 {
	position:relative;
}
.msg-flex-c2 {
	width:100%;
    margin-left:10px;
}
.ossn-recent-messages-toggle i {
	margin-right:0px;
    margin-top: 6px;
}
.ossn-recent-messages-toggle {
	text-align: center;
    float: right;
    background: transparent;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    cursor:pointer;
}
.ossn-recent-messages-toggle:hover {
	background:#fff;
}
.ossn-messages-select-conv {
	font-size: 5rem;
    color: #999;
}