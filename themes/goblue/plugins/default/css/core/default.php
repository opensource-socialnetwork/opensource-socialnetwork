/******************************
	Basic <style>
**********************************/
:root {
	--layout-sidebar-width: 240px;
}

/* Regular (400) */
@font-face {
  font-family: 'PT Sans';
  font-style: normal;
  font-weight: 400;
  src: url('<?php echo ossn_theme_url();?>vendors/fonts/PTSans/PTSans-Regular.woff2') format('woff2');
}

/* Italic (400italic) */
@font-face {
  font-family: 'PT Sans';
  font-style: italic;
  font-weight: 400;
  src: url('<?php echo ossn_theme_url();?>vendors/fonts/PTSans/PTSans-Italic.woff2') format('woff2');
}

/* Bold (700) */
@font-face {
  font-family: 'PT Sans';
  font-style: normal;
  font-weight: 700;
  src: url('<?php echo ossn_theme_url();?>vendors/fonts/PTSans/PTSans-Bold.woff2') format('woff2');
}

body {
	font-size: 15px;
	background-color: #eaeaea;
	font-family: 'PT Sans', sans-serif;
	height: 100%;
}

.ossn-required {
	color: #a94442;
}

::-webkit-scrollbar {
	width: 12px;
}

::-webkit-scrollbar-track {
	background-color: #eaeaea;
	border-left: 1px solid #ccc;
}

::-webkit-scrollbar-thumb {
	background-color: #ccc;
}

::-webkit-scrollbar-thumb:hover {
	background-color: #aaa;
}

.ossn-form input[type='number'],
.ossn-form input[type='email'],
.ossn-form input[type='password'],
.ossn-form text,
.ossn-form select,
.ossn-form textarea,
.ossn-form input[type='text'] {
	width: 100%;
	padding: 8px;
	margin-bottom: 5px;
	outline: none;
	display: block;
	border-radius: 5px;
	border-radius: 5px;
	box-shadow: none;
	-webkit-box-shadow: none;
	background: #f1f5f9;
	border: 1px solid #ccc;
	border-radius: 10px;
	padding: 12px 15px;
	height: auto;
}

.ossn-form textarea {
	resize: vertical;
}

.ossn-form input[type='number']:focus,
.ossn-form input[type='email']:focus,
.ossn-form input[type='password']:focus,
.ossn-form text:focus,
.ossn-form select:focus,
.ossn-form textarea:focus,
.ossn-form input[type='text']:focus {
	outline: none;
	border: 1px solid #eee;
	background: #fff;
}

.ossn-form select[readonly],
.ossn-form textarea[readonly],
.ossn-form input[readonly] {
	background: #dbdbdb;
}

.ossn-form input[type="file"] {
	display: block;
}

[contentEditable=true]:empty:not(:focus)::before {
	content: attr(placeholder);
	pointer-events: none;
	display: block;
}

.btn:focus,
.btn:active {
	outline: none !important;
}

.btn-link {
	font-weight: 400;
	color: #337ab7;
}

.form-control {
	height: initial;
}

.ossn-form-group-half {
	display: inline-block;
	width: calc(50% - 2px);
	float: left;
	box-sizing: border-box;
}

.radio-block-container {
	margin-bottom: 20px;
}

.ossn-form input[type='submit'] {
	margin-top: 5px;
	margin-bottom: 5px;
}

.ossn-red-borders {
	border: 1px solid #a94442 !important;
}

.fa,
.fas,
.far,
.fal,
.fad,
.fab {
	margin-right: 5px;
}

.hidden,
.ossn-hidden {
	display: none !important;
}

p {
	font-size: 15px;
}

.col-center {
	float: none;
	margin: 0 auto;
}

.container-table {
	display: table;
	width: 100%;
}

.center-row {
	display: table-cell;
	text-align: center;
}

.checkbox-block,
.radio-block {
	margin-top: 10px;
	margin-bottom: 10px;
}

.checkbox-block span,
.radio-block span {
	display: inline-block;
	margin-right: 10px;
	font-size: 15px;
	font-weight: bold;
	margin-left: 10px;
	cursor: pointer;
}

.ossn-checkbox-input {
	width: 20px;
	height: 20px;
	color: #0b769c;
	-webkit-appearance: none;
	background: none;
	border: 0;
	outline: 0;
	flex-grow: 0;
	background-color: #FFFFFF;
	transition: background 300ms;
	cursor: pointer;
	float: left;
	margin-top: 2px;
}

.checkbox-block [type=checkbox]::before {
	content: "";
	color: transparent;
	display: block;
	width: inherit;
	height: inherit;
	border-radius: inherit;
	border: 0;
	background-color: transparent;
	background-size: contain;
	box-shadow: inset 0 0 0 1px #CCD3D8;
}


.checkbox-block [type=checkbox]:checked {
	background-color: currentcolor;
}

.checkbox-block [type=checkbox]:checked::before {
	box-shadow: none;
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}

.checkbox-block [type=checkbox]:disabled {
	background-color: #CCD3D8;
	opacity: 0.84;
	cursor: not-allowed;
}

a {
	color: #0f3b4a;
	text-decoration: none;
}


/************************************
	Layouts
************************************/
/** didn't we have a minimum page height in goblue? #702 **/

.ossn-layout-module,
.ossn-layout-contents,
.ossn-layout-media,
.ossn-layout-newsfeed {
	margin-top: 10px;
	min-height: 400px;
}

.ossn-home-container {
	z-index: 1;
	position: relative;
}

.ossn-home-container,
.ossn-layout-startup {
	min-height: 560px;
}

.ossn-home-container .ossn-page-contents {
	background: rgba(255, 255, 255, 0);
	border: 1px solid rgba(238, 238, 238, 0);
}

.ossn-layout-startup {
	min-height: 560px;
}

.ossn-layout-startup-background {
	min-height: 560px;
	background: url("<?php echo ossn_add_cache_to_url(ossn_theme_url('images/background.jpg'));?>") no-repeat;
	background-size: cover;
}

.ossn-layout-startup .col-lg-11 {
	width: 100%;
}

.ossn-layout-startup footer .ossn-footer-menu a {
	color: #fff;
}

.ossn-home-container {
	margin-top: 20px;
}

.ossn-layout-newsfeed .newsfeed-right {}

.ossn-page-container {
	overflow-x: hidden;
	min-height: 400px;
}

.ossn-layout-module {
	margin-top: 10px;
	background: #fff;
	margin-bottom: 10px;
	background-color: rgb(255, 255, 255);
	box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 2px;
	border-radius: 10px;
}

.ossn-layout-module .module-title {
	background: #F9F7F7;
	border: 1px solid #eee;
	padding: 10px;
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
}

.ossn-layout-module .module-contents {
	padding: 10px;
}

.ossn-layout-module .module-title .title {
	font-weight: bold;
	display: inline-block;
}

.ossn-layout-module .controls {
	float: right;
	display: inline-table;
}

.ossn-layout-media {
	margin-top: 10px;
}

.ossn-layout-media .like-share,
.ossn-layout-media .comments-list {
	margin-left: -10px;
	margin-right: -10px;
}

