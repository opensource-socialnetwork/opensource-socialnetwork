/***********************************
	Ossn Wall <style>
*************************************/

.ossn-wall {}

.ossn-wall-items {}

.ossn-wall-item {
	background: #ffffff;
	border: none;
	border-radius: 12px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2); /* 0.2 opacity on drop shadow */
	padding: 12px 16px;
	padding-bottom:0px;
	margin-top: 16px;
	margin-bottom: 16px;
	box-sizing: border-box;
}
.ossn-wall-item:first-child {
	margin-top: 0px;
}

.ossn-wall-item .friends a {
	text-decoration: none;
}

.ossn-wall-item .friends a:first-child:before {
	content: "-";
	margin-left: 5px;
	margin-right: 5px;
}

.ossn-wall-item .user-img {
	border-radius: 50px;
	display: inline-block;
	float: left;
	margin-right: 10px;
}

.ossn-wall-item .meta {}

.ossn-wall-item .meta .user {
	margin-top: 3px;
}

.ossn-wall-item .meta .user a {
	font-weight: bold;
}

.ossn-wall-item .meta .user span {
	color: #999;
}

.ossn-wall-item .post-contents {
	margin-top: 15px;
}

.ossn-wall-item .post-contents p {
	/** Incorrect Hyphenation in the theme GoBlue 3.0 #824 **/
	word-break: break-word;
	text-align: justify;
}

.ossn-wall-item .post-contents img {
	max-width: 100%;
	border: 1px solid #eae8e8;
	display: block;
	margin-bottom: 10px;
}

.ossn-wall-item .meta .post-menu {
	float: right;
}

.ossn-wall-item .meta .post-menu .btn-link {
	font-size: 14px;
}

.ossn-wall-container {
	margin-bottom: 10px;
	border-radius: 10px;
	box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}



/*************************************************
	MODERN LIGHT PILL TABS
**************************************************/

/* 1. Remove harsh bottom borders */
.tabs-input {
	border: none !important;
	padding: 0 !important;
	margin-bottom: 16px !important;
}

/* 2. Soft Pill Container */
.wall-tabs {
	display: inline-flex !important;
	align-items: center !important;
	gap: 6px !important;
	background-color: #f0f2f5 !important; /* Soft light-grey pill track */
	padding: 4px !important;
	border-radius: 10px !important;
	border: none !important;
	margin: 0 !important;
	list-style: none !important;
}

/* 3. Individual Tab Pills */
.wall-tabs .item {
	display: inline-flex !important;
	align-items: center !important;
	gap: 8px !important;
	padding: 8px 16px !important;
	border-radius: 8px !important;
	cursor: pointer !important;
	font-weight: 600 !important;
	font-size: 14px !important;
	color: #65676b !important;
	background: transparent !important;
	transition: all 0.15s ease-in-out !important;
	user-select: none !important;
	border: none !important;
}

/* Icons & Text inside Pills */
.wall-tabs .item i {
	font-size: 15px !important;
	color: #65676b !important;
	margin: 0 !important;
	transition: color 0.15s ease-in-out !important;
}

.wall-tabs .item span {
	position: static !important;
	line-height: 1 !important;
	font-size: 14px !important;
	font-weight: 600 !important;
	color: inherit !important;
}

/* Hover State (Non-active tabs) */
.wall-tabs .item:hover {
	color: #050505 !important;
	background-color: rgba(255, 255, 255, 0.6) !important;
}

.wall-tabs .item:hover i {
	color: #0866ff !important;
}

/* Active Selected Tab Pill */
.wall-tabs .item.active,
.wall-tabs .item.selected,
.wall-tabs .item[data-active="true"],
.wall-tabs .ossn-wall-container-menu-post { /* Targets post tab by default */
	background-color: #ffffff !important;
	color: #0866ff !important; /* FB Blue */
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12) !important;
}

.wall-tabs .item.active i,
.wall-tabs .item.selected i,
.wall-tabs .ossn-wall-container-menu-post i {
	color: #0866ff !important;
}
.wall-tabs:has(.item:only-child) {
    display: none !important;
}

/* Optional: Also hide the tabs-input wrapper if tabs are hidden */
.tabs-input:has(.wall-tabs:has(.item:only-child)) {
    margin: 0 !important;
    padding: 0 !important;
}
/*************************************************
	FB-STYLE "ADD TO YOUR POST" CONTROLS BAR
**************************************************/

