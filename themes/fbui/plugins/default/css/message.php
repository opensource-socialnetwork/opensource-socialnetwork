/****** <style> *********/
.ossn-messages {
	background: #fff;
	padding: 0;
	border-radius: 12px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
	overflow: hidden;
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
	padding: 10px 15px;
	margin: 0px;
	cursor: pointer;
	transition: background 0.2s ease;
	border-radius: 8px;
}

.ossn-messages .messages-recent .messages-from .user-item:hover {
	background: #f2f2f2;
}

.ossn-messages .messages-recent .messages-from .user-item .image {
	margin-top: 3px;
	border-radius: 50%;
}

.ossn-messages .messages-recent .messages-from .user-item .name {
	font-weight: 600;
	display: inline-block;
	font-size: 14px;
	color: #050505;
}

.ossn-messages .messages-recent .messages-from .message-new {
	background: #ebf5ff;
}

.ossn-messages .messages-recent .messages-from .user-item .col-lg-10,
.ossn-messages .messages-recent .messages-from .user-item .col-lg-2 {
	padding: 0px;
}

.ossn-messages .messages-recent .messages-from .user-item .reply {
	margin-top: 2px;
	font-size: 13px;
	color: #65676b;
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
	font-size: 12px;
	color: #65676b;
}

.ossn-messages .message-with .user-icon {
	margin-top: 9px;
	border-radius: 50%;
}

.ossn-messages .message-inner {
	max-height: 450px;
	padding: 15px;
	overflow-y: auto;
	overflow-x: hidden;
	background: #ffffff;
}

.ossn-messages .message-inner .row {
	/*margin-left: -10px;*/
}

.message-form-form {
	margin-top: 0;
	border-top: 1px solid #e4e6eb;
	padding: 12px 15px;
	background: #fff;
}

.ossn-messages .message-with .time-created {
	float: right;
	margin-left: 5px;
	font-size: 11px;
	color: #65676b;
}

/*************************
	Notifications
**************************/

.ossn-notification-messages .user-item:hover {
	background: #f2f2f2;
	cursor: pointer;
}

.ossn-notification-messages .message-new {
	background: #ebf5ff;
}

.ossn-notification-messages .user-item .data {
	float: right;
	width: 335px;
}

.ossn-notification-messages .user-item .data .name {
	font-size: 14px;
	font-weight: 600;
	padding: 3px;
	margin-top: -3px;
	text-overflow: ellipsis;
	width: 210px;
	white-space: nowrap;
	overflow: hidden;
	color: #050505;
}

.ossn-notification-messages .user-item-inner .time {
	color: #65676b;
	float: right;
	font-size: 12px;
	font-style: normal;
	margin-top: -24px;
}

.ossn-notification-messages .reply-text,
.ossn-notification-messages .reply-text-from {
	margin-top: 0px;
	margin-left: 4px;
	text-overflow: ellipsis;
	width: 320px;
	white-space: nowrap;
	overflow: hidden;
	display: inline;
	color: #65676b;
}

.ossn-notification-messages .messages-from .time {
	color: #65676b;
	float: right;
}

.ossn-notification-messages .user-item-inner {
	padding: 8px 12px;
}

/************************
	v4.0 chat message (FB Style Bubbles)
*************************/
.message-box-recieved {
	background-color: #f0f2f5;
	color: #050505;
	display: inline-block;
	padding: 8px 14px;
	position: relative;
	vertical-align: top;
	float: left;
	margin: 4px 0px 4px 8px;
	word-break: break-word;
	text-align: left;
	border-radius: 18px;
	box-shadow: none;
	font-size: 14px;
	max-width: 65%;
}

.message-box-sent {
	word-break: break-word;
	text-align: left;
	float: right;
	background-color: #0084ff; /* Messenger Blue */
	color: #ffffff;
	display: inline-block;
	padding: 8px 14px;
	position: relative;
	vertical-align: top;
	margin: 4px 8px 4px 0px;
	border-color: transparent;
	border-radius: 18px;
	box-shadow: none;
	font-size: 14px;
	max-width: 65%;
}

/* Readable white timestamp on sent message bubbles */
.message-box-sent .time-created {
	color: rgba(255, 255, 255, 0.8) !important;
	display: inline-block;
	margin-left: 8px;
	font-size: 11px;
}

.messages-with .widget-contents {
	padding: 0px;
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
	color: #fa383e !important;
	visibility: hidden;
	cursor: pointer;
}

.message-box-recieved:hover .ossn-message-delete,
.message-box-sent:hover .ossn-message-delete {
	visibility: visible;
}

.ossn-message-deleted span {
	font-style: italic;
	color: #8a8d91;
}

#ossn-message-delete-form .ossn-loading {
	margin: 40px auto;
}

.message-with .ossn-message-show-image-attachment {
	max-width: 200px;
	border-radius: 8px;
}

