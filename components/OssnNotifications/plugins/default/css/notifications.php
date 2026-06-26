/***** <style> **********/
/***********************************
	Ossn Notifications
***************************************/

.ossn-notifications-box .collapsing {
	-webkit-transition: none;
	transition: none;
	display: none;
}

.ossn-notifications-box {
	width: 430px;
	color: #000;
	position: absolute;
	top: 100%;
	right: 20px;
	z-index: 1000;
	display: none;
	float: left;
	min-width: 160px;
	padding: 5px 0;
	margin: 2px 0 0;
	font-size: 14px;
	text-align: left;
	list-style: none;
	background-color: #fff;
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
	border: 1px solid #ccc;
	border: 1px solid rgba(0, 0, 0, .15);
	border-radius: 5px;
	-webkit-box-shadow: 0 6px 12px rgb(0 0 0 / 18%);
	box-shadow: 0 6px 12px rgb(0 0 0 / 18%);
	border-bottom-left-radius: 7px;
	border-bottom-right-radius: 7px;
}

.ossn-notifications-box .notificaton-item {
	border-bottom: 1px solid #eee;
}

.ossn-notifications-box .notificaton-item:hover,
.ossn-notifications-box .notificaton-item .active {
	background-color: #F9F9F9;
}

.ossn-notifications-box .type-name {
	font-size: 13px;
	font-weight: bold;
	padding: 1px 10px 5px 10px;
	color: #000;
	height: 25px;
	border-bottom: 1px solid #DDDDDD;
}

.ossn-notification-box-loading {
	margin: 0 auto;
	margin-top: 20px;
	margin-bottom: 20px;
}

.ossn-no-notification {
	text-align: center;
	padding: 10px;
}

.ossn-notifications-box .type-name .title {
	display: inline-block;
}

.ossn-notifications-box .type-name .links {
	display: inline-block;
	float: right;
}

.ossn-notifications-box .type-name .links a {
	color: #337ab7;
	display: inline;
	font-weight: normal;
}

.ossn-notifications-box .notification-image,
.ossn-notifications-box .notification-image img {
	width: 50px;
	height: 50px;
}

.ossn-notifications-all a {
	padding: 10px;
}

.ossn-notifications-box .bottom-all a,
.ossn-notifications-box .notfi-meta strong {
	color: #337ab7;
}

.ossn-notifications-box .notfi-meta {
	width: 330px;
	margin-left: 5px;
	display: inline-block;
	float: right;
	color: #000;
}

.ossn-notifications-box .bottom-all a {
	font-weight: bold;
}

.ossn-notifications-box .bottom-all {
	background: #F7F7F7;
	text-align: center;
	padding: 0px;
	padding-top: 10px;
	display: block;
	height: 40px;
	border-top: 1px solid #eee;
	border-bottom-left-radius: 7px;
	border-bottom-right-radius: 7px;
}

.ossn-notifications-box .metadata {
	margin-bottom: -5px;
}

.ossn-notifications-box .messages-inner {
	max-height: 400px;
	overflow: hidden;
	overflow-y: scroll;
}

.latest-users img {
	margin-bottom: 5px;
}

.ossn-notification-mark-read {
	float: right;
}

.ossn-notif-delete-item i {
	margin-right: 0;
	font-size: initial !important;
	margin-top: initial !important;
}