.ossn-layout-media .content,
.ossn-page-contents {
	background: #fff;
	padding: 10px;
	border: 1px solid #eee;
	border-radius: 10px;
}

.opensource-socalnetwork {
	min-height: 500px;
}

.ossn-home-container .row {
	margin-right: 10px;
	margin-left: 10px;
}

#ossn-signup-errors {
	display: none;
	margin-top: 10px;
}

.ossn-error-page {
	text-align: center;
	padding: 100px;
}

.ossn-error-page .error-heading {
	font-size: 50px;
	font-weight: bold;
}

.ossn-error-page .error-text {
	font-size: 16px;
}

.ossn-error-page .fa-exclamation-triangle {
	font-size: 100px;
}

.ossn-page-loading-annimation {
	background: #fff;
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
}

.ossn-page-loading-annimation .ossn-page-loading-annimation-inner {
	width: 24px;
	margin: 0 auto;
	margin-top: 20%;
}

.newsfeed-middle-top {
	display: none;
	background-color: #fff;
	box-shadow: inset 0 0 0 1px rgba(144, 144, 144, 0.25);
	border-radius: 3px;
	margin-top: 2px;
	margin-bottom: 4px;
	padding: 9px;
}

.newsfeed-col-wall {
	flex: 0 0 62.5%; 
	max-width: 62.5%;
}
.newsfeed-col-sidebar {
	flex: 0 0 37.5%; 
	max-width: 37.5%;
}
/*******************************
	Topbar	
********************************/

.topbar {
	background: #0b769c;
	color: #fff;
	z-index: 1;
	position: fixed;
	height: 55px;
	width:100%;
	z-index: 1051;
	
	-webkit-transition: width 0.5s ease;
	-moz-transition: width 0.5s ease;
	transition: width 0.5s ease;
}

.sidebar-close-page-container .topbar,
.ossn-page-container .topbar {
	width: 100%;
}

.sidebar-open-page-container .topbar {
	width: calc(100% - var(--layout-sidebar-width)) !important;
}
.sidebar-open-page-container-no-annimation .topbar {
	transition: none !important;
	-webkit-transition: none !important;
	-moz-transition: none !important;
	width: calc(100% - var(--layout-sidebar-width)) !important;
}
/** inner page padding because of topbar fixed **/
:not(:has(.topbar.position-relative)) .ossn-inner-page {
    margin-top: 70px;
}
.topbar .fa {
	font-size: 20px;
	margin-top: 5px;
}

.topbar .site-name a {
	text-transform: uppercase;
	font-size: 20px;
	padding: 10px;
	color: #fff;
	display: block;
	font-weight: bold;
}

.topbar .site-name a:hover {
	text-decoration: none;
}

.topbar-menu-left {
	position: relative;
	z-index: 1;
}

.topbar-menu-right ul {
	margin-bottom: 0px;
}

.topbar-menu-right li,
.topbar-menu-left li {
	display: inline-block;
}

.topbar-menu-right li a:not(.topbar-menu-right li .dropdown-item),
.topbar-menu-left li a {
	padding: 13px 10px;
	display: block;
	color: #fff;
}

.topbar-menu-right li:hover,
.topbar-menu-left li:hover {
	cursor: pointer;
	background-color: #0a6586;
}

.topbar .right-side-nospace .topbar-menu-right {
	margin-right: 0px;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}

.topbar .right-side-space .topbar-menu-right {
	margin-right: 10px;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}

.topbar .ossn-icons-topbar-friends,
.topbar .ossn-icons-topbar-messages,
.topbar .ossn-icons-topbar-notification i {
	color: #0f3b4a;
}

.topbar .ossn-icons-topbar-friends-new,
.topbar .ossn-icons-topbar-messages-new,
.topbar .ossn-icons-topbar-notifications-new i {
	color: #fff;
}

.topbar .left-side {
	left: 0;
}

.topbar .right-side {
	right: 0;
}

.topbar .site-name {
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	position: absolute;
}

.topbar .site-name,
.topbar .right-side {
	position: absolute;
}

/************************************************
   Topbar Dropdown and Post+Comment menu icons
*************************************************/
/**********************************************
[B] Icons for comment edit and delete on photo view not showing #2416
***********************************************/
.ossn-comment-menu .dropdown-menu li a:before,
.ossn-topbar-dropdown-menu ul li a:before {
	content: "\f068";
	display: inline-block;
	float: left;
	margin-right: 10px;
	font-family: var(--fa-style-family, "Font Awesome 6 Free");
	font-weight: var(--fa-style, 900);
}

.menu-topbar-dropdown-administration:before {
	content: "\f085" !important;
}

.menu-topbar-dropdown-account_settings:before {
	content: "\f4fe" !important;
}

.menu-topbar-dropdown-logout:before {
	content: "\f011" !important;
}


.ossn-topbar-dropdown-menu {
	float: right;
}

.ossn-topbar-dropdown-menu ul li a,
.ossn-topbar-dropdown-menu ul li {
	display: block;
	width: 100%;
	color: #000;
}

.ossn-topbar-dropdown-menu .dropdown-menu {
	margin: 1px -120px 0;
	min-width: 200px;
}

.ossn-like-comment,
.ossn-total-likes {
	margin-left: 10px;
}


/********************************
	Global
***********************************/

.time-created {
	font-size: 14px;
	font-style: italic;
	color: #999;
}


/********************************
	Sidebar Nav
*********************************/

.sidebar {
	background-color: #1e293b;
	;
	height: 200px;
	z-index: 1000;
	width: var(--layout-sidebar-width);
	position: fixed;
	height: 100%;
	margin-left: calc(-1 * var(--layout-sidebar-width));
	overflow-y: auto;
	overflow-x: hidden;
	color: #fff;

	scrollbar-width: thin;
	scrollbar-color: #64748b #1e293b;
}

.sidebar::-webkit-scrollbar {
	width: 8px;
}

.sidebar::-webkit-scrollbar-track {
	background: #1e293b;
}

.sidebar::-webkit-scrollbar-thumb {
	background-color: #334155;
	border-radius: 4px;
	border: 2px solid #1e293b;
}

.sidebar::-webkit-scrollbar-thumb:hover {
	background-color: #475569;
}

.sidebar a {
	color: #fff;
	font-size: 14px;
}

.sidebar a li:before {
	font-size: initial;
}

.sub-menu.collapse {
	transition: none !important;
}

.sidebar-close {
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}

.sidebar-open {
	margin-left: 0px;
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}

.sidebar-open-no-annimation {
	margin-left: 0px;
}

.sidebar-open-page-container {
	margin-left: var(--layout-sidebar-width);
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}

.sidebar-open-page-container-no-annimation {
	margin-left: var(--layout-sidebar-width);
}

.sidebar-close-page-container {
	-webkit-transition: all 0.5s ease;
	-moz-transition: all 0.5s ease;
	-o-transition: all 0.5s ease;
	transition: all 0.5s ease;
}