/* Chat Action Form Controls Container */
.message-form-form .controls {
	display: flex;
	align-items: center;
	gap: 8px;
	margin-top: 8px;
}

/* Modern Rounded Attachment & Emoji Icons */
.ossn-message-attach-photo,
.ossn-message-icon-attachment {
	width: 36px !important;
	height: 36px !important;
	display: flex !important;
	align-items: center !important;
	justify-content: center !important;
	border-radius: 50% !important;
	background: transparent !important;
	cursor: pointer;
	transition: background 0.2s ease;
}

.ossn-message-attach-photo:hover,
.ossn-message-icon-attachment:hover {
	background: #f2f2f2 !important;
}

.ossn-message-icon-attachment:before {
	content: "\f0c6";
	font-family: 'Font Awesome 5 Free';
	font-style: normal;
	font-weight: bold;
	font-size: 20px;
}

.ossn-message-attach-photo .fa-smile {
	font-family: "Font Awesome 7 Free" !important;
	font-weight: 900 !important;
	font-size: 18px !important;
	color: #0084ff !important;
	margin: 0 !important;
}

.ossn-message-pling {
	width: 36px;
	height: 36px;
	display: flex;
	align-items: center;
	justify-content: center;
	border-radius: 50%;
	cursor: pointer;
	color: #65676b;
	transition: background 0.2s ease;
}

.ossn-message-pling:hover {
	background: #f2f2f2;
}

.message-form-form .btn-primary {
	background-color: #0084ff !important;
	border-color: #0084ff !important;
	border-radius: 20px !important;
	padding: 6px 16px !important;
	font-weight: 600 !important;
}

.ossn-messages .widget-heading {
	border-top-left-radius: 0px !important;
	border-top-right-radius: 0px !important;
	background: #fff !important;
	border-bottom: 1px solid #e4e6eb;
}

#message-with-user-widget {
	border-left: 1px solid #e4e6eb;
}

#message-with-user-widget .widget-heading .user-icon-smaller {
	border-radius: 50%;
	float: left;
	margin-top: -5px;
	margin-right: 8px;
}

.ossn-omessage-attachment-remove {
	color: #fa383e;
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
	margin-left: 18px;
	margin-top: 11px;
	border-radius: 100%;
	border: 2px solid white;
	height: 12px;
	width: 12px;
}

.ossn-inmessage-status-offline .ossn-inmessage-status-circle {
	background: #bebebe;
    left: 0;
    margin-left: 35px;	
}

.ossn-inmessage-status-online .ossn-inmessage-status-circle {
	background: #31a24c;
    left: 0;
    margin-left: 35px;	
}

.ossn-message-delete-conversation {
	float: right;
	color: #fa383e;
}

#ossn-message-delete-conv-form .ossn-loading {
	margin: 45px auto;
}

.ossn-msgrecent-check-read.fa.fa-check {
	font-size: 10px;
	color: #0084ff;
	margin-left: 5px;
}

.ossn-recent-message-status-offline .ossn-inmessage-status-circle {
	background: #bebebe;
}

.ossn-recent-message-status-online .ossn-inmessage-status-circle {
	background: #31a24c;
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
	position: relative;
}

.msg-flex-c2 {
	width: 100%;
	margin-left: 10px;
}

.ossn-recent-messages-toggle i {
	margin-right: 0px;
	margin-top: 6px;
}

.ossn-recent-messages-toggle {
	text-align: center;
	float: right;
	background: transparent;
	width: 28px;
	height: 28px;
	border-radius: 50%;
	cursor: pointer;
}

.ossn-recent-messages-toggle:hover {
	background: #f2f2f2;
}

.ossn-messages-select-conv {
	font-size: 4rem;
	color: #bcc0c4;
}

.ossn-messages .ossn-widget {
	border-radius: 0px;
	box-shadow: none;
	border: none;
}

@media only screen and (max-width: 992px) {
	.ossn-messages .message-inner .row {
		margin-left: 0px !important;
	}
}

@media (max-width: 480px) {
	.ossn-messages .message-inner .row {
		margin-left: 0px !important;
	}
}

.ossn-messages .ossn-widget {
	margin-bottom: 0;
	background-color: #fff;
	border-radius: 0;
	box-shadow: none;
}

.ossn-messages .ossn-widget .widget-heading {
	background: #ffffff;
	border: none;
	border-bottom: 1px solid #e4e6eb;
	padding: 12px 15px;
	font-weight: bold;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
	position:relative;
}

.ossn-messages .ossn-widget .widget-contents {
	padding: 0;
	border-bottom: none;
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
}

/* 1. Flex container setup */
.message-form-form .controls {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    margin-top: 8px !important;
    width: 100% !important;
}

