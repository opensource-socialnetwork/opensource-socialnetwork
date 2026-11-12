/*************************************************
	FBUI Notifications & Counter Badge Only
**************************************************/

/* 1. Positioning Anchor */
.topbar-menu-right {
	position: relative !important;
}

#ossn-notif-friends,
#ossn-notif-messages,
#ossn-notif-notification,
.topbar-menu-right > ul > li {
	position: relative !important;
}

/* 2. Red Notification Badge Bubble */
.topbar-menu-right .ossn-notification-container,
#ossn-notif-friends .ossn-notification-container,
#ossn-notif-messages .ossn-notification-container,
#ossn-notif-notification .ossn-notification-container {
	background-color: #e41e3f !important;
	background-image: none !important;
	color: #ffffff !important;
	min-width: 19px !important;
	height: 19px !important;
	border-radius: 10px !important;
	font-size: 11px !important;
	font-weight: 700 !important;
	line-height: 19px !important;
	text-align: center !important;
	text-shadow: none !important;
	box-shadow: 0 0 0 2px #ffffff !important; /* White ring border */
	position: absolute !important;
	top: -3px !important;
	right: -3px !important;
	left: auto !important;
	margin: 0 !important;
	padding: 0 5px !important;
	z-index: 100 !important;
	align-items: center !important;
	justify-content: center !important;
	box-sizing: border-box !important;
	width: auto !important;
}

/* Hide Empty / Disabled Badges */
.ossn-notification-container.d-none,
.ossn-notification-container[style*="display: none"],
.ossn-notification-container[style*="display:none"] {
	display: none !important;
}

/* 3. Outer Notification Box Container */
#notificationBox {
	position: absolute !important;
	top: 52px !important;
	right: 0 !important;
	left: auto !important;
	z-index: 1060 !important;
	margin: 0 !important;
	padding: 0 !important;
}

/* 4. Notification Flyout Card */
.topbar-menu-right .ossn-notifications-box {
	width: 380px !important;
	max-width: 90vw !important;
	background: #ffffff !important;
	border-radius: 8px !important;
	box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.1) !important;
	border: 1px solid rgba(0, 0, 0, 0.1) !important;
	padding: 12px 8px !important;
	margin: 0 !important;
	box-sizing: border-box !important;
    display:none;
}

/* Hide OSSN's raw pointer arrow */
.topbar-menu-right .ossn-notifications-box .selected {
	display: none !important;
}

/* 5. Title Header ("Notifications" + "Mark all as read") */
.topbar-menu-right .ossn-notifications-box .type-name {
	font-size: 20px !important;
	font-weight: 700 !important;
	color: #050505 !important;
	display: flex !important;
	align-items: center !important;
	justify-content: space-between !important;
	padding: 4px 8px 12px 8px !important;
	border-bottom: 1px solid #ced0d466 !important;
	height: auto !important;
	line-height: 1.2 !important;
	margin-bottom: 8px !important;
}

.topbar-menu-right .ossn-notifications-box .type-name a.ossn-notification-mark-read {
	font-size: 14px !important;
	font-weight: 600 !important;
	color: #0866ff !important;
	text-decoration: none !important;
	float: none !important;
}

.topbar-menu-right .ossn-notifications-box .type-name a.ossn-notification-mark-read:hover {
	text-decoration: underline !important;
}

/* 6. List Inner Container Reset */
.topbar-menu-right .messages-inner {
	max-height: 400px !important;
	overflow-y: auto !important;
}

.topbar-menu-right .ossn-notifications-all {
	list-style: none !important;
	padding: 0 !important;
	margin: 0 !important;
}

.topbar-menu-right .ossn-notifications-all li {
	list-style: none !important;
	margin: 2px 0 !important;
	padding: 0 !important;
	background: transparent !important;
	display: block !important;
	width: 100% !important;
	height: auto !important;
}

/* Unread Notifications Accent Highlight */
.topbar-menu-right .ossn-notifications-all li.ossn-notification-unviewed {
	background: #e7f3ff !important;
	border-radius: 8px !important;
}

/* 7. Individual Notification Row Anchor */
.topbar-menu-right .ossn-notification-item-a {
	display: flex !important;
	align-items: center !important;
	padding: 10px !important;
	border-radius: 8px !important;
	text-decoration: none !important;
	color: #050505 !important;
	transition: background 0.2s ease !important;
	position: relative !important;
	width: 100% !important;
	height: auto !important;
	box-sizing: border-box !important;
}

.topbar-menu-right .ossn-notification-item-a:hover {
	background: #f2f2f2 !important;
}

/* 8. Notification User Avatar */
.topbar-menu-right .notification-image,
.topbar-menu-right .notification-image img {
	width: 50px !important;
	height: 50px !important;
	border-radius: 50% !important;
	object-fit: cover !important;
	min-width: 50px !important;
}