.ossn-wall-container .controls {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    border: 1px solid #e4e6eb !important;
    border-radius: 8px !important;
    padding: 8px 12px !important;
    margin: 16px 0 12px 0 !important;
    background: #ffffff !important;
}

/* Localized Label Style */
.fbui-controls-label {
    font-size: 15px !important;
    font-weight: 600 !important;
    color: #050505 !important;
}

/* Flex Container for Icon List */
.fbui-controls-items {
    display: flex !important;
    align-items: center !important;
    gap: 4px !important;
    list-style: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* 2. Insert "Add to your post" Text on the Left */

/* 3. Style Icon List Items */
.ossn-wall-container .controls li {
	background: transparent !important;
	border: none !important;
	padding: 6px !important;
	margin: 0 2px !important;
	border-radius: 50% !important;
	display: inline-flex !important;
	align-items: center !important;
	justify-content: center !important;
	cursor: pointer !important;
	width: 36px !important;
	height: 36px !important;
	transition: background 0.15s ease-in-out !important;
}

.ossn-wall-container .controls li:hover {
	background: #f0f2f5 !important;
}

/* Icon Sizing */
.ossn-wall-container .controls li i {
	font-size: 20px !important;
	line-height: 1 !important;
	margin-right: 0 !important;
}

/* 4. Facebook Icon Colors */
/* Photos (Green) */
.ossn-wall-container .controls .ossn-wall-photo i {
	color: #45bd62 !important;
}

/* Tag Friends (Blue) */
.ossn-wall-container .controls .ossn-wall-friend i {
	color: #1877f2 !important;
}

/* Emoji / Feeling (Warm Orange) */
.ossn-wall-container .controls .ossn-wall-container-control-menu-emojii-selector i {
	color: #f7b928 !important;
}

/* Location (Red) */
.ossn-wall-container .controls .ossn-wall-location i {
	color: #f3425f !important;
}

/* Post Background Brush (Purple) */
.ossn-wall-container .controls .ossn-wall-container-control-menu-postbg-selector i {
	color: #9333ea !important;
}


/*************************************************
	FULL-WIDTH BLOCK POST BUTTON
**************************************************/

/* Make Post Button Container Block-Level */
.ossn-wall-post-button-container {
	display: block !important;
	width: 100% !important;
	float: none !important;
	margin-top: 10px !important;
}

/* Full Width Primary FB Button */
.ossn-wall-container .ossn-wall-post {
	display: block !important;
	width: 100% !important;
	padding: 8px 16px !important;
	font-size: 15px !important;
	font-weight: 600 !important;
	color: #ffffff !important;
	background-color: #0866ff !important; /* Modern Facebook Blue */
	border: none !important;
	border-radius: 6px !important;
	text-align: center !important;
	cursor: pointer !important;
	transition: background 0.15s ease-in-out !important;
	box-shadow: none !important;
}

.ossn-wall-container .ossn-wall-post:hover {
	background-color: #0052cc !important;
}

.ossn-wall-container .tabs-input {}

.ossn-wall-post-button-container {
	display: inline-table;
	float: right;
}

.ossn-wall-privacy-dummy,
.ossn-wall-privacy {
	margin-right: 5px;
	padding: 5px 10px;
	background: #e5e5e5e0;
	border-radius: 10px;
	cursor: pointer;
	display: inline-block;
	margin-top: 10px;
}

.ossn-wall-privacy-dummy {
	background: #e5e5e5e0;
	cursor: initial;
	opacity: 0.5;
}

.ossn-wall-privacy:hover {
	background: #eeeeee8c;
}

.ossn-wall-privacy-dummy span>span,
.ossn-wall-privacy span>span {
	margin-left: 5px;
	float: right;
}

.ossn-wall-container .ossn-wall-post {
	padding: 3px 20px;
	margin-top: 6px;
	margin: 10px auto;
	border-radius: 5px;
}

.ossn-wall-container i {
	font-size: 15px;
	margin-right: 0;
}

.ossn-wall-container-data {
	background: #fff;
	padding: 10px;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
	border: 1px solid #E5E5E5;
	border-bottom-color: #ccc;
	border-width: 0 1px 2px 1px;
}

#ossn-wall-photo {
	margin-top: 10px;
}