.newseed-uinfo {
	display: flex;
	align-items: center;
	padding: 15px;
	background: rgba(255, 255, 255, 0.03);
	border: 1px solid rgba(255, 255, 255, 0.05);
	border-radius: 12px;
	margin: 10px;
	gap: 12px;
}

/* Small Avatar Styling */
.user-icon-small {
	width: 48px;
	height: 48px;
	border-radius: 10px;
	object-fit: cover;
}

/* Name and Links Container */
.newseed-uinfo .name {
	display: flex;
	flex-direction: column;
	justify-content: center;
}

/* User Display Name */
.newsfeed-user-info-top {
	font-size: 15px;
	font-weight: 700;
	color: #ffffff !important;
	text-decoration: none !important;
	line-height: 1.2;
	transition: color 0.2s ease;
}

.newsfeed-user-info-top:hover {
	color: #3fb1d9 !important;
}

/* Edit Profile Link */
.edit-profile {
	font-size: 11px;
	color: #64748b !important;
	/* Muted Slate */
	text-decoration: none !important;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	margin-top: 4px;
	font-weight: 600;
	transition: color 0.2s ease;
}

.edit-profile:hover {
	color: #ffffff !important;
}

.sidebar-menu-nav {
	overflow: auto;
	font-size: 13px;
	font-weight: 200;
	top: 0px;
	width: 100%;
	height: 100%;
}

.sidebar-menu-nav li:not(.sub-menu li) {
	padding: 5px;
	margin: 10px;
	cursor: pointer;

}

.sidebar-menu-nav ul {
	list-style: none;
	padding: 0px;
	margin: 0px;
}

.sub-menu.collapsing,
.sub-menu.show {
	background: #293850;
	margin: 10px;
	border-radius: 10px;
}

.sidebar .sub-menu a {
	padding: 7px;
	display: block;
}

.sidebar .sub-menu li {}

.sidebar .sidebar-parent-item-main[aria-expanded="true"] a {
	color: #000;
}

.sidebar .sidebar-parent-item-main[aria-expanded="true"] {
	background: #fff;
	padding: 10px;
	border-radius: 10px;
}

.sidebar-menu-nav ul:not(collapsed) .arrow:before,
.sidebar-menu-nav li:not(collapsed) .arrow:before {
	font-family: 'Font Awesome 5 Free';
	content: "\f078";
	display: inline-block;
	padding-left: 10px;
	padding-right: 10px;
	font-weight: 900;
	vertical-align: middle;
	float: right;
}

.sidebar .sidebar-parent-item-main[aria-expanded="true"] a .arrow:before {
	content: "\f077" !important;
}

.sidebar-menu-nav ul .sub-menu li,
.sidebar-menu-nav li .sub-menu li {
	border: none;
}

.sidebar-menu-nav ul .sub-menu li:before,
.sidebar-menu-nav li .sub-menu li:before {
	font-family: 'Font Awesome 5 Free';
	content: "\f105";
	display: inline-block;
	padding-left: 10px;
	padding-right: 10px;
	vertical-align: middle;
	font-weight: 900;
	font-size: 13px;
}

.sidebar-menu-nav li {
	padding-left: 0px;
	border-bottom: 1px solid #23282e;
}

.sidebar-menu-nav li a {
	text-decoration: none;
	color: #fff;
}

.sidebar-menu-nav li a i {
	padding-left: 10px;
	width: 20px;
	padding-right: 20px;
}

.sidebar .sub-menu a {}

.sidebar .sub-menu a:hover {
	background-color: #4f5b69;
	-webkit-transition: all 1s ease;
	-moz-transition: all 1s ease;
	-o-transition: all 1s ease;
	-ms-transition: all 1s ease;
	transition: all 1s ease;
	border-radius: 10px;
}

@media (max-width: 767px) {
	.sidebar-menu-nav {
		position: relative;
		width: 100%;
		margin-bottom: 10px;
	}
}


/******************************
	Ossn global css clsses
*******************************/

.right {
	float: right;
}

.left {
	float: left;

}

.text-right {
	text-align: right;
}

.text-left {
	text-align: left;
}

.text-center {
	text-align: center;
}

.margin-top-10 {
	margin-top: 10px;
}

.margin-top-20 {
	margin-top: 20px;
}


/************************
	Dropdown
***************************/

.dropdown-submenu {
	position: relative;
}

.dropdown-submenu>.dropdown-menu {
	top: 0;
	left: 100%;
	margin-top: -6px;
	margin-left: -1px;
	-webkit-border-radius: 0 6px 6px 6px;
	-moz-border-radius: 0 6px 6px;
	border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
	display: block;
}

.dropdown-submenu>a:after {
	display: block;
	content: " ";
	float: right;
	width: 0;
	height: 0;
	border-color: transparent;
	border-style: solid;
	border-width: 5px 0 5px 5px;
	border-left-color: #ccc;
	margin-top: 5px;
	margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
	border-left-color: #fff;
}

.dropdown-submenu.pull-left {
	float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
	left: -100%;
	margin-left: 10px;
	-webkit-border-radius: 6px 0 6px 6px;
	-moz-border-radius: 6px 0 6px 6px;
	border-radius: 6px 0 6px 6px;
}

.dropmenu-topbar-icons {
	left: inherit;
	right: 0;
}

/*****************************
	Widgets
******************************/

.ossn-widget {
	margin-bottom: 10px;
	background-color: #fff;
	border-radius: 10px;
	box-shadow: rgba(0, 0, 0, 0.2) 0px 1px 2px;
}

.ossn-widget .widget-heading {
	background: #F6F7F8;
	border: 1px solid #eee;
	padding: 10px;
	font-weight: bold;
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
}

.ossn-widget .widget-contents {
	padding: 10px;
	border-bottom: 1px solid #eee;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
}

.ossn-privacy .radio-block {
	margin-bottom: 0;
	margin-top: 0;
	display: flex;
}

.ossn-privacy label {
	margin-bottom: 0px;
}

.ossn-privacy .radio-block span {
	font-weight: normal;
	width: 85%;
	margin-top: 7px;
}

/*****************************
	Side Menu icons
*******************************/

.menu-section-item-newsfeed:before {
	content: "\f0a1" !important;
}

.menu-section-item-friends:before {
	content: "\f0c0" !important;
}

.menu-section-item-allgroups:before {
	content: "\f0c0" !important;
}

.menu-section-item-photos:before {
	content: "\f03e" !important;
}

.menu-section-item-messages:before {
	content: "\f0e0" !important;
}

.menu-section-item-invite-friends:before {
	content: "\f234" !important;
}

.menu-section-item-addgroup:before {
	content: "\f067" !important;
}

li[class^="menu-section-item-"] {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
	width: 100%;
	padding-right: 10px;
}


/******************************
	Search
******************************/

.ossn-menu-search li {
	display: block;
}

.ossn-menu-search li:hover {
	background: #F9F9F9;
}

.ossn-menu-search li a {
	display: block;
	width: 100%;
	padding: 5px;
}

.ossn-menu-search li a:hover {
	text-decoration: none;
}

.ossn-menu-search li a .text {
	display: inline-block;
}

.ossn-search-page .ossn-users-list-item {
	margin-left: 0px;
	margin-right: 0px;
}