/* 9. Meta Text Content Formatting */
.topbar-menu-right .notfi-meta {
	width: calc(100% - 62px) !important;
	padding-right: 30px !important;
	margin-left: 8px !important;
	font-size: 14px !important;
	line-height: 1.35 !important;
	color: #050505 !important;
	display: flex !important;
	flex-direction: column !important;
	align-items: flex-start !important;
	justify-content: center !important;
	float: none !important;
}

.topbar-menu-right .notfi-meta .data {
	display: block !important;
	margin: 0 !important;
}

.topbar-menu-right .notfi-meta strong {
	color: #050505 !important;
	font-weight: 600 !important;
}

.topbar-menu-right .time-created {
	display: block !important;
	font-size: 12px !important;
	color: #65676b !important;
	font-weight: 400 !important;
	margin-top: 2px !important;
	margin-left: 0 !important;
}

/* Hide empty inline icons interefering with text flow */
.topbar-menu-right .ossn-notification-icon-comment,
.topbar-menu-right .ossn-notification-icon-like {
	display: none !important;
}

/* 10. Hover Trash Button */
.topbar-menu-right .ossn-notif-delete-item {
	position: absolute !important;
	right: 8px !important;
	top: 50% !important;
	transform: translateY(-50%) !important;
	width: 32px !important;
	height: 32px !important;
	border-radius: 50% !important;
	background: #ffffff !important;
	border: 1px solid rgba(0, 0, 0, 0.1) !important;
	box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
	display: flex !important;
	align-items: center !important;
	justify-content: center !important;
	opacity: 0;
	transition: opacity 0.2s ease !important;
}

.topbar-menu-right .ossn-notification-item-a:hover .ossn-notif-delete-item {
	opacity: 1 !important;
}

.topbar-menu-right .ossn-notif-delete-item i {
	font-size: 13px !important;
	color: #dc3545 !important;
}

/* 11. Bottom "See All" Bar */
.topbar-menu-right .bottom-all {
	border-top: 1px solid #ced0d466 !important;
	margin-top: 8px !important;
	padding-top: 8px !important;
	text-align: center !important;
	background: transparent !important;
	height: auto !important;
}

.topbar-menu-right .bottom-all a {
	display: block !important;
	font-size: 14px !important;
	font-weight: 600 !important;
	color: #0866ff !important;
	text-decoration: none !important;
	padding: 8px !important;
	border-radius: 6px !important;
	width: 100% !important;
	height: auto !important;
	background: transparent !important;
}

.topbar-menu-right .bottom-all a:hover {
	background: #f2f2f2 !important;
}
.ossn-notification-box-loading {
	margin:0 auto;
}

/*************************************************
	FBUI Messenger Dropdown (Exact Facebook Layout)
**************************************************/

/* 1. Main List Container Reset */
.topbar-menu-right .ossn-notification-messages {
	display: flex !important;
	flex-direction: column !important;
	gap: 2px !important;
	padding: 0 !important;
	margin: 0 !important;
}

/* 2. Message Row Container */
.topbar-menu-right .user-item {
	display: block !important;
	width: 100% !important;
	padding: 8px 12px !important;
	border-radius: 8px !important;
	cursor: pointer !important;
	transition: background 0.2s ease !important;
	box-sizing: border-box !important;
	background: transparent !important; /* Keep background clean like FB */
	position: relative !important;
}

.topbar-menu-right .user-item:hover {
	background: #f2f2f2 !important;
}

/* 3. Inner Flex Wrapper */
.topbar-menu-right .user-item-inner {
	display: flex !important;
	align-items: center !important;
	width: 100% !important;
	margin: 0 !important;
	padding: 0 !important;
}

/* 4. Large Circular Avatar */
.topbar-menu-right .user-item .image,
.topbar-menu-right .user-item .image img {
	width: 56px !important;
	height: 56px !important;
	min-width: 56px !important;
	border-radius: 50% !important;
	object-fit: cover !important;
	margin-right: 12px !important;
}

/* 5. Message Text Container */
.topbar-menu-right .user-item .data {
	display: flex !important;
	flex-direction: column !important;
	justify-content: center !important;
	align-items: flex-start !important;
	width: calc(100% - 80px) !important; /* Reserve right-side space for blue dot */
	margin: 0 !important;
	padding: 0 !important;
	float: none !important;
	position: static !important;
}

/* 6. Name Header (Top Line) */
.topbar-menu-right .user-item .name {
	font-size: 15px !important;
	font-weight: 600 !important;
	color: #050505 !important;
	line-height: 1.2 !important;
	margin: 0 0 2px 0 !important;
	padding: 0 !important;
	width: 100% !important;
	text-align: left !important;
	white-space: nowrap !important;
	overflow: hidden !overflow;
	text-overflow: ellipsis !important;
}

