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

?>
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
*/

body {
	font-family: 'Roboto Slab', serif;
	font-size: 14px;
	background: #fdfdfd;
}

.logo {}

i {
	margin-right: 5px;
}

#ossn-check-all {
	position: absolute;
	top: 8px;
}

#ossn-check-all,
.ossn-admin-unvalidated-users-check {
	width: 25px;
	height: 25px;
	margin-top: 5px;
	cursor: pointer;
}

.header {
	height: 70px;
	color: #fff;
	background: #3D3D3D;
}

.header .container {
	padding-top: 15px;
}

.header-dropdown {
	text-align: right;
}

.header-dropdown .navbar-right {
	margin-right: initial;
}

.header-dropdown a i {
	color: #fff;
	font-size: 30px;
	padding-top: 5px;
}

.ossn-admin-pg-content,
form {
	background: #ffffff;
	/* Increase padding for better whitespace */
	padding: 10px;
	/* Use a very soft border or none at all if using shadow */
	border: 1px solid rgba(0, 0, 0, 0.05);
	/* Larger, smoother border radius */
	border-radius: 10px;
	/* Add a "floating" depth effect */
	box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04),
		0 8px 10px -6px rgba(0, 0, 0, 0.04);
	/* Smooth entrance if loaded dynamically */
	transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.ossn-admin-pg-content:hover,
form:hover {
	/* Subtle lift effect on hover */
	box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.06);
}

.btn {
	border-radius: 3px;
}

a {
	color: #337ab7;
	text-decoration: none;
}

input[type='number'],
input[type='email'],
select,
input[type="password"],
input[type="text"],
textarea {
	color: #333;
	font-size: 13px;
	border: 1px solid #eee;
	background: #f9f9f9;
	border-radius: 5px;
	display: block;
	-moz-border-radius: 2px;
	-o-border-radius: 2px;
	outline: none;
	padding: 12px 14px;
	width: 100%;
	margin-bottom: 10px;
	transition: all 0.4s ease-in-out;
	-moz-transition: all 0.4s ease-in-out;
	-webkit-transition: all 0.4s ease-in-out;
	-o-transition: all 0.4s ease-in-out;
}

input[type="search"]:focus,
input[type="text"]:focus,
textarea:focus {
	border-color: #ddd;
	box-shadow: 0 0 3px #eee;
	-o-box-shadow: 0 0 3px #eee;
	-moz-box-shadow: 0 0 3px #eee;
	-webkit-box-shadow: 0 0 3px #eee;
}

.btn:focus,
.btn:active {
	outline: none !important;
}

input[type="submit"] {
	display: inherit;
}

label {
	font-weight: bold;
	color: #333;
	cursor: pointer;
	display: block;
	margin-bottom: 2px;
}

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

.ossn-system-messages {
	margin-top: 10px;
}

.alert {
	margin-bottom: 10px;
}

.topbar-menu li a i {
	margin-left: 5px;
	float: right;
}

.page-title {
	background-color: #f5f5f5;
	border: 1px solid #ddd;
	padding: 10px;
	font-weight: 700;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	text-transform: uppercase;
	margin-bottom: 10px;
}

.page-botton-notice {
	margin-top: 10px;
}

.no-right-margins {
	margin-right: 0px;
}

.ossn-form div:not('.ossn-editor') {
	margin-top: 10px;
}

.margin-top-10 {
	margin-top: 10px;
}

.margin-bottom-10 {
	margin-bottom: 10px;
}

.right {
	float: right;
}

.left {
	float: left;
}

.text-right {
	text-align: right;
}

.ossn-users-list .image {
	margin-top: 1px;
}

.ossn-users-list .name {
	margin-left: 42px;
	margin-top: 2px;
	min-height: 30px;
	max-width: 160px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}

.table-titles {
	background: #f8f8f8;
}

.block {
	display: block;
}

.inline-block {
	display: inline-block;
}


footer {
	margin-top: 20px;
	border-top: 1px solid #E5E5E5;
	padding-bottom: 20px;
	padding: 10px;
}

footer a {
	text-transform: uppercase;
}

.charjs-legend {
	text-align: center;
}

.charjs-legend .title {
	display: inline-block;
	margin-bottom: 0.5em;
	line-height: 1.2em;
	margin-left: 10px;
	padding: 0 0.3em;
}