.ossn-search-page .ossn-users-list-item .uinfo {
	margin-left: 25px;
}

.ossn-menu-search-users .text:before {
	font-family: 'Font Awesome 5 Free';
	content: "\f007";
	font-weight: 900;
	padding-right: 10px;
	vertical-align: middle;
	float: left;
}

.ossn-menu-search-groups .text:before {
	font-family: 'Font Awesome 5 Free';
	content: "\f0c0";
	font-weight: 900;
	padding-right: 10px;
	vertical-align: middle;
	float: left;
}

/* Container and Form Reset */
.ossn-search {
	margin: 5px;
	padding: 0;
}

.ossn-search fieldset {
	border: none;
	padding: 0;
	margin: 0;
	position: relative;
}

/* The Search Input Field */
.ossn-search input[type="text"] {
	width: 100%;
	background: rgba(255, 255, 255, 0.05) !important;
	/* Low-opacity glass */
	border: 1px solid rgba(255, 255, 255, 0.1) !important;
	border-radius: 10px !important;
	/* Consistent with your avatar style */
	padding: 10px 15px 10px 40px !important;
	/* Extra left padding for icon */
	color: #ffffff !important;
	font-size: 14px !important;
	height: 40px !important;
	transition: all 0.3s ease;
	outline: none;
}

/* Add a Search Icon via CSS */
.ossn-search fieldset::before {
	content: "\f002";
	/* FontAwesome Search Icon */
	font-family: "FontAwesome";
	position: absolute;
	left: 15px;
	top: 50%;
	transform: translateY(-50%);
	color: #64748b;
	/* Muted slate color */
	font-size: 14px;
	pointer-events: none;
}

/* Focus State: Brand Blue Glow */
.ossn-search input[type="text"]:focus {
	background: rgba(255, 255, 255, 0.08) !important;
	border-color: #0b769c !important;
	/* Your brand blue */
	box-shadow: 0 0 0 3px rgba(11, 118, 156, 0.2);
}

/* Placeholder Color */
.ossn-search input[type="text"]::placeholder {
	color: #64748b;
	opacity: 1;
}

/******************************
	Token Input
*******************************/

ul.token-input-list {
	overflow: hidden;
	height: auto !important;
	width: 100%;
	cursor: text;
	font-size: 12px;
	min-height: 1px;
	margin: 0;
	z-index: 999;
	background-color: #fff;
	list-style-type: none;
	clear: left;
	color: #2B5470;
	border-top: 1px dashed #EEE;
	border-right: 1px solid #EEE;
	border-left: 1px solid #EEE;
	border-bottom: 1px solid #eee;
	padding: 5px 0 0;
	border-radius: 10px;
}

li.token-input-token {
	overflow: hidden;
	height: auto !important;
	height: 15px;
	margin: 3px;
	padding: 1px 3px;
	background-color: #eff2f7;
	color: #2B5470;
	cursor: default;
	font-weight: bold;
	border: 1px solid #ccd5e4;
	font-size: 11px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	float: left;
	white-space: nowrap;
}

li.token-input-token p {
	display: inline;
	padding: 0;
	margin: 0;
	font-size: 12px;
}

li.token-input-token span {
	color: #a6b3cf;
	margin-left: 5px;
	font-weight: bold;
	cursor: pointer;
}

li.token-input-selected-token {
	background-color: #F9F9F9;
	border: 1px solid #eee;
	color: #2B5470;
	font-weight: bold;
}

li.token-input-input-token {
	margin: 0;
	padding: 0;
	list-style-type: none;
}

div.token-input-dropdown {
	position: absolute;
	width: 400px;
	background-color: #fff;
	overflow: hidden;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	cursor: default;
	font-size: 11px;
	z-index: 1;
}

div.token-input-dropdown p {
	margin: 0;
	padding: 5px;
}

div.token-input-dropdown ul {
	margin: 0;
	padding: 0;
}

div.token-input-dropdown ul li {
	background-color: #fff;
	padding: 3px;
	margin: 0;
	list-style-type: none;
}

div.token-input-dropdown ul li.token-input-dropdown-item {
	background-color: #fff;
}

div.token-input-dropdown ul li.token-input-dropdown-item2 {
	background-color: #fff;
}

div.token-input-dropdown ul li em {
	font-weight: bold;
	font-style: normal;
}

div.token-input-dropdown ul li.token-input-selected-dropdown-item {
	background-color: #F9F9F9;
	color: #2B5470;
	font-weight: bold;
}

/*************************************
	0ssn modal box
***************************************/

.ossn-halt {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	z-index: 10000;
	background-color: #c4c4c487;
	cursor: auto;
	height: 100%;
	display: none;
}

.ossn-light {}

.ossn-viewer {
	width: 940px;
	margin: 0 auto;
	position: relative;
}

.ossn-viewer .ossn-container {
	height: 200px;
	position: fixed;
	width: 900px;
	z-index: 10000;
	margin-top: 70px;
	min-height: 515px;
}

.ossn-viewer-loding {
	font-size: 15px;
}

.ossn-viewer .ossn-container .close-viewer {
	float: right;
	cursor: pointer;
	margin-right: 5px;
	font-weight: bold;
	font-size: 13px;
	color: #ccc;
}

.ossn-container tbody {
	background: #000;
}

.ossn-viewer .info-block {
	background: #fff;
	height: 100%;
	width: 325px;
	float: right;
	margin-left: -3px;
}

.image-block img {
	max-width: 700px;
}

.ossn-message-box {
	width: 470px;
	min-height: 96px;
	background: #fff;
	border-radius: 16px;
	border: 10px solid #999999b5;
	position: fixed;
	top: 0px;
	left: 0px;
	right: 0px;
	margin-left: auto;
	margin-right: auto;
	z-index: 60000;
	margin-top: 100px;
	display: none;
	background-clip: padding-box;
	box-shadow: 0 2px 26px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(0, 0, 0, 0.1);
}

.ossn-message-box .close-box {
	float: right;
	color: #ccc;
	cursor: pointer;
}

.ossn-message-box .title {
	background: #F5F6F7;
	padding: 11px;
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
	border-bottom: 1px solid #E5E5E5;
	color: #5E5656;
	font-size: 14px;
	font-weight: bold;
}

.ossn-message-box .contents {
	padding: 10px;
	min-height: 150px;
	max-height: 420px;
	overflow-x: auto;
	overflow: overlay;
	overflow-x: hidden;
}

.ossn-message-box .control {
	height: 45px;
	padding: 10px;
	border-top: 1px solid #E9EAED;
	background: #F5F6F7;
	border-bottom-right-radius: 10px;
	border-bottom-left-radius: 10px;
}

.ossn-message-box .control .controls {
	float: right;
}

.ossn-message-box .control .controls .btn {
	padding: 2px 13px;
	border-radius: 5px;
}

.ossn-message-box .contents input[type='text'] {
	border: 1px solid #EEE;
	width: 292px;
	padding: 7px;
}

.ossn-message-box .contents input[type='text'],
.ossn-message-box .contents label {
	display: inline-table;
}