.ossn-wall-container input[type="file"],
.ossn-wall-container input[type="text"] {
	width: 100%;
	border-top: 1px dashed #E9EAED;
	padding: 5px;
	margin-bottom: 5px;
	margin-top: -5px;
	outline: none;
}

.ossn-wall-container input[type="file"] {
	border: 1px solid #E9EAED;
	border-radius: 10px;
	background: #fff;
}

#token-input-ossn-wall-friend-input {
	width: 100% !important;
	padding: 7px;
	margin-bottom: 5px;
	margin-top: -5px;
	background: #fff;
	border: 0;
}

#ossn-wall-location-input {
	background: #fff;
	border: 1px solid #E9EAED;
	border-radius: 10px;
}

#ossn-wall-location .ap-input-icon svg {
	top: 15px
}

#ossn-wall-form .ossn-loading {
	margin: 7px;
}

.ossn-wall-item-type {
	display: inline-block;
}

.ossn-wall-item .friends {
	display: inline-block;
}

.ossn-form textarea#post-edit {
	height: 125px;
}

.ossn-wall-post-delete {
	color: #EC2020 !important;
}

.ossn-wall-loading {
	text-align: center;
	padding: 10px;
	width: 100%;
}

.ossn-wall-loading .ossn-loading {
	display: inline-block;
}

#ossn-wall-form .ui-autocomplete-loading {
	background: white url("<?php echo ossn_theme_url();?>images/loading.gif") right center no-repeat;
}

#ossn-wall-form .ui-helper-hidden-accessible {
	display: none;
}

.ossn-wall-post-time {
	cursor: pointer;
}

.ossn-wall-post-time:hover {
	text-decoration: underline;
}

.wall-tabs .item span {
	padding-left: 5px;
	font-weight: bold;
	font-family: 'PT Sans', sans-serif;
	font-weight: bold;
	font-size: 13px;
	bottom: 0;
}

.group-wall .ossn-wall-post-button-container {
	height: 50px;
	display: inline-block;
}

.group-wall .ossn-wall-post {
	float: right;
}

#ossn-wall-location .mapboxgl-ctrl-geocoder--input {
	padding-left: 30px;
	background: initial;
	border-radius: 10px;
	border: 1px dashed #eee;
	margin-top: 5px;
}

.ossn-wall-image-container {
	background: #f8f8f8;
}

.ossn-wall-image-container>img {
	max-height: 80vh;
	margin: 0 auto;
}

.ossn-wall-item>.dropdown-menu {
	min-width: 200px;
}

.ossn-wall-item .dropdown-menu li a:before {
	content: "\f068";
	display: inline-block;
	float: left;
	margin-right: 10px;
	font-family: var(--fa-style-family, "Font Awesome 6 Free");
	font-weight: var(--fa-style, 900);
}

.ossn-wall-item .post-control-edit:before {
	content: "\f303" !important;
}

.ossn-wall-item .post-control-delete:before {
	content: "\f2ed" !important;
}

.ossn-wall-textarea {
	min-height: 200px;
	outline: none;
}

#ossn-wall-form .ossn-wall-textarea[contenteditable="true"]:empty::before {
	content: attr(placeholder);
	pointer-events: none;
	display: block;
}

/**************************
	Mobile Layout Settings
***************************/

@media (max-width: 480px) {
	.ossn-wall-item-type {
		display: block;
	}

	.ossn-wall-privacy-dummy,
	.ossn-wall-privacy {
		float: none;
		margin-right: 0;
	}

	.ossn-wall-container .controls {
		height: auto;
	}

	.ossn-wall-container textarea {
		margin-left: 0px;
		width: 100%;
	}
}

@media screen and (min-width:1500px) {
	.ossn-wall-container .wall-tabs i {
		margin-top: 3px;
	}
}


/********************
	Changes 9.6
*********************/
.ossn-wall-textarea {
	min-height: 60px;
	outline: none;
	padding: 10px;
	padding-left: 40px;
}

.ossn-wall-textarea {
	white-space: pre-wrap;
	/* Make sure browser don't add &nbps  */
}

.ossn-wall-token {
	display: inline-block;
	padding: 2px 6px;
	border-radius: 6px;
	font-weight: 500;
	line-height: 1.2;
	user-select: none;
	transition: background 0.2s;
}

.ossn-wall-userimage-form {
	width: 30px;
	height: 30px;
	position: absolute;
	margin-top: 7px;
}