/* Unread name is extra bold */
.topbar-menu-right .user-item.message-new .name {
	font-weight: 700 !important;
}

/* 7. Sub-line Wrapper (Message Snippet + Timestamp Inline) */
.topbar-menu-right .user-item .reply {
	display: flex !important;
	align-items: center !important;
	width: 100% !important;
	margin: 0 !important;
	padding: 0 !important;
}

.topbar-menu-right .user-item .reply-text-from {
	font-size: 13px !important;
	color: #65676b !important;
	font-weight: 400 !important;
	white-space: nowrap !important;
	overflow: hidden !important;
	text-overflow: ellipsis !important;
	max-width: 170px !important;
	line-height: 1.3 !important;
	display: inline-block !important;
}

/* Bold snippet for unread messages */
.topbar-menu-right .user-item.message-new .reply-text-from {
	color: #050505 !important;
	font-weight: 600 !important;
}

/* Inline Timestamp with Facebook Dot Separator */
.topbar-menu-right .user-item .time {
	font-size: 13px !important;
	font-weight: 400 !important;
	color: #65676b !important;
	display: inline-flex !important;
	align-items: center !important;
	line-height: 1.3 !important;
	margin: 0 0 0 4px !important;
	padding: 0 !important;
	white-space: nowrap !important;
}


/* 8. Facebook Blue Unread Dot Indicator on Right */
.topbar-menu-right .user-item.message-new::after {
	content: "" !important;
	position: absolute !important;
	right: 16px !important;
	top: 50% !important;
	transform: translateY(-50%) !important;
	width: 12px !important;
	height: 12px !important;
	background-color: #0866ff !important; /* Facebook Blue Dot */
	border-radius: 50% !important;
}


/*************************************************
	MODERN FACEBOOK-STYLE FRIEND REQUEST NOTIFICATIONS
**************************************************/

/* Notification List Container */
.notification-friends {
	list-style: none;
	padding: 0;
	margin: 0;
	display: flex;
	flex-direction: column;
	gap: 4px;
}

/* Individual Friend Request Item */
.notification-friends li {
	list-style: none;
	margin: 0;
	padding: 0;
}

.ossn-notifications-friends-inner {
	display: flex;
	align-items: center;
	gap: 12px;
	padding: 10px 14px;
	border-radius: 8px;
	background: #ffffff;
	transition: background 0.15s ease-in-out;
}

.ossn-notifications-friends-inner:hover {
	background: #f0f2f5;
}

/* User Avatar Image */
.ossn-notifications-friends-inner .image {
	flex-shrink: 0;
	display: flex;
	align-items: center;
}

.ossn-notifications-friends-inner .image img.user-icon-small {
	width: 48px;
	height: 48px;
	border-radius: 50%;
	object-fit: cover;
	display: block;
}

/* Meta Wrapper (Name + Buttons) */
.ossn-notifications-friends-inner .notfi-meta {
	flex: 1;
	display: flex;
	flex-direction: column;
	gap: 6px;
	min-width: 0;
}

/* User Profile Name */
.ossn-notifications-friends-inner .notfi-meta .user {
	font-weight: 600;
	font-size: 15px;
	color: #050505;
	text-decoration: none;
	line-height: 1.2;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.ossn-notifications-friends-inner .notfi-meta .user:hover {
	text-decoration: underline;
}

/* Controls Wrapper (Forms / Action Buttons) */
.ossn-notifications-friends-inner .notfi-meta .controls {
	display: flex;
	align-items: center;
	gap: 8px;
	margin: 0;
	padding: 0;
	background: transparent;
	border: none;
}

/* Hide script tags if rendered as block elements */
.ossn-notifications-friends-inner .notfi-meta .controls script {
	display: none;
}

/* Form Wrappers for Confirm / Deny */
.ossn-notifications-friends-inner .notfi-meta .controls form {
	margin: 0;
	padding: 0;
	display: inline-block;
}

/* Common Button Styling */
.ossn-notifications-friends-inner .notfi-meta .controls .btn {
	padding: 7px 16px;
	font-size: 14px;
	font-weight: 600;
	border-radius: 6px;
	border: none;
	cursor: pointer;
	transition: background 0.15s ease-in-out, filter 0.15s ease-in-out;
	line-height: 1.2;
}

/* Confirm Primary Button (FB Blue) */
.ossn-notifications-friends-inner .notfi-meta .controls .btn-primary {
	background-color: #0866ff;
	color: #ffffff;
}

.ossn-notifications-friends-inner .notfi-meta .controls .btn-primary:hover {
	background-color: #0052cc;
}

/* Deny Default Button (Soft Grey) */
.ossn-notifications-friends-inner .notfi-meta .controls .btn-default {
	background-color: #e4e6eb;
	color: #050505;
}

.ossn-notifications-friends-inner .notfi-meta .controls .btn-default:hover {
	background-color: #d8dadf;
}