.ossn-message-box .contents label {
	color: #666;
	font-weight: bold;
	margin-right: 13px;
}

.ossn-form input[type=checkbox],
.ossn-form input[type=radio] {
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	display: inline-block;
	position: relative;
	background-color: #ececec;
	color: #666;
	top: 5px;
	height: 20px;
	width: 20px;
	border: 0;
	border-radius: 50px;
	cursor: pointer;
	outline: none;
	flex-grow: 0;
	transition: background 300ms;
}

.ossn-form input[type=checkbox] {
	border-radius: 2px;
}

.ossn-form input[type=checkbox]:checked::before {
	font: 9px/1 'Open Sans', sans-serif;
	left: 7px;
	top: 5px;
	content: '\02143';
}

.ossn-form input[type=radio]:checked::before {
	position: absolute;
	font: 9px/1 'Open Sans', sans-serif;
	left: 7px;
	top: 5px;
	content: '\02143';
	transform: rotate(40deg);
}

.ossn-form input[type=checkbox]:hover,
.ossn-form input[type=radio]:hover {
	background-color: #f7f7f7;
}

.ossn-form input[type=checkbox]:checked,
.ossn-form input[type=radio]:checked {
	background-color: #0b769c;
	color: #fff;
	font-weight: bold;
}

.checkbox-block span {
	margin-top: 6px;
}

.checkbox-block-container {
	margin-bottom: 20px;
}

#ossn-home-signup .checkbox-block {
	margin-top: 0;
	margin-bottom: 0;
}

/*******************************
	Ossn Blocked
*********************************/

.ossn-blocked i {
	font-size: 100px;
}

.ossn-blocked {
	text-align: center;
	padding: 100px;
}

.ossn-blocked div {
	font-size: 50px;
	font-weight: bold;
}

.ossn-blocked p {
	font-size: 16px;
}


/********************************
	Loading Icon
    @source: https://github.com/jlong/css-spinners
*********************************/