.ossn-wall-userimage-form img {
	border-radius: 50%;
}
/*******************
	Custom CSS Add above your css
********************/
/*************************************************
	A. DUMMY BOX STYLING
**************************************************/
.fbui-wall-dummy-box {
    background: #ffffff;
    padding: 12px 16px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    box-sizing: border-box;
    width: 100%;
}

.fbui-wall-dummy-box .fbui-dummy-avatar {
    display: flex;
    align-items: center;
}

.fbui-wall-dummy-box .fbui-dummy-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

.fbui-wall-dummy-box .fbui-dummy-input {
    flex: 1;
    background: #f0f2f5;
    border-radius: 50px;
    padding: 9px 16px;
    color: #65676b;
    font-size: 15px;
    font-weight: 400;
    font-family: inherit;
    user-select: none;
    transition: background 0.15s ease-in-out;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.fbui-wall-dummy-box:hover .fbui-dummy-input {
    background: #e4e6eb;
}

.fbui-wall-dummy-box .fbui-dummy-actions {
    display: flex;
    align-items: center;
    gap: 4px;
}

.fbui-wall-dummy-box .fbui-action-btn {
    border: none;
    background: transparent;
    padding: 8px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.15s ease-in-out;
    outline: none;
}

.fbui-wall-dummy-box .fbui-action-btn:hover { background: #f0f2f5; }
.fbui-wall-dummy-box .fbui-action-btn i { font-size: 20px; line-height: 1; }
.fbui-wall-dummy-box .icon-live i { color: #f3425f; }
.fbui-wall-dummy-box .icon-photo i { color: #45bd62; }
.fbui-wall-dummy-box .icon-emoji i { color: #f7b928; }

/*************************************************
	B. MODAL OVERLAY & DIALOG
**************************************************/
.fbui-wall-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(244, 244, 244, 0.85);
    backdrop-filter: blur(4px);
    z-index: 50000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    box-sizing: border-box;
}

.fbui-modal-dialog {
    background: #ffffff;
    width: 100%;
    max-width: 500px;
    border-radius: 12px;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15), 0 2px 4px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    max-height: 90vh;
    animation: fbModalPop 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

@keyframes fbModalPop {
    from { transform: scale(0.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.fbui-modal-header {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    padding: 16px;
    border-bottom: 1px solid #e4e6eb;
}

.fbui-modal-header h3 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    color: #050505;
    font-family: inherit;
}

.fbui-modal-close {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #e4e6eb;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.15s ease-in-out;
}

.fbui-modal-close:hover { background: #d8dadf; }
.fbui-modal-close i { font-size: 18px; color: #65676b; }

.fbui-modal-body {
    padding: 16px;
    overflow-y: auto;
}

/*************************************************
	C. MODERN LIGHT PILL TABS WITH ARROW NAV
**************************************************/
.tabs-input {
    border: none;
    padding: 0;
    margin-bottom: 16px;
    width: 100%;
}

.tabs-input:has(.wall-tabs:has(.item:only-child)) {
    display: none;
}

/* Outer wrapper for positioning floating arrows */
.wall-tabs-wrapper {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
}

.wall-tabs {
    display: flex;
    align-items: center;
    gap: 6px;
    background-color: #f0f2f5;
    padding: 6px;
    border-radius: 10px;
    border: none;
    margin: 0;
    list-style: none;
    width: 100%;
    box-sizing: border-box;
    
    /* Horizontal smooth scroll */
    overflow-x: auto;
    white-space: nowrap;
    scroll-behavior: smooth;
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* IE/Edge */
}

/* Hide scrollbars */
.wall-tabs::-webkit-scrollbar {
    display: none;
}

.wall-tabs:has(.item:only-child) {
    display: none;
}

.wall-tabs .item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    color: #65676b;
    background: transparent;
    transition: all 0.15s ease-in-out;
    user-select: none;
    border: none;
    flex-shrink: 0; /* Prevents tabs from squishing */
}

.wall-tabs .item i {
    font-size: 15px;
    color: #65676b;
    margin: 0;
    transition: color 0.15s ease-in-out;
}

.wall-tabs .item span {
    position: static;
    line-height: 1;
    font-size: 14px;
    font-weight: 600;
    color: inherit;
    display: inline-block;
}

.wall-tabs .item:hover {
    color: #050505;
    background-color: rgba(255, 255, 255, 0.6);
}

.wall-tabs .item:hover i { color: #0866ff; }

.wall-tabs .item.active,
.wall-tabs .item.selected,
.wall-tabs .item[data-active="true"],
.wall-tabs .ossn-wall-container-menu-post {
    background-color: #ffffff;
    color: #0866ff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
}

.wall-tabs .item.active i,
.wall-tabs .item.selected i,
.wall-tabs .ossn-wall-container-menu-post i { color: #0866ff; }

/* --- Floating Scroll Arrow Buttons --- */
.wall-tab-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #ffffff;
    border: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
    color: #050505;
    display: none; /* Managed by JS */
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    transition: background 0.15s ease, transform 0.15s ease;
    padding: 0;
}

.wall-tab-arrow:hover {
    background: #f0f2f5;
    transform: translateY(-50%) scale(1.08);
}

.wall-tab-arrow i {
    font-size: 12px;
    line-height: 1;
    color: #65676b;
}

.wall-tab-arrow-left {
    left: 4px;
}

.wall-tab-arrow-right {
    right: 4px;
}
.wall-tab-arrow i {
	margin-top:0px !important;	
}

/*************************************************
	D. USER HEADER ROW (NAME + PRIVACY BELOW)
**************************************************/
.fbui-user-header-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.ossn-wall-userimage-form {
    position: relative;
    margin: 0;
    width: 40px;
    height: 40px;
    flex-shrink: 0;
}

.ossn-wall-userimage-form img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
}

.fbui-user-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 3px;
}

.fbui-user-name {
    font-weight: 600;
    font-size: 15px;
    color: #050505;
    line-height: 1.2;
}

.ossn-wall-container .ossn-wall-privacy-dummy,
.ossn-wall-container .ossn-wall-privacy {
    margin: 0;
    padding: 3px 8px;
    background: #e4e6eb;
    border-radius: 6px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    font-size: 12px;
    font-weight: 600;
    color: #050505;
    transition: background 0.15s ease-in-out;
    user-select: none;
}

.ossn-wall-container .ossn-wall-privacy:hover {
    background: #d8dadf;
}

.ossn-wall-container .ossn-wall-privacy span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.fbui-privacy-arrow {
    font-size: 10px;
    color: #65676b;
    margin-left: 1px;
}

/*************************************************
	E. TEXTAREA, CONTROLS & POST BUTTON
**************************************************/
.ossn-wall-container-data {
    border: none;
    padding: 0;
}

.ossn-wall-textarea {
    min-height: 90px;
    outline: none;
    padding: 0;
    font-size: 16px;
    line-height: 1.4;
    color: #050505;
    border: none;
}

.ossn-wall-container .controls {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: 1px solid #e4e6eb;
    border-radius: 8px;
    padding: 8px 12px;
    margin: 16px 0 12px 0;
    background: #ffffff;
    list-style: none;
}

.ossn-wall-container .controls::before {
    content: attr(data-title);
    font-size: 15px;
    font-weight: 600;
    color: #050505;
}

.ossn-wall-container .controls li {
    background: transparent;
    border: none;
    padding: 6px;
    margin: 0 2px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    width: 36px;
    height: 36px;
    transition: background 0.15s ease-in-out;
}

.ossn-wall-container .controls li:hover { background: #f0f2f5; }
.ossn-wall-container .controls li i { font-size: 20px; line-height: 1; margin: 0; }
.ossn-wall-container .controls .ossn-wall-photo i { color: #45bd62; }
.ossn-wall-container .controls .ossn-wall-friend i { color: #1877f2; }
.ossn-wall-container .controls .ossn-wall-container-control-menu-emojii-selector i { color: #f7b928; }
.ossn-wall-container .controls .ossn-wall-location i { color: #f3425f; }
.ossn-wall-container .controls .ossn-wall-container-control-menu-postbg-selector i { color: #9333ea; }

.ossn-wall-post-button-container {
    display: block;
    width: 100%;
    float: none;
    margin-top: 10px;
}

.ossn-wall-container .ossn-wall-post {
    display: block;
    width: 100%;
    padding: 8px 16px;
    font-size: 15px;
    font-weight: 600;
    color: #ffffff;
    background-color: #0866ff;
    border: none;
    border-radius: 6px;
    text-align: center;
    cursor: pointer;
    transition: background 0.15s ease-in-out;
}

.ossn-wall-container .ossn-wall-post:hover { background-color: #0052cc; }