.charjs-legend .color-sample {
	display: block;
	float: left;
	width: 1em;
	height: 1em;
	border: 2px solid;
	border-radius: 0.5em;
	margin-right: 0.5em;
}

.center {
	text-align: center;
}

.text-right {
	text-align: right;
}

.component-title-icon {
	font-size: 20px !important;
}

.component-title-check {
	color: #147B25;
}

.component-title-delete {
	color: #E70F0F;
}

.components-list-buttons a {
	margin-right: 10px;
}

.components-list-buttons a i {
	margin-right: 5px;
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

.ossn-form input[type=radio]:checked::before {
	position: absolute;
	font: 9px/1 'Open Sans', sans-serif;
	left: 7px;
	top: 5px;
	content: '\02143';
	transform: rotate(40deg);
}

.ossn-form input[type=radio]:hover {
	background-color: #f7f7f7;
}

.ossn-form input[type=radio]:checked {
	background-color: #0b769c;
	color: #fff;
	font-weight: bold;
}

.ui-datepicker-year,
.ui-datepicker-month {
	padding: 0px;
	display: inline-block;
}

.admin-dashboard-box-small {
	min-height: 100px;
	background: #fff;
}

.admin-dashboard-contents-small {
	max-height: 100px;
}

.admin-dashboard-contents-small .text {
	padding: 10px;
}

.navbar-default {
	background-color: #585858;
	border-color: #6f6f6f;
	border-radius: 0;
	border: 0;
}

.navbar-default .navbar-nav>li>a {
	color: #fff;
}

.navbar-default .navbar-nav>li>a:focus,
.navbar-default .navbar-nav>li>a:hover {
	color: #f1f1f1;
	background-color: transparent;
}

@media (max-width: 480px) {
	.topbar-menu .nav li {
		padding-left: 15px;
	}
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
	background-color: #000;
	opacity: 0.9;
	cursor: auto;
	height: 100%;
	display: none;
}

.ossn-light {
	opacity: 0.4 !important;
}

.ossn-halt {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	z-index: 10000;
	background-color: #000;
	opacity: 0.9;
	cursor: auto;
	height: 100%;
	display: none;
}

.image-block img {
	max-width: 700px;
}

.ossn-message-box {
	width: 470px;
	min-width: 470px;
	min-height: 96px;
	background: #fff;
	border: 1px solid #999;
	position: fixed;
	top: 0px;
	left: 0px;
	right: 0px;
	margin-left: auto;
	margin-right: auto;
	z-index: 60000;
	margin-top: 100px;
	border-radius: 3px;
	display: none;
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
	border-radius: 3px;
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
	overflow-x: -moz-hidden-unscrollable
}

.ossn-message-box .control {
	margin-left: 10px;
	margin-right: 10px;
	height: 45px;
	padding: 10px;
	border-top: 1px solid #E9EAED;
}

.ossn-message-box .control .controls {
	float: right;
}

.ossn-message-box .control .controls .btn {
	padding: 2px 13px;
	border-radius: 2px;
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
	font-size: 13px;
	margin-right: 13px;
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

#onlineusers-classified-graph,
#users-classified-graph {
	width: 250px;
	height: 140px;
}

.logo-container-goblue {}

.logo-container-goblue img {
	background: #eee;
	border: 1px dashed #333;
	margin: 10px 0;
	padding: 10px;
	max-width: 300px;
}


/*****************
 BS 5
***************/

.card-spacing {
	margin-top: 5px;
}

.card {
	-webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
	box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
}

.card-header a {
	color: inherit;
	font-size: 16px;
}

.card-header {
	color: #333;
	background-color: #f5f5f5;
	border-color: #ddd;
}

.card-body p {
	margin: 0 0 10px;
}

.navbar-toggler {
	color: #fff;
}

.navbar-toggler:focus {
	box-shadow: none;
}

.btn-close {
	background-size: .7em;
}

.img-responsive {
	display: block;
	max-width: 100%;
	height: auto;
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

.dropdown-item.active,
.dropdown-item:active {
	color: initial;
	background-color: #d5d7d9;
}

/**************************
       Menu Icons
***************************/
.admin-topbar-menu-li-viewsite>a:before,
.admin-topbar-menu-li-support>a:before,
.admin-topbar-menu-li-configure>a:before,
.admin-topbar-menu-li-help>a:before,
.admin-topbar-menu-li-home>a:before,
.admin-topbar-smenu-usermanager>a:before,
.admin-topbar-smenu-settings>a:before,
.admin-topbar-smenu-themes>a:before,
.admin-topbar-smenu-components>a:before {
	float: left;
	margin-right: 10px;
	font-family: var(--fa-style-family, "Font Awesome 6 Free");
	font-weight: var(--fa-style, 900);
}

.admin-topbar-menu-li-viewsite>a:before {
	content: "\f109";
}

.admin-topbar-menu-li-support>a:before {
	content: "\f005";
}

.admin-topbar-menu-li-help>a:before {
	content: "\f05a";
}

.admin-topbar-menu-li-configure>a:before {
	content: "\f085";
}

.admin-topbar-menu-li-home>a:before {
	content: "\f0db";
}

.admin-topbar-smenu-usermanager>a:before {
	content: "\f007";
}

.admin-topbar-smenu-settings>a:before {
	content: "\f013";
}

.admin-topbar-smenu-themes>a:before {
	content: "\f5aa";
}

.admin-topbar-smenu-components>a:before {
	content: "\f12e";
}

/**********************
	Page users list
************************/
.ossn-admin-all-users {
	background: #ffffff;
}

.ossn-users-list {
	width: 100%;
	border-collapse: separate;
	border-spacing: 0;
	border: 1px solid #f1f5f9;
	border-radius: 12px;
	overflow: hidden;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
}

.ossn-users-list thead tr,
.ossn-users-list tr.table-titles {
	background: #ffffff;
}

.ossn-users-list th {
	padding: 16px;
	font-size: 0.75rem;
	font-weight: 700;
	text-transform: uppercase;
	color: #94a3b8;
	border-bottom: 2px solid #f3f3f3;
	letter-spacing: 0.05em;
}

.ossn-users-list td {
	padding: 14px 16px;
	vertical-align: middle;
	border-bottom: 1px solid #f3f3f3;
	color: #334155;
	font-size: 0.9rem;
}

/* User Identity Cell */
.ossn-admin-all-users .user-identity {
	display: flex;
	align-items: center;
	gap: 12px;
}

.ossn-admin-all-users .user-avatar-modern {
	width: 40px;
	height: 40px;
	border-radius: 10px;
	/* Slight rounded square for a modern look */
	object-fit: cover;
	background: #f1f5f9;
}

.ossn-admin-all-users .user-info-text .full-name {
	display: block;
	font-weight: 600;
	color: #0f172a;
	line-height: 1.2;
}

.ossn-admin-all-users .user-info-text .user-type-tag {
	font-size: 0.7rem;
	color: #64748b;
	text-transform: capitalize;
}

/* Action Links */
.ossn-admin-all-users .action-link {
	font-weight: 600;
	font-size: 0.85rem;
	text-decoration: none !important;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	transition: all 0.2s;
}

.ossn-admin-all-users .action-edit {
	color: #3b82f6;
}

.ossn-admin-all-users .action-edit:hover {
	color: #2563eb;
}

.ossn-admin-all-users .action-delete {
	color: #ef4444;
}

.ossn-admin-all-users .action-delete:hover {
	color: #dc2626;
}

/* Status Indicators */
.ossn-admin-all-users .ossn-admin-all-users .last-login-text {
	font-size: 0.85rem;
	color: #64748b;
}

.ossn-admin-all-users .login-active {
	display: inline-block;
	width: 8px;
	height: 8px;
	background: #10b981;
	border-radius: 50%;
	margin-right: 5px;
}

/* 3. Action Badges - Clean & Pro */
.ossn-admin-all-users .action-badge {
	font-weight: 600;
	font-size: 0.8rem;
	padding: 6px 12px;
	border-radius: 6px;
	text-decoration: none !important;
	display: inline-flex;
	align-items: center;
	gap: 5px;
}

.ossn-admin-all-users .badge-validate {
	color: #10b981;
	background: #f0fdf4;
}

.ossn-admin-all-users .badge-edit {
	color: #f59e0b;
	background: #fffbeb;
}

.ossn-admin-all-users .badge-delete {
	color: #ef4444;
	background: #fef2f2;
}

.ossn-admin-users-search-actions-header {
	display: flex;
	align-items: center;
	gap: 15px;
	/* Space between Search and Add */
	width: 100%;
}

/* The Search Bar Container */
.ossn-admin-search-pro-line {
	display: flex;
	align-items: center;
	background: #ffffff;
	border: 2px solid #f1f5f9;
	border-radius: 10px;
	padding: 0 6px 0 16px;
	/* Reduced right padding to fit search button */
	flex: 1;
	/* Search takes 100% of available space */
	box-sizing: border-box;
	transition: all 0.2s ease;
	position: relative;
}

.ossn-admin-search-pro-line:focus-within {
	border-color: #ccc;
	box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
}

.ossn-admin-search-pro-line form {
	flex: 1;
	display: flex;
	margin: 0;
}

.ossn-admin-search-pro-line input[type="text"] {
	width: 100%;
	font-size: 0.95rem;
	font-weight: 500;
	color: #1e293b;
	border-radius: 10px;
	padding: 9px 14px;
	margin-top: 10px;
}

.ossn-admin-search-pro-line input[type="text"]:focus {
	outline: none;
}

/* The Actual Search Trigger Button (Inside the bar) */
.ossn-admin-search-pro-line .btn-search-trigger {
	background: #f8fafc;
	border: none;
	padding: 6px 10px;
	border-radius: 6px;
	color: #64748b;
	cursor: pointer;
	transition: background 0.2s;
	position: absolute;
	right: 0;
	margin-right: 10px;
}

.ossn-admin-search-pro-line .btn-search-trigger:hover {
	background: #e2e8f0;
	color: #000;
}

/* High-Contrast Black ADD Button (Standalone) */
.btn-pro-black-add {
	background-color: #000000 !important;
	color: #ffffff !important;
	padding: 12px 24px;
	border-radius: 10px;
	font-weight: 700;
	font-size: 0.9rem;
	text-decoration: none !important;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	white-space: nowrap;
	transition: transform 0.1s ease;
	height: 48px;
	/* Matches the search bar height */
}

.ossn-admin-search-pro-line .btn-pro-black-add:hover {
	background-color: #222222 !important;
	transform: translateY(-1px);
}

/**************
	Pagination
**************/
/* Container Spacing and Alignment */
.container-table-pagination {
	padding: 32px 0;
	display: flex;
	justify-content: center;
	width: 100%;
}

/* Base Pagination Reset */
.ossn-pagination {
	display: flex;
	gap: 6px;
	/* Modern separated button style */
	padding: 0;
	list-style: none;
	margin: 0;
}

/* The Individual Page Links */
.ossn-pagination .page-link {
	display: flex;
	align-items: center;
	justify-content: center;
	min-width: 40px;
	height: 40px;
	border: 1px solid #e2e8f0;
	/* Soft border to match pro-line table */
	background: #ffffff;
	color: #3D3D3D;
	/* Your specific color for text */
	padding: 0 14px;
	font-size: 0.875rem;
	font-weight: 600;
	border-radius: 10px !important;
	/* Matches your user avatar radius */
	text-decoration: none !important;
	transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Hover State */
.ossn-pagination .page-link:hover {
	background-color: #f8fafc;
	color: #000000;
	border-color: #3D3D3D;
	transform: translateY(-1px);
}

/* Active Page State - Using your #3D3D3D */
.ossn-pagination .page-item.active .page-link {
	background-color: #3D3D3D !important;
	/* Your specific brand color */
	border-color: #3D3D3D !important;
	color: #ffffff !important;
	font-weight: 700;
	box-shadow: 0 4px 12px rgba(61, 61, 61, 0.25);
	/* Thematic shadow */
}

/* "First" and "Last" specific styling */
.ossn-pagination .page-item:first-child .page-link,
.ossn-pagination .page-item:last-child .page-link {
	text-transform: uppercase;
	font-size: 0.7rem;
	letter-spacing: 0.05em;
	background: #fdfdfd;
}

/* Disabled State */
.ossn-pagination .page-item.disabled .page-link {
	color: #cbd5e1;
	pointer-events: none;
	background-color: #fcfcfc;
	border-color: #f1f5f9;
}

/*********************
	Dashbaord
**********************/
/** 1. The Power Row (8/4 Split) **/
.ossn-admin-dashboard .main-analytics-row {
	margin-bottom: 30px;
}

.ossn-admin-dashboard .graph-card-main {
	background: #ffffff;
	border: 1px solid #f1f5f9;
	border-radius: 20px;
	padding: 25px;
	min-height: 400px;
	box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
}

/** 2. Pie Stack **/
.ossn-admin-dashboard .pie-mini-card {
	background: #ffffff;
	border: 1px solid #f1f5f9;
	border-radius: 20px;
	padding: 20px;
	flex: 1;
	display: flex;
	flex-direction: column;
	margin-bottom: 20px;
}

/** 3. Typography Hierarchy **/
.ossn-admin-dashboard .admin-dashboard-title {
	font-size: 0.85rem;
	font-weight: 600;
	text-transform: uppercase;
	color: #87909e;
	/* Soft Slate */
	letter-spacing: 0.05em;
}

.ossn-admin-dashboard .card-value {
	font-size: 2rem;
	font-weight: 800;
	color: #87909e;
	line-height: 1.1;
}

/** 4. Metric Cards (Universal Size) **/
.ossn-admin-dashboard .metric-card {
	background: #ffffff;
	border: 1px solid #f1f5f9;
	border-radius: 18px;
	padding: 20px;
	display: flex;
	align-items: center;
	gap: 15px;
	height: 110px;
	margin-bottom: 24px;
}

/** 5. Compact Action Card (Flush Cache) **/
.ossn-admin-dashboard .cache-action-card {
	background: #ffffff;
	border: 1px solid #f1f5f9;
	border-radius: 18px;
	padding: 15px;
	height: 110px;
	display: flex;
	flex-direction: column;
	justify-content: center;
	text-align: center;
	margin-bottom: 24px;
}

.ossn-admin-dashboard .btn-flush-dark {
	background: #1e293b !important;
	/* Deep Dark Slate */
	color: #ffffff !important;
	border: none;
	padding: 10px 0;
	margin-top: 8px;
	border-radius: 12px;
	font-weight: 700;
	font-size: 0.8rem;
	text-transform: uppercase;
	letter-spacing: 1px;
	transition: all 0.3s ease;
	width: 100%;
	display: block;
	text-align: center;
	text-decoration: none !important;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
}

.ossn-admin-dashboard .btn-flush-dark:hover {
	background: #334155 !important;
	/* Slightly lighter on hover */
	transform: translateY(-2px);
	box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
	color: #ffffff !important;
}

/** Icons **/
.ossn-admin-dashboard .icon-wrap {
	width: 54px;
	height: 54px;
	border-radius: 12px;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 1.5rem;
	color: #fff;
	flex-shrink: 0;
}

/* Gradients */
.ossn-admin-dashboard .bg-blue {
	background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.ossn-admin-dashboard .bg-purple {
	background: linear-gradient(135deg, #a855f7, #7e22ce);
}

.ossn-admin-dashboard .bg-green {
	background: linear-gradient(135deg, #10b981, #059669);
}

.ossn-admin-dashboard .bg-red {
	background: linear-gradient(135deg, #ef4444, #b91c1c);
}

.ossn-admin-dashboard .bg-orange {
	background: linear-gradient(135deg, #f59e0b, #d97706);
}

.ossn-admin-dashboard .bg-indigo {
	background: linear-gradient(135deg, #6366f1, #4338ca);
}

.ossn-admin-dashboard .bg-cyan {
	background: linear-gradient(135deg, #06b6d4, #0891b2);
}

.ossn-admin-dashboard canvas {
	width: 100% !important;
}

/**************************
	Components and themes
**************************/
/* 1. The Main Row Container */
.ossn-com-row {
	background: #ffffff;
	border: 1px solid #f1f5f9;
	border-radius: 14px;
	margin-bottom: 12px;
	transition: all 0.2s ease;
}

.ossn-com-row:hover {
	border-color: #cbd5e1;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
}

/* 2. Header Content */
.ossn-com-row .com-row-header {
	padding: 16px 20px;
	display: flex;
	align-items: center;
	justify-content: space-between;
	cursor: pointer;
}

.ossn-com-row .com-ui-info {
	display: flex;
	align-items: center;
	gap: 15px;
	flex: 1;
}

/* Status Dot */
.ossn-com-row .status-dot {
	width: 10px;
	height: 10px;
	border-radius: 50%;
	flex-shrink: 0;
}

.ossn-com-row .dot-active {
	background: #10b981;
	box-shadow: 0 0 8px rgba(16, 185, 129, 0.4);
}

.ossn-com-row .dot-inactive {
	background: #ef4444;
	box-shadow: 0 0 8px rgba(239, 68, 68, 0.4);
}

.ossn-com-row .com-ui-name {
	font-weight: 700;
	font-size: 0.95rem;
	color: #1e293b;
	margin: 0;
}

.ossn-com-row .com-ui-version {
	font-size: 11px;
	font-weight: 800;
	color: #94a3b8;
	background: #f8fafc;
	padding: 2px 8px;
	border-radius: 6px;
	text-transform: uppercase;
}

/* 3. Collapsed Content */
.ossn-com-row .com-row-details {
	padding: 0 20px 20px 45px;
	border-top: 1px solid #f8fafc;
}

.ossn-com-row .com-description-text {
	font-size: 13px;
	color: #64748b;
	line-height: 1.5;
	margin: 15px 0;
}

/* Meta Tiles */
.ossn-com-row .com-meta-tiles {
	display: flex;
	flex-wrap: wrap;
	gap: 20px;
	margin-bottom: 10px;
}

.ossn-com-row .meta-tile {
	display: flex;
	flex-direction: column;
}

.ossn-com-row .meta-tile label {
	font-size: 10px !important;
	color: #94a3b8 !important;
	font-weight: 700 !important;
	margin-bottom: 2px !important;
}

.ossn-com-row .meta-tile span,
.ossn-com-row .meta-tile a {
	font-size: 13px;
	font-weight: 600;
	color: #334155;
	text-decoration: none;
}

/* 4. Buttons */
.ossn-com-row .com-action-area {
	display: flex;
	gap: 8px;
	margin-top: 15px;
}

.ossn-com-row .com-action-area .btn {
	border-radius: 8px;
	font-size: 12px;
	font-weight: 700;
	padding: 8px 14px;
	border: none;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}

.ossn-com-row .btn-success-modern {
	background: #10b981;
	color: #fff;
}

.ossn-com-row .btn-warning-modern {
	background: #f59e0b;
	color: #fff;
}

.ossn-com-row .btn-danger-modern {
	background: #ef4444;
	color: #fff;
}

.ossn-com-row .com-badge-req {
	font-size: 12px !important;
	display: inline-flex !important;
	align-items: center;
	justify-content: center;
	padding: 5px 10px !important;
	line-height: 1.2;
	font-weight: 600;
	border-radius: 8px !important;
	letter-spacing: 0.3px;
	border: none;
}

/* Thumbnails + Preview */
.ossn-com-row .com-ui-preview-thumb,
.ossn-com-row .com-full-preview {
	cursor: zoom-in;
	transition: transform 0.2s ease, filter 0.2s ease;
}

.ossn-com-row .com-ui-preview-thumb {
	width: 44px;
	height: 44px;
	border-radius: 10px;
	object-fit: cover;
	background: #f1f5f9;
	border: 1px solid #e2e8f0;
}

.ossn-com-row .com-full-preview {
	width: 100%;
	max-width: 400px;
	border-radius: 14px;
	margin-bottom: 20px;
	border: 1px solid #f1f5f9;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.ossn-com-row .com-ui-preview-thumb:hover,
.ossn-com-row .com-full-preview:hover {
	filter: brightness(0.9);
	transform: scale(1.02);
}

/* Layout */
.ossn-com-row .com-details-wrapper {
	display: flex;
	gap: 25px;
	flex-wrap: wrap;
}

.ossn-com-row .com-details-text-side {
	flex: 1;
	min-width: 250px;
}

/* Lightbox (ID kept global intentionally) */
#ossn-com-lightbox {
	display: none;
	position: fixed;
	z-index: 9999;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(15, 23, 42, 0.9);
	backdrop-filter: blur(8px);
	align-items: center;
	justify-content: center;
	cursor: zoom-out;
}

#ossn-com-lightbox img {
	max-width: 90%;
	max-height: 90%;
	border-radius: 12px;
	box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}