@-moz-keyframes three-quarters-loader {
	0% {
		-moz-transform: rotate(0deg);
		transform: rotate(0deg);
	}

	100% {
		-moz-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}

@-webkit-keyframes three-quarters-loader {
	0% {
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
	}

	100% {
		-webkit-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}

@keyframes three-quarters-loader {
	0% {
		-moz-transform: rotate(0deg);
		-ms-transform: rotate(0deg);
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
	}

	100% {
		-moz-transform: rotate(360deg);
		-ms-transform: rotate(360deg);
		-webkit-transform: rotate(360deg);
		transform: rotate(360deg);
	}
}


/* :not(:required) hides this rule from IE9 and below */

.ossn-loading:not(:required) {
	-moz-animation: three-quarters-loader 1250ms infinite linear;
	-webkit-animation: three-quarters-loader 1250ms infinite linear;
	animation: three-quarters-loader 1250ms infinite linear;
	border: 8px solid #38e;
	border-right-color: transparent;
	border-radius: 16px;
	box-sizing: border-box;
	position: relative;
	overflow: hidden;
	text-indent: -9999px;
	width: 24px;
	height: 24px;
}


.ossn-box-loading {
	margin-left: 216px;
	margin-top: 37px;
}


/*******************************
	Buttons
*********************************/

.button-grey,
.btn-action {
	color: #333;
	font-weight: bold;
	width: auto;
	margin: 0;
	font-size: 12px;
	line-height: 16px;
	padding: 5px 6px;
	cursor: pointer;
	outline: none;
	text-align: center;
	white-space: nowrap;
	-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #FFF;
	-moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.10), inset 0 1px 0 #fff;
	box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #FFF;
	border: 1px solid #ccc;
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#F5F6F6), to(#E4E4E3));
	background: -moz-linear-gradient(#f5f6f6, #e4e4e3);
	background: -o-linear-gradient(#f5f6f6, #e4e4e3);
	background: linear-gradient(#F5F6F6, #E4E4E3);
	border-radius: 4px;
	text-decoration: none;
}

.button-grey:hover,
.btn-action:hover {
	text-decoration: none;
	background: -webkit-gradient(linear, 0 0, 0 100%, from(#E4E4E3), to(#F5F6F6));
	background: -moz-linear-gradient(#E4E4E3, #F5F6F6);
	background: -o-linear-gradient(#E4E4E3, #F5F6F6);
	background: linear-gradient(#E4E4E3, #F5F6F6);
}


/******************************
	Users List
*******************************/

.ossn-users-list-item .users-list-controls {
	margin-top: 20px;
}

.ossn-users-list-item .users-list-controls a {
	margin-left: 5px;
}

.ossn-users-list-item {
	border: 1px solid #E9EAED;
	margin-bottom: 10px;
	margin-right: -10px;
	margin-left: -10px;
}

.ossn-users-list-item .uinfo a {
	font-size: 14px;
	font-weight: bold;
	margin-top: 20px;
	float: left;
	text-overflow: ellipsis;
	max-width: 300px;
	white-space: nowrap;
	overflow: hidden;
}

.ossn-users-list-item .col-lg-2 {
	text-align: center;
}


/*********************************
	Footer
**********************************/

footer {
	margin-top: 20px;
	padding-top: 5px;
	position: relative;
}

footer {
	border-top: 1px solid #d2d2d2;
}

footer .container {}

footer .ossn-footer-menu {
	padding-bottom: 10px;
}

footer .ossn-footer-menu a {
	color: #807D7D;
	font-size: 13px;
}

footer .ossn-footer-menu a::after {
	content: "|";
	margin-left: 10px;
	margin-right: 10px;
}

footer .ossn-footer-menu a:nth-last-child(2)::after,
footer .ossn-footer-menu a:last-child::after {
	content: "";
}

.menu-footer-powered {
	float: right;
}

.menu-footer-powered:after {
	display: none;
}

.menu-footer-a_copyrights {
	text-transform: uppercase;
}


/****************************
	Home
****************************/

.home-left-contents {}

.home-left-contents .logo {
	text-align: center;
}

.home-left-contents .description {
	font-size: 17px;
	text-transform: uppercase;
	font-weight: bold;
	margin-top: 20px;
	text-align: justify;
	color: #fff;
}

.home-left-contents .buttons {
	text-align: center;
	margin-top: 10px;
}

#ossn-home-signup p {
	margin-top: 10px;
}

#ossn-home-signup .radio-block {
	margin-top: 0;
	margin-bottom: 0;
}

#ossn-home-signup .ossn-form-group-half:last-child {
	float: right;
}

#ossn-home-signup .form-group {
	margin-bottom: 0px;
}


/**************************
	System
***************************/

.ossn-list-users {
	height: 60px;
	border-bottom: 1px solid #E9EAED;
	display: block;
	margin-left: 5px;
	margin-bottom: 10px;
}

.ossn-list-users img,
.ossn-list-users .uinfo {
	display: inline-block;
}

.ossn-list-users .uinfo .userlink {
	font-size: 14px;
	font-weight: bold;
	float: right;
	margin-left: 12px;
	text-overflow: ellipsis;
	width: 370px;
	white-space: nowrap;
	overflow: hidden;
}

.ossn-list-users .friendlink {
	float: right;
	margin-top: 10px;
	margin-right: 9px;
	text-overflow: ellipsis;
	width: 280px;
	white-space: nowrap;
	overflow: hidden;
}

.sidebar-menu-nav .sidebar-menu .menu-content {
	display: block;
}

.ossn-box-inner {
	width: 435px;
}

.landing-page-icons {
	color: #fff;
	text-align: center;
	margin-top: 30px;
}

.landing-page-icons-span {
	border: 3px solid;
	border-radius: 50px;
	display: inline-block;
	width: 90px;
	text-align: center;
	padding-top: 20px;
	padding-bottom: 20px;
	margin: 10px;
}

.landing-page-icons-span .fa {
	margin-right: 0px;
}


/**************************
	Similies
**************************/

.ossn-smiley-item {
	display: inline-block !important;
	margin-left: 2px;
	margin-right: 2px;
	width: initial !important;
	margin-bottom: 0px !important;
	margin-top: 0px !important;
	border: 0px !important;
}


/**************************
	Embed
 **************************/

.ossn_embed_video {
	margin-top: 10px;
	margin-bottom: 10px;
	padding-top: 0px;
}


/**************************
	Photos
***************************/

.ossn-photo-viewer .image-block img,
.ossn-photo-viewer {
	max-width: 100% !important;
}

.ui-draggable {
	opacity: 0.7;
}


/**************************
	Mobile Layout Settings
***************************/

@media (max-width: 480px) {
	.ossn-list-users .uinfo .userlink {
		text-overflow: ellipsis;
		width: 195px;
		white-space: nowrap;
		overflow: hidden;
	}

	.ossn-list-users a.right.btn.btn-primary {
		display: none;
	}

	.ossn-list-users a.right.btn.btn-danger {
		display: none;
	}

	.ossn-message-box .contents {
		height: 280px;
		overflow-x: auto;
		overflow: overlay;
	}

	/***************************
    	Topbar notification box
   *****************************/
	.ossn-notifications-box {
		width: 300px;
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


	/*****************************
     	System
     *****************************/
	.ossn-users-list-item img {
		display: none;
	}

	.ossn-users-list-item .users-list-controls {
		margin-top: 10px;
		margin-bottom: 10px;
	}

	.ossn-users-list-item .uinfo a {
		margin-top: 10px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		max-width: 90px;
	}

	.ossn-search-page .ossn-users-list-item .uinfo a {
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		max-width: 100px;
	}

	.ossn-users-list-item {
		padding-bottom: 10px;
	}

	.ossn-widget .widget-contents {
		padding: 5px;
	}

	.ossn-message-box {
		min-width: 300px;
		width: 300px;
	}

	.ossn-box-loading {
		margin-left: 0;
		margin-top: 0;
		margin: 40px auto;
	}

	.ossn-message-box .contents input[type="text"] {
		width: 195px;
	}

	.ossn-box-inner {
		width: 280px;
	}

	footer .ossn-footer-menu a:nth-last-child(2)::after {
		content: "|";
	}

	.sidebar-menu-nav .sidebar-menu .menu-content {
		display: block;
	}

	.sidebar-hide-contents-xs {
		display: none !important;
	}

	.home-left-contents .landing-page-icons {
		display: none;
	}

	/**************************
     	Layouts
     ****************************/
	.newsfeed-right {
		display: none;
	}

	.newsfeed-middle-top {
		display: block;
	}

	/*************************
     	Home Page
     **************************/
	.logo img {
		width: 260px;
	}

	.home-left-contents .description {
		font-size: 16px;
	}

	.home-left-contents {
		margin-bottom: 20px;
	}

	.dropdown-menu {
		margin-left: -110px;
	}

	.menu-footer-powered {
		float: none;
	}
}


/***************************************
	Tablets
****************************************/

@media only screen and (max-width: 992px) {
	.dropdown-menu {
		margin-left: -110px;
	}


	/**************************
     	Layouts
     ****************************/
	.newsfeed-right {
		display: none;
	}

	.newsfeed-middle-top {
		display: block;
	}

	.sidebar-menu-nav .sidebar-menu .menu-content {
		display: block;
	}
}

@media only screen and (max-width: 1199px) {
	.ossn-search-page .ossn-users-list-item .uinfo {
		margin-left: 35px;
	}

	.ossn-search-page .ossn-users-list-item .uinfo a {
		text-overflow: ellipsis;
		max-width: 200px;
		white-space: nowrap;
		overflow: hidden;
	}

	.ossn-users-list-item .users-list-controls {
		margin-bottom: 10px;
	}
}

@media only screen and (max-width: 767px) {
	.ossn-search-page .ossn-users-list-item .uinfo {
		margin-left: 0;
	}
}


/*****************************************************
		Adding icons for some 3rd party components
******************************************************/

.sidebar-menu-nav ul .sub-menu li:before {
	font-family: 'Font Awesome 5 Free';
	display: inline-block;
	padding-left: 10px;
	padding-right: 10px;
	vertical-align: middle;
	width: 35px;
	float: left;
}

.btn-close {
	background-size: .7em;
}

.img-responsive {
	display: block;
	max-width: 100%;
	height: auto;
}

/*************************
	3.x buttons styles
***************************/
.btn-close:focus {
	box-shadow: none;
}

.btn-warning {
	color: #fff;
}

.btn-primary {
	background-color: #2a87a7;
	border-color: #2e6da4;
}

.btn-primary:hover {
	color: #fff;
	background-color: #286090;
	border-color: #204d74;
}

.btn-primary:focus,
.btn-primary.focus {
	color: #fff;
	background-color: #286090;
	border-color: #122b40;
}

.btn-check:checked+.btn-primary:focus,
.btn-check:active+.btn-primary:focus,
.btn-primary:active:focus,
.btn-primary.active:focus,
.show>.btn-primary.dropdown-toggle:focus {
	box-shadow: none;
}

.btn:focus {
	box-shadow: none;
}

.btn-warning {
	color: #fff;
	background-color: #f0ad4e;
	border-color: #eea236;
}

.btn-warning:active {
	color: #fff;
}

.btn-warning:focus,
.btn-warning.focus {
	color: #fff;
	background-color: #ec971f;
	border-color: #985f0d;
}

.btn-default {
	color: #333;
	background-color: #fff;
	border-color: #ccc;
}

.btn-default:focus,
.btn-default.focus {
	color: #333;
	background-color: #e6e6e6;
	border-color: #8c8c8c;
}

.btn-default:hover {
	color: #333;
	background-color: #e6e6e6;
	border-color: #adadad;
}

.btn-default:active,
.btn-default.active,
.open>.dropdown-toggle.btn-default {
	color: #333;
	background-color: #e6e6e6;
	border-color: #adadad;
}

.pagination {
	margin: 20px 0;
}

.dropdown-item.active,
.dropdown-item:active {
	color: #212529;
	background-color: #e9ecef;
}

.page-item.active .page-link {
	background-color: #337ab7;
	border-color: #337ab7;
}

.page-link {
	color: #337ab7;
}

.page-link:hover {
	color: #23527c;
	background-color: #eee;
	border-color: #ddd;
}

label {
	display: inline-block;
	max-width: 100%;
	margin-bottom: 5px;
	font-weight: 700;
}

.dropdown-menu {
	box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.20), 0 2px 4px 0 rgba(0, 0, 0, 0.1), inset 0 0 0 1px rgba(255, 255, 255, 0.5);
}

/*****************************
	Startup Layout Ossn 9.0
******************************/
.ossn-startup-wrapper {
	position: relative;
	background: #f8f8f8;
	min-height: 100vh;
	overflow: hidden;
	display: flex;
	align-items: center;
}

.ossn-startup-wrapper .blob-container {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
}

.ossn-startup-wrapper .blob {
	position: absolute;
	width: 600px;
	height: 600px;
	background: linear-gradient(135deg, rgba(102, 126, 234, 0.4) 0%, rgba(118, 75, 162, 0.4) 100%);
	filter: blur(70px);
	border-radius: 43% 57% 70% 30% / 30% 45% 55% 70%;
}

.ossn-startup-wrapper .blob-1 {
	top: -10%;
	left: -10%;
	background: rgba(102, 126, 234, 0.2);
}

.ossn-startup-wrapper .blob-2 {
	bottom: -10%;
	right: -5%;
	background: rgba(255, 126, 179, 0.15);
}

.ossn-startup-wrapper .blob-3 {
	top: 20%;
	right: 20%;
	width: 300px;
	height: 300px;
	background: rgba(130, 255, 160, 0.1);
}

.ossn-startup-wrapper .blob-4 {
	bottom: 10%;
	left: 20%;
	width: 400px;
	height: 400px;
	background: rgba(0, 210, 255, 0.1);
}

/* Glass Branding Box */
.ossn-startup-wrapper .brand-glass-box {
	display: inline-block;
	padding: 15px 25px;
	background: #fff;
	backdrop-filter: blur(5px);
	border-radius: 15px;
	border: 1px solid rgba(255, 255, 255, 0.5);
}

.ossn-startup-wrapper .main-logo {
	max-width: 180px;
}

.ossn-startup-wrapper .signup-title span {
	font-size: 14px;
	text-transform: uppercase;
	letter-spacing: 1px;
	display: block;
	margin-bottom: 10px;
}

/* Pill styles */
.ossn-startup-wrapper .feature-pills-modern {
	display: flex;
	gap: 10px;
	margin-top: 25px;
}

.ossn-startup-wrapper .feature-tag,
.ossn-startup-wrapper .pill {
	display: inline-flex;
	align-items: center;
	padding: 8px 18px;
	background: #ffffff;
	border: 1px solid #e2e8f0;
	border-radius: 50px;
	font-size: 13px;
	font-weight: 600;
	color: #475569;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
	margin-right: 10px;
	margin-bottom: 10px;
	transition: transform 0.2s ease, border-color 0.2s ease;
}

/* Hover effect */
.ossn-startup-wrapper .feature-tag:hover,
.ossn-startup-wrapper .pill:hover {
	transform: translateY(-2px);
	border-color: #cbd5e1;
	background: #fdfdff;
}

/* Icon inside the pill */
.ossn-startup-wrapper .feature-tag i,
.ossn-startup-wrapper .pill i {
	margin-right: 8px;
	color: #0b769c;
	font-size: 14px;
}

/* Background & Hero */
.ossn-startup-wrapper .ossn-modern-landing {
	background: #f8fafc;
	min-height: 100vh;
	position: relative;
	overflow: hidden;
	padding: 50px 0;
}

.ossn-startup-wrapper .bg-blob,
.ossn-startup-wrapper .bg-blob-2 {
	position: absolute;
	width: 400px;
	height: 400px;
	background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
	filter: blur(80px);
	opacity: 0.15;
	z-index: 0;
	border-radius: 50%;
}

.ossn-startup-wrapper .bg-blob {
	top: -100px;
	right: -50px;
}

.ossn-startup-wrapper .bg-blob-2 {
	bottom: -100px;
	left: -50px;
}

.ossn-startup-wrapper .hero-logo {
	max-width: 200px;
	margin-bottom: 25px;
}

.ossn-startup-wrapper .hero-tagline {
	font-size: 2.5rem;
	font-weight: 700;
	color: #2d3748;
	margin-bottom: 30px;
}

.ossn-startup-wrapper .feature-grid {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 15px;
	margin-bottom: 30px;
}

.ossn-startup-wrapper .feature-item {
	font-size: 1rem;
	color: #4a5568;
}

.ossn-startup-wrapper .feature-item i {
	color: #667eea;
	margin-right: 8px;
}

.ossn-startup-wrapper .glass-signup-card {
	background: #fff;
	color: #fff;
	backdrop-filter: blur(25px);
	-webkit-backdrop-filter: blur(25px);
	padding: 45px;
	border-radius: 30px;
	border: 1px solid rgba(255, 255, 255, 0.4);
	box-shadow: 0 20px 40px rgba(0, 0, 0, 0.06);
	z-index: 2;
	position: relative;
	overflow: hidden;
}

/* Inner glow */
.ossn-startup-wrapper .glass-signup-card::after {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	border-radius: 30px;
	pointer-events: none;
	background: linear-gradient(135deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0) 100%);
	z-index: -1;
}

.ossn-startup-wrapper .signup-title h2 {
	font-weight: 800;
	margin-bottom: 0px;
	text-shadow: 0 1px 2px rgba(255, 255, 255, 0.5);
}

/* Inline Form Logic */
.ossn-startup-wrapper .custom-row {
	display: flex;
	flex-wrap: wrap;
	gap: 15px;
}

.ossn-startup-wrapper .custom-col {
	flex: 1;
	min-width: 0;
}

.ossn-startup-wrapper .modern-field:focus {
	background: #fff !important;
	border-color: #667eea !important;
	box-shadow: 0 4px 12px rgba(102, 126, 234, 0.1) !important;
}

.ossn-startup-wrapper .terms-text {
	font-size: 14px;
	color: #fff;
	margin-top: 15px;
}

.topbar::before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background:
		radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
		radial-gradient(circle at 80% 80%, rgba(0, 0, 0, 0.1) 0%, transparent 50%);
	pointer-events: none;
}

.ossn-startup-wrapper .glass-signup-card:before {
	content: "";
	position: absolute;
	inset: 0;
	background-size: cover;
	z-index: -2;
	background: url("<?php echo ossn_theme_url();?>images/background.jpg") no-repeat;
	background-size: cover;
}

.ossn-startup-wrapper .glass-signup-card:after {
	content: "";
	position: absolute;
	inset: 0;
	z-index: -1;
	border-radius: 24px;
	background: linear-gradient(to bottom, rgba(255, 255, 255, 0) -2%, rgba(255, 255, 255, 0) 10%, rgba(255, 255, 255, 0.4) 90%);
}

.ossn-startup-wrapper #ossn-home-signup a {
	color: #fff;
	font-weight: bold;
}

.ossn-startup-wrapper #ossn-home-signup .ossn-red-borders {
	border: 2px solid #ff4d4d !important;
}

#ossn-home-signup .ossn-required {
	color: rgb(255 143 142);
}