/* 2. Uniform styling for Emoji, Attachment, and Bell icons */
.ossn-message-attach-photo,
.ossn-message-icon-attachment,
.ossn-message-pling {
    width: 36px !important;
    height: 36px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
    background: transparent !important;
    cursor: pointer !important;
    color: #0084ff !important; /* Messenger Blue */
    transition: background 0.2s ease !important;
    margin: 0 !important; /* Remove old margins */
    float: none !important; /* Remove old floats */
}

/* Gray color for the bell to separate it slightly, optional */
.ossn-message-pling {
    color: #65676b !important;
}

/* Uniform hover effects */
.ossn-message-attach-photo:hover,
.ossn-message-icon-attachment:hover,
.ossn-message-pling:hover {
    background: #f2f2f2 !important;
}

/* Fix FontAwesome icons size and alignment */
.ossn-message-icon-attachment:before {
    content: "\f0c6" !important; /* Paperclip */
    font-family: "Font Awesome 6 Free", "Font Awesome 5 Free" !important;
    font-weight: 900 !important;
    font-size: 18px !important;
}

.ossn-message-attach-photo i,
.ossn-message-pling i {
    font-size: 18px !important;
    margin: 0 !important;
}

/* 3. Reorder the items visually using Flex Order without touching HTML */
.ossn-message-attach-photo { order: 1; }
.ossn-message-icon-attachment { order: 2; }
.ossn-message-pling { order: 3; }

/* 4. Style the Send button, move it to the end, and push it to the far right */
.message-form-form .controls input[type="submit"] {
    order: 4;
    margin-left: auto !important; /* This pushes the button to the far right */
    background-color: #0084ff !important;
    border-color: #0084ff !important;
    color: #ffffff !important;
    border-radius: 20px !important;
    padding: 6px 16px !important;
    font-weight: 600 !important;
}

.message-form-form .controls input[type="submit"]:hover {
    background-color: #0073e6 !important;
}

/* Standardize all action items inside the controls area into uniform round buttons */
.message-form-form .controls .ossn-message-attach-photo,
.message-form-form .controls .ossn-message-icon-attachment,
.message-form-form .controls .ossn-message-pling {
    width: 36px !important;
    height: 36px !important;
    min-width: 36px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
    background: #f0f2f5 !important; /* Soft round background */
    cursor: pointer !important;
    transition: background 0.2s ease !important;
    margin: 0 !important;
    padding: 0 !important;
    float: none !important;
}

/* Hover effect matching Facebook */
.message-form-form .controls .ossn-message-attach-photo:hover,
.message-form-form .controls .ossn-message-icon-attachment:hover,
.message-form-form .controls .ossn-message-pling:hover {
    background: #e4e6eb !important;
}

/* Harmonize text and icon colors inside the buttons */
.message-form-form .controls .ossn-message-attach-photo i,
.message-form-form .controls .ossn-message-icon-attachment i,
.message-form-form .controls .ossn-message-pling i {
    color: #0084ff !important; /* Messenger blue for action icons */
    font-size: 16px !important;
    margin: 0 !important;
}

/* Fix paperclip icon pseudo-element mapping if needed */
.message-form-form .controls .ossn-message-icon-attachment::before {
    content: "\f0c6" !important;
    font-family: "Font Awesome 6 Free", "Font Awesome 5 Free" !important;
    font-weight: 900 !important;
    font-size: 16px !important;
    color: #0084ff !important;
}
.message-form-form textarea[name="message"] {
    width: 100% !important;
    background: #f0f2f5 !important;
    border: 1px solid #e4e6eb !important;
    border-radius: 20px !important;
    padding: 10px 16px !important;
    font-size: 14px !important;
    color: #050505 !important;
    resize: none !important;
    outline: none !important;
    box-shadow: none !important;
    transition: background 0.2s ease, border-color 0.2s ease;
}

/* Focus state matching Facebook */
.message-form-form textarea[name="message"]:focus {
    background: #ffffff !important;
}

/* Placeholder styling */
.message-form-form textarea[name="message"]::placeholder {
    color: #65676b !important;
}

.message-form-form .controls .ossn-loading {
    order: 4 !important;
    margin-left: auto !important;
    margin-right: 8px !important;
    display: inline-block !important;
}
.message-form-form .controls .ossn-loading.ossn-hidden {
    display: none !important;
}
To fix the timestamp inside the message bubble so it stacks neatly underneath the text or looks clean like Facebook Messenger instead of sitting awkwardly inline, use this CSS:

CSS
/* Style sent message box layout for clean text & timestamp arrangement */
.message-box-sent {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-end !important;
    padding: 8px 12px !important;
}

/* Style the message text */
.message-box-sent span {
    display: block !important;
    text-align: left !important;
    width: 100%;
}

/* Make the timestamp smaller and stack below the text nicely */
.message-box-sent .time-created {
    display: block !important;
    margin-left: 0 !important;
    margin-top: 2px !important;
    font-size: 10px !important;
    color: rgba(255, 255, 255, 0.7) !important;
    text-align: right !important;
}