.ossn-notif-delete-item {
	position: absolute;
	right: 0;

	top: 0;
	margin-top: 0px;
	background: #fff;
	width: 30px;
	height: 30px;
	text-align: center;
	border: 1px solid #eee;
	border-radius: 100%;

	display: flex;
	align-items: center;
	justify-content: center;
	box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.ossn-notif-delete-item {
	opacity: 0;
	transform: scale(0.8);
	transition: all 0.3s ease;
	pointer-events: none;
	/* prevent accidental clicks when hidden */
}

/* Show on hover of the <a> inside <li> */
.ossn-notifications-all li a:hover .ossn-notif-delete-item {
	opacity: 1;
	transform: scale(1);
	pointer-events: auto;
}

.ossn-notifications-all li {
	display: block;
}

.ossn-notifications-all a:hover {
	cursor: pointer;
	background-color: transparent;
	text-decoration: none;
}

.ossn-notifications-box li:hover,
.ossn-notifications-box a:hover,
.ossn-notifications-all a:hover,
.ossn-notifications-all li:hover {
	background: #F9F9F9;
}

.ossn-notification-container {
	background-color: #dc0d17;
	background-image: -webkit-linear-gradient(#fa3c45, #dc0d17);
	color: #fff;
	min-height: 13px;
	padding: 1px 3px;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, .4);
	-webkit-border-radius: 2px;
	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .7);
	-webkit-background-clip: padding-box;
	display: inline-block;
	font-size: 11px;
	line-height: normal;
	position: absolute;
	margin-left: -10px;
	z-index: 1;
}

.notification-friends .image {
	width: 50px;
	height: 50px;
	display: inline-table;
	float: left;
}

.ossn-notifications-friends-inner a {
	color: #0f3b4a !important;
	display: inline-block !important;
}

.ossn-notifications-friends-inner {
	padding: 0px 5px;
}

.ossn-notifications-friends-inner form {
	display: inline-table;
}

.ossn-notification-page li img {
	display: none;
}

.notification-friends li {
	width: 100%;
	border-bottom: 1px solid #eee;
}

.notification-friends .notfi-meta a {
	color: #337ab7;
	font-weight: bold;
	display: inline-block;
	width: 200px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.ossn-notifications-friends-inner .controls {
	float: right;
	margin-top: 6px;
	display: inline-block;
}

.friends-added-text {
	/**float: left !important;
    margin-top: -18px !important;
    display: block !important;
    margin-left: 10px; **/
	font-size: 13px;
}

.ossn-notifications-friends-inner .btn {
	padding: 3px 9px;
	border-radius: 1px;
}

.notification-friends {
	max-height: 400px;
}

.ossn-notification-icon-comment {
	display: inline-block;
}

.ossn-notification-icon-comment:before {
	content: "\f075";
	font-family: 'Font Awesome 5 Free';
	font-style: normal;
	font-weight: 900;
	font-size: 18px;
}

.ossn-notification-icon-tag {
	display: inline-block;
}

.ossn-notification-icon-tag:before {
	content: "\f507";
	font-family: 'Font Awesome 5 Free';
	font-style: normal;
	font-weight: 900;
	font-size: 18px;
}

.ossn-notification-icon-like {
	display: inline-block;
}

.ossn-notification-icon-like:before {
	content: "\f164";
	font-family: 'Font Awesome 5 Free';
	font-style: normal;
	font-weight: normal;
	font-size: 18px;
}

.ossn-notification-icon-like-post:before {
	display: inline-block;
}

.ossn-notification-icon-like-post:before {
	content: "\f087";
	font-family: 'Font Awesome 5 Free';
	font-style: normal;
	font-weight: 900;
	font-size: 18px;
}

.ossn-notifications-all .data {
	display: inline;
	margin-left: 5px;
}

.ossn-notification-friend-submit {
	background: #FFF9D7;
}

.menu-section-item-notifications:before {
	content: "\f0f3" !important
}

.ossn-notifications-all .time-created {
	font-weight: bold;
	font-size: 13px;
	margin-left: 10px;
}

@media (max-width: 480px) {
	/***************************
    	Topbar notification box
   *****************************/
	.ossn-notifications-box {
		width: 300px !important;
	}

	.ossn-notifications-box .notfi-meta {
		width: 210px;
	}

	.notification-friends .notfi-meta a {
		width: 100px;
	}

	.ossn-notification-messages .user-item .data {
		width: 215px !important;
	}

	.ossn-notification-messages .user-item .data .name {
		width: 110px !important;
	}

	.ossn-notification-messages .reply-text-from {
		width: 200px !important;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
}