#ossn-submit-button {
	width: 100%;
	padding: 15px;
	border-radius: 10px;

	/* White Background Style */
	background: #ffffff;
	color: #0b769c;
	/* Text matches the border */

	font-weight: 700;
	/* Slightly heavier weight for white buttons */
	letter-spacing: 0.5px;
	margin-top: 20px;
	cursor: pointer;
	transition: all 0.3s ease;

	/* Subtle shadow to prevent it from blending into the glass */
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
	border-color: transparent;
}

/* Hover State: Inverts the colors for a high-end feel */
#ossn-submit-button:hover {
	background: #e7e7e7;
	color: #000;
	box-shadow: 0 6px 15px rgba(102, 126, 234, 0.3);
	transform: translateY(-1px);
}

/* Active State: Click effect */
#ossn-submit-button:active {
	transform: translateY(0);
}

.ossn-login input[type="submit"] {
	width: 100%;
	margin-bottom: 10px;
	display: block;
	padding: 15px;
	border-radius: 10px;
	font-weight: 700;
	letter-spacing: 0.5px;
	margin-top: 20px;
	cursor: pointer;
	transition: all 0.3s ease;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
	border-color: transparent;
}

.ossn-login .glass-signup-card:before {
	display: none;
}

.ossn-login {
	color: #fff;
}

/* The Floating Icon Badge */
.ossn-login .login-icon-badge {
	background: linear-gradient(135deg, #0b769c 0%, #085e7d 100%);
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	width: 70px;
	height: 70px;
	background: #0b769c;
	color: #fff;
	font-size: 24px;
	box-shadow: 0 8px 20px rgba(11, 118, 156, 0.2);
	border: 4px solid #fff;
	margin: 0 auto;
}

.ossn-login .ossn-startup-wrapper .glass-signup-card .login-card-custom,
.ossn-login .login-card-custom {
	color: #000 !important;
}

.ossn-login .login-card-custom:before {
	display: none;
}

/* Add a subtle animation to the icon */
.ossn-login .login-icon-badge i {
	animation: pulse-soft 3s infinite;
}

@keyframes pulse-soft {
	0% {
		transform: scale(1);
	}

	50% {
		transform: scale(1.05);
	}

	100% {
		transform: scale(1);
	}
}


/* Title Decoration */
.ossn-login .header-line {
	width: 40px;
	height: 4px;
	background: #0b769c;
	margin: 8px auto;
	border-radius: 10px;
}

/* Links Styling */
.ossn-login .forgot-link {
	color: #0b769c;
	text-decoration: none;
	transition: color 0.2s;
}

.ossn-login .forgot-link:hover {
	color: #0b769c;
}

.ossn-login .signup-link-text {
	color: #0b769c;
	font-weight: 700;
	text-decoration: none;
	margin-left: 5px;
}

/* Styling the custom button */
.ossn-topbar-login-btn {
	/* Position it to the right */
	float: right;
	margin-top: 5px;

	/* Modern Glass Style */
	background: rgba(255, 255, 255, 0.15) !important;
	backdrop-filter: blur(5px);
	-webkit-backdrop-filter: blur(5px);
	border: 1px solid rgba(255, 255, 255, 0.3) !important;
	color: #ffffff !important;

	/* Shape & Typography */
	padding: 6px 20px !important;
	border-radius: 8px !important;
	font-weight: 600 !important;
	font-size: 14px;
	transition: all 0.3s ease-in-out !important;
	margin: 10px;
}

/* Hover effect: Smooth transition to solid white */
.ossn-topbar-login-btn:hover {
	background: #ffffff !important;
	color: #0b769c !important;
	/* Brand blue from your topbar */
	transform: translateY(-1px);
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Active/Click effect */
.ossn-topbar-login-btn:active {
	transform: translateY(0);
}

/* Tier 1: Tablets and Phones (Standard stacking) */
@media (max-width: 768px) {
	.custom-row {
		display: block !important;
	}

	.custom-col {
		width: 100% !important;
		display: block;
		margin-bottom: 2px;
	}
}

/* Tier 2: Extra Small Devices (XS - 480px and below) */
@media (max-width: 480px) {

	/* Reduce card padding so the inputs have more room to breathe */
	.glass-signup-card {
		padding: 20px 15px !important;
	}
}

/******************************
	Output/users
*****************************/
/* Scoped Container for User Cards */
.ossn-output-users-list .user-item-card {
	background: rgba(255, 255, 255, 0.04);
	border: 1px solid rgba(255, 255, 255, 0.1);
	border-radius: 16px;
	margin-bottom: 15px;
	padding: 15px;
	transition: all 0.3s ease;
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.ossn-output-users-list .user-item-inner {
	display: flex;
	justify-content: space-between;
	align-items: center;
	flex-wrap: wrap;
	gap: 15px;
}

/* Avatar Styling */
.ossn-output-users-list .user-avatar-container img {
	width: 65px;
	height: 65px;
	border-radius: 12px;
	object-fit: cover;
	border: 1px solid rgba(255, 255, 255, 0.15);
}

/* Grouping Name and Avatar */
.ossn-output-users-list .user-info-box {
	display: flex;
	align-items: center;
	gap: 15px;
}

.ossn-output-users-list .user-name-text {
	font-weight: 700;
	font-size: 16px;
}

.ossn-output-users-list .user-username-sub {
	font-size: 12px;
	margin-top: 2px;
}

/* Control Buttons */
.ossn-output-users-list .ossn-action-btn {
	display: inline-flex;
	align-items: center;
	gap: 8px;
	padding: 8px 18px;
	border-radius: 10px;
	font-size: 13px;
	font-weight: 600;
	text-decoration: none !important;
	white-space: nowrap;
	transition: all 0.2s ease;
}

/* Primary Button (Add Friend) */
.ossn-output-users-list .btn-primary-outline {
	background: rgba(11, 118, 156, 0.1);
	color: #3fb1d9 !important;
	border: 1px solid rgba(11, 118, 156, 0.4);
}

.ossn-output-users-list .btn-primary-outline:hover {
	background: #0b769c;
	color: #fff !important;
	border-color: #0b769c;
}

/* Danger Button (Remove/Cancel) */
.ossn-output-users-list .btn-danger-outline {
	background: rgba(239, 68, 68, 0.1);
	color: #ef4444 !important;
	border: 1px solid rgba(239, 68, 68, 0.3);
}

.ossn-output-users-list .btn-danger-outline:hover {
	background: #ef4444;
	color: #fff !important;
}

/* Small Device Adjustments */
@media (max-width: 480px) {
	.ossn-output-users-list .user-item-inner {
		justify-content: center;
		text-align: center;
	}

	.ossn-output-users-list .user-info-box {
		flex-direction: column;
		width: 100%;
	}

	.ossn-output-users-list .user-controls-box {
		width: 100%;
	}

	.ossn-output-users-list .ossn-action-btn {
		width: 100%;
		justify-content: center;
	}
}