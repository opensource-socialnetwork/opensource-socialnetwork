/******************************
	Basic <style>
**********************************/
:root {
    --layout-sidebar-width: 240px;
    --fa-style-family: "Font Awesome 7 Free", "Font Awesome 6 Free",
        "FontAwesome";
}
:root {
    --fb-font-family: "Segoe UI Historic", "Segoe UI", "Open Sans",
        -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
    --fb-blue: #0866ff;
    --fb-brand-blue: #1877f2;
    --fb-bg-header: #ffffff;
    --fb-icon-bg: #e4e6eb;
    --fb-icon-bg-hover: #d8dadf;
    --fb-icon-color: #050505;
    --fb-text-primary: #050505;
    --fb-text-secondary: #65676b;
    --fb-border: #ced0d4;
    --fb-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.2),
        0 2px 4px 0 rgba(0, 0, 0, 0.1);
}

@import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap");

body {
    font-size: 15px;
    background-color: #f2f4f7;
    font-family: "Segoe UI Historic", "Segoe UI", "Open Sans", -apple-system,
        BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;
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

.ossn-form input[type="number"],
.ossn-form input[type="email"],
.ossn-form input[type="password"],
.ossn-form text,
.ossn-form select,
.ossn-form textarea,
.ossn-form input[type="text"] {
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

.ossn-form input[type="number"]:focus,
.ossn-form input[type="email"]:focus,
.ossn-form input[type="password"]:focus,
.ossn-form text:focus,
.ossn-form select:focus,
.ossn-form textarea:focus,
.ossn-form input[type="text"]:focus {
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

[contentEditable="true"]:empty:not(:focus)::before {
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

.ossn-form input[type="submit"] {
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
    color: var(--fb-blue);
    -webkit-appearance: none;
    background: none;
    border: 0;
    outline: 0;
    flex-grow: 0;
    background-color: #ffffff;
    transition: background 300ms;
    cursor: pointer;
    float: left;
    margin-top: 2px;
}

.checkbox-block [type="checkbox"]::before {
    content: "";
    color: transparent;
    display: block;
    width: inherit;
    height: inherit;
    border-radius: inherit;
    border: 0;
    background-color: transparent;
    background-size: contain;
    box-shadow: inset 0 0 0 1px #ccd3d8;
}

.checkbox-block [type="checkbox"]:checked {
    background-color: currentcolor;
}

.checkbox-block [type="checkbox"]:checked::before {
    box-shadow: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}

.checkbox-block [type="checkbox"]:disabled {
    background-color: #ccd3d8;
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
/** didn't we have a minimum page height in fbui? #702 **/

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
    background: url("<?php echo ossn_add_cache_to_url(ossn_theme_url('images/background.jpg'));?>")
        no-repeat;
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

.ossn-layout-newsfeed .newsfeed-right {
}

.ossn-page-container {
    min-height: 400px;
}

/* 1. Base Card Container */
.ossn-layout-module {
    background: #ffffff !important;
    border: none !important;
    border-radius: 8px !important;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
    margin-top: 12px !important;
    margin-bottom: 16px !important;
    overflow: hidden !important;
}

/* 2. Title Header Bar */
.ossn-layout-module .module-title {
    background: #ffffff !important;
    border: none !important;
    border-bottom: 1px solid #e4e6eb !important; /* Subtle FB separator line */
    padding: 14px 16px !important;
    border-top-right-radius: 8px !important;
    border-top-left-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
}

/* Title Text */
.ossn-layout-module .module-title .title {
    font-weight: 700 !important;
    font-size: 17px !important;
    color: #050505 !important;
    display: inline-block !important;
}

/* Header Action Controls (Buttons/Icons on Top Right) */
.ossn-layout-module .controls {
    float: none !important; /* Modern flex alignment replaces float */
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
}

/* 3. Module Body Contents */
.ossn-layout-module .module-contents {
    background: #ffffff !important;
    padding: 16px !important;
    color: #050505 !important;
    font-size: 14px !important;
    border-bottom-left-radius: 8px !important;
    border-bottom-right-radius: 8px !important;
}

/* 4. Optional Controls Links & Buttons */
.ossn-layout-module .controls a,
.ossn-layout-module .controls .btn {
    font-size: 13px !important;
    font-weight: 600 !important;
    padding: 6px 12px !important;
    border-radius: 6px !important;
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

@media (min-width: 992px) {
    .newsfeed-col-wall {
        flex: 0 0 62.5%;
        max-width: 62.5%;
    }
    .newsfeed-col-sidebar {
        flex: 0 0 37.5%;
        max-width: 37.5%;
    }
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

/********************************
	Global
***********************************/

.time-created {
    font-size: 14px;
    font-style: italic;
    color: #999;
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

.dropdown-submenu > .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover > .dropdown-menu {
    display: block;
}

.dropdown-submenu > a:after {
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

.dropdown-submenu:hover > a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left > .dropdown-menu {
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

/* 1. Base Container Box */
.ossn-widget {
    background: #ffffff;
    border: none;
    border-radius: 8px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    padding: 0;
    margin-bottom: 16px;
    overflow: hidden;
}

/* 2. Widget Header Title */
.ossn-widget .widget-heading {
    background: #ffffff;
    border: none;
    padding: 16px 16px 4px 16px;
    font-size: 18px;
    font-weight: 700;
    color: #050505;
    border-radius: 0;
    align-items: center;
    justify-content: space-between;
}

/* 3. Widget Body Contents */
.ossn-widget .widget-contents {
    background: #ffffff;
    padding: 12px 16px 16px 16px;
    border: none;
    border-radius: 0;
    color: #050505;
    font-size: 14px;
}

/* 4. Smooth Links Inside Widgets */

/* 5. Clean Divider Lines inside Widgets (if any) */
.ossn-widget hr,
.ossn-widget .widget-contents hr {
    border: 0;
    border-top: 1px solid #e4e6eb;
    margin: 12px 0;
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
    background: #f9f9f9;
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
    font-family: "Font Awesome 5 Free";
    content: "\f007";
    font-weight: 900;
    padding-right: 10px;
    vertical-align: middle;
    float: left;
}

.ossn-menu-search-groups .text:before {
    font-family: "Font Awesome 5 Free";
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
    border-color: var(--fb-blue) !important;
    /* Your brand blue */
    box-shadow: 0 0 0 3px rgba(11, 118, 156, 0.2);
}

/* Placeholder Color */
.ossn-search input[type="text"]::placeholder {
    color: #64748b;
    opacity: 1;
}

/* Search Result Menu Container Styling */
.ossn-menu-search {
    background: #ffffff;
    border-radius: 8px;
    padding: 8px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

/* Result Type Header */
.ossn-menu-search .title {
    font-size: 13px;
    font-weight: 600;
    color: #65676b;
    padding: 8px 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* List Items Layout */
.ossn-menu-search li {
    list-style: none;
    margin: 2px 0;
    border-radius: 6px;
    transition: background-color 0.2s ease;
}

.ossn-menu-search li:hover {
    background-color: #f2f3f5;
}

/* Active Item State */
.ossn-menu-search li.ossn-search-active-item {
    background-color: #e7f3ff;
}
.ossn-menu-search li.ossn-search-active-item a .text {
    color: #1877f2;
    font-weight: 600;
}

/* Links & Text Alignment */
.ossn-menu-search li a {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    text-decoration: none;
    color: #050505;
    font-size: 15px;
    font-weight: 500;
}

.ossn-menu-search li a .text {
    display: flex;
    align-items: center;
    width: 100%;
}

/* Font Awesome Icons for Search Types */
.ossn-menu-search li .text:before {
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    padding-right: 12px;
    font-size: 16px;
    width: 24px;
    text-align: center;
    color: #65676b;
}

/* 1. People Icon */
.ossn-menu-search-users .text:before {
    content: "\f007"; /* User icon */
}

/* 2. Groups Icon */
.ossn-menu-search-groups .text:before {
    content: "\f0c0"; /* Users group icon */
}

/* 3. Business Page Icon */
.ossn-menu-search-bpage .text:before {
    content: "\f024"; /* Flag/Page icon */
}

/* Highlight active item icon color */
.ossn-menu-search li.ossn-search-active-item .text:before {
    color: #1877f2;
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
    color: #2b5470;
    border-top: 1px dashed #eee;
    border-right: 1px solid #eee;
    border-left: 1px solid #eee;
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
    color: #2b5470;
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
    background-color: #f9f9f9;
    border: 1px solid #eee;
    color: #2b5470;
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
    background-color: #f9f9f9;
    color: #2b5470;
    font-weight: bold;
}

/*************************************
	0ssn modal box
***************************************/

.ossn-halt {
    position: fixed; /* Locks backdrop across current viewport */
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 65000; /* Floats on top of wall modal overlay (5000) */
    background-color: rgba(
        0,
        0,
        0,
        0.4
    ); /* Modern soft Facebook dark backdrop */
    backdrop-filter: blur(2px);
    display: none;
}

.ossn-light {
}

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
.toast-container {
    z-index: 50001;
}
.ossn-message-box {
    position: fixed !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(
        -50%,
        -50%
    ) !important; /* Perfect vertical & horizontal centering */
    margin: 0 !important; /* Clears native top margins */
    width: 500px !important;
    max-width: 90vw !important;
    background: #ffffff !important;
    border-radius: 12px !important;
    border: none !important;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25), 0 2px 4px rgba(0, 0, 0, 0.1) !important;
    z-index: 70000 !important; /* Floats above .ossn-halt (65000) & wall modal (5000) */
    overflow: hidden !important;
    font-family: inherit !important;
}

/* Header Bar */
.ossn-message-box .title {
    background: #ffffff;
    padding: 16px 20px;
    border-bottom: 1px solid #e4e6eb;
    color: #050505;
    font-size: 20px;
    font-weight: 700;
    text-align: center;
    position: relative;
    border-radius: 12px 12px 0 0;
}

.ossn-message-box .close-box {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background-color: transparent;
    transition: background-color 0.2s ease;
    cursor: pointer;
    font-size: 0;
    float: right;
}

.ossn-message-box .close-box:hover {
    background-color: #f0f2f5;
}

.ossn-message-box .close-box::before {
    font-family: "Font Awesome 6 Free", "Font Awesome 5 Free";
    font-weight: 900;
    content: "\f00d";
    font-size: 16px;
    color: #65676b;
}

.ossn-message-box .close-box:hover::before {
    color: #050505;
}

/* Form Body */
.ossn-message-box .contents {
    padding: 16px 20px !important;
    min-height: auto !important;
    max-height: 70vh !important;
    background: #ffffff !important;
}

.ossn-message-box .contents p {
    font-size: 15px !important;
    color: #65676b !important;
    margin-bottom: 16px !important;
}

.ossn-message-box .contents label {
    display: none !important;
}

/* Radio Choice Cards */
/* 1. Container Styling */
.ossn-privacy .radio-block {
    position: relative !important;
    display: block !important;
    padding: 14px 16px 14px 48px !important; /* Make room on the left for our custom radio */
    border-radius: 8px !important;
    margin-bottom: 8px !important;
    cursor: pointer !important;
    background: #ffffff !important;
    border: 1px solid #f0f2f5 !important;
    transition: background 0.15s ease-in-out !important;
}

.ossn-privacy .radio-block:hover {
    background-color: #f9f9f9 !important;
}

/* 2. Hide the messy native radio input completely */
.ossn-privacy .radio-block .ossn-radio-input {
    position: absolute !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* 3. Draw a custom, perfectly aligned radio button using a pseudo-element */
.ossn-privacy .radio-block::before {
    content: "" !important;
    position: absolute !important;
    left: 16px !important;
    top: 16px !important; /* Locks it precisely to the first line's height */
    width: 20px !important;
    height: 20px !important;
    border: 2px solid #ccd0d5 !important;
    border-radius: 50% !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    transition: border-color 0.2s ease, background-color 0.2s ease !important;
}

/* 4. Custom inner dot when the radio is checked */
.ossn-privacy .radio-block::after {
    content: "" !important;
    position: absolute !important;
    left: 22px !important;
    top: 22px !important; /* Centered inside the 20px circle */
    width: 8px !important;
    height: 8px !important;
    background: #ffffff !important;
    border-radius: 50% !important;
    opacity: 0 !important;
    transition: opacity 0.2s ease !important;
}

/* 5. Checked State Styling */
.ossn-privacy .radio-block:has(.ossn-radio-input:checked)::before {
    border-color: #1877f2 !important;
    background-color: #1877f2 !important;
}

.ossn-privacy .radio-block:has(.ossn-radio-input:checked)::after {
    opacity: 1 !important;
}

/* 6. Label Text Styling */
.ossn-privacy .radio-block span {
    display: block !important;
    font-size: 15px !important;
    font-weight: 500 !important;
    color: #050505 !important;
    line-height: 1.4 !important;
    margin: 0 !important;
}
.ossn-privacy .radio-block:hover {
    background: #f0f2f5 !important;
}

/* Control Buttons Footer */
.ossn-message-box .control {
    height: auto !important;
    padding: 12px 16px !important;
    border-top: 1px solid #e4e6eb !important;
    background: #ffffff !important;
    display: flex !important;
    justify-content: flex-end !important;
    border-radius: 0 0 12px 12px !important;
}

.ossn-message-box .control .controls {
    float: none !important;
    display: flex !important;
    gap: 8px !important;
}

.ossn-message-box .control .controls .btn {
    padding: 8px 20px !important;
    border-radius: 6px !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    border: none !important;
    cursor: pointer !important;
    transition: background 0.15s ease-in-out !important;
}

.ossn-message-box .control .controls .btn-primary {
    background-color: #0866ff !important;
    color: #ffffff !important;
}

.ossn-message-box .control .controls .btn-primary:hover {
    background-color: #0052cc !important;
}

.ossn-message-box .control .controls .btn-default {
    background-color: #e4e6eb !important;
    color: #050505 !important;
}

.ossn-message-box .control .controls .btn-default:hover {
    background-color: #d8dadf !important;
}

.ossn-form input[type="checkbox"],
.ossn-form input[type="radio"] {
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

.ossn-form input[type="checkbox"] {
    border-radius: 2px;
}

.ossn-form input[type="checkbox"]:checked::before {
    font: 9px/1 "Open Sans", sans-serif;
    left: 7px;
    top: 5px;
    content: "\02143";
}

.ossn-form input[type="radio"]:checked::before {
    position: absolute;
    font: 9px/1 "Open Sans", sans-serif;
    left: 7px;
    top: 5px;
    content: "\02143";
    transform: rotate(40deg);
}

.ossn-form input[type="checkbox"]:hover,
.ossn-form input[type="radio"]:hover {
    background-color: #f7f7f7;
}

.ossn-form input[type="checkbox"]:checked,
.ossn-form input[type="radio"]:checked {
    background-color: var(--fb-blue);
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
    margin: 15px auto;
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
    -webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #fff;
    -moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #fff;
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #fff;
    border: 1px solid #ccc;
    background: -webkit-gradient(
        linear,
        0 0,
        0 100%,
        from(#f5f6f6),
        to(#e4e4e3)
    );
    background: -moz-linear-gradient(#f5f6f6, #e4e4e3);
    background: -o-linear-gradient(#f5f6f6, #e4e4e3);
    background: linear-gradient(#f5f6f6, #e4e4e3);
    border-radius: 4px;
    text-decoration: none;
}

.button-grey:hover,
.btn-action:hover {
    text-decoration: none;
    background: -webkit-gradient(
        linear,
        0 0,
        0 100%,
        from(#e4e4e3),
        to(#f5f6f6)
    );
    background: -moz-linear-gradient(#e4e4e3, #f5f6f6);
    background: -o-linear-gradient(#e4e4e3, #f5f6f6);
    background: linear-gradient(#e4e4e3, #f5f6f6);
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
    border: 1px solid #e9eaed;
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

footer .container {
}

footer .ossn-footer-menu {
    padding-bottom: 10px;
}

footer .ossn-footer-menu a {
    color: #807d7d;
    font-size: 13px;
}

footer .ossn-footer-menu a:not(:last-child):after {
    content: "|";
    margin-left: 10px;
    margin-right: 10px;
}

.menu-footer-powered {
    float: right;
}
.newsfeed-col-sidebar .menu-footer-powered {
    float: none;
    display: block;
    margin-top: 5px;
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

.home-left-contents {
}

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
    border-bottom: 1px solid #e9eaed;
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

.btn-close {
    background-size: 0.7em;
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

.btn-check:checked + .btn-primary:focus,
.btn-check:active + .btn-primary:focus,
.btn-primary:active:focus,
.btn-primary.active:focus,
.show > .btn-primary.dropdown-toggle:focus {
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
.open > .dropdown-toggle.btn-default {
    color: #333;
    background-color: #e6e6e6;
    border-color: #adadad;
}

.pagination {
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
    box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.1),
        inset 0 0 0 1px rgba(255, 255, 255, 0.5);
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
    background: linear-gradient(
        135deg,
        rgba(102, 126, 234, 0.4) 0%,
        rgba(118, 75, 162, 0.4) 100%
    );
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
    color: var(--fb-blue);
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
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.3) 0%,
        rgba(255, 255, 255, 0) 100%
    );
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

.ossn-startup-wrapper .glass-signup-card:before {
    content: "";
    position: absolute;
    inset: 0;
    background-size: cover;
    z-index: -2;
    background: url("<?php echo ossn_theme_url();?>images/background.jpg")
        no-repeat;
    background-size: cover;
}

.ossn-startup-wrapper .glass-signup-card:after {
    content: "";
    position: absolute;
    inset: 0;
    z-index: -1;
    border-radius: 24px;
    background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0) -2%,
        rgba(255, 255, 255, 0) 10%,
        rgba(255, 255, 255, 0.4) 90%
    );
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
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    background: var(--fb-blue);
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
    background: var(--fb-blue);
    margin: 8px auto;
    border-radius: 10px;
}

/* Links Styling */
.ossn-login .forgot-link {
    text-decoration: none;
    transition: color 0.2s;
}

.ossn-login .signup-link-text {
    color: var(--fb-blue);
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
    color: var(--fb-blue) !important;
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
    background: var(--fb-blue);
    color: #fff !important;
    border-color: var(--fb-blue);
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
.ossn-chat-windows-long {
    display: none !important;
}
.login-icon-badge i {
    margin-right: 0px;
}

.fbui-logo-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.fbui-logo-img {
    width: 40px; /* Adjust width as needed */
    height: 40px; /* Adjust height as needed */
    object-fit: contain;
    border-radius: 50%; /* Optional: if you want it circular like Facebook */
}
.emojii-container {
    z-index: 65001 !important;
}
/********* SIDEBAR.PHP *************/
/*************************************************
	FBUI Fail-Safe Scrollbar (Zero Carets / Facebook Pill)
**************************************************/
.newsfeed-col-left {
    position: relative !important;
    min-height: 100vh !important;
}

.fbui-sidebar-wrapper {
    position: fixed !important;
    top: 56px !important;
    height: calc(100vh - 56px) !important;
    overflow: hidden !important;
    z-index: 99 !important;
}

/* Inner Scrollable Track */
.fbui-static-sidebar {
    height: 100% !important;
    width: calc(
        100% + 17px
    ) !important; /* Offsets native scrollbar & carets out of view */
    overflow-y: scroll !important;
    overflow-x: hidden !important;
    padding-right: 17px !important;
    box-sizing: content-box !important;
    font-family: Segoe UI Historic, -apple-system, BlinkMacSystemFont,
        "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
}

/* Pure Overlay Style For Modern Chrome/Edge/Firefox */
@supports (scrollbar-width: thin) or (-webkit-appearance: none) {
    .fbui-static-sidebar {
        width: 100% !important;
        padding-right: 0 !important;
        box-sizing: border-box !important;
        overflow-y: auto !important;
    }

    /* Force Custom Scrollbar Layout */
    .fbui-static-sidebar::-webkit-scrollbar {
        width: 8px !important;
        display: block !important;
    }

    /* Completely erase buttons & carets */
    .fbui-static-sidebar::-webkit-scrollbar-button,
    .fbui-static-sidebar::-webkit-scrollbar-button:single-button,
    .fbui-static-sidebar::-webkit-scrollbar-button:vertical:decrement,
    .fbui-static-sidebar::-webkit-scrollbar-button:vertical:increment,
    .fbui-static-sidebar::-webkit-scrollbar-button:start,
    .fbui-static-sidebar::-webkit-scrollbar-button:end {
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        background: none !important;
        border: none !important;
    }

    /* Completely erase track background & borders from main CSS */
    .fbui-static-sidebar::-webkit-scrollbar-track,
    .fbui-static-sidebar::-webkit-scrollbar-track-piece {
        background: transparent !important;
        background-color: transparent !important;
        border: none !important;
        border-left: none !important;
        box-shadow: none !important;
    }

    /* Thumb bar hidden by default */
    .fbui-static-sidebar::-webkit-scrollbar-thumb {
        background-color: transparent !important;
        border-radius: 10px !important;
        border: none !important;
        transition: background-color 0.2s ease !important;
    }

    /* Reveal floating pill on sidebar hover */
    .fbui-sidebar-wrapper:hover .fbui-static-sidebar::-webkit-scrollbar-thumb,
    .fbui-static-sidebar:hover::-webkit-scrollbar-thumb {
        background-color: rgba(
            0,
            0,
            0,
            0.18
        ) !important; /* Soft FB Translucent Gray */
    }

    .fbui-static-sidebar::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0, 0, 0, 0.35) !important;
    }
}

/* ===============================================
   SIDEBAR MENU ITEMS & ICONS
   =============================================== */

.fbui-static-sidebar .fbui-sidebar-list {
    list-style: none !important;
    padding: 8px 4px !important;
    margin: 0 !important;
}

.fbui-static-sidebar .fbui-sidebar-list li {
    list-style: none !important;
}

.fbui-static-sidebar .fbui-sidebar-list a {
    display: flex !important;
    align-items: center !important;
    padding: 6px 8px !important;
    min-height: 40px !important;
    border-radius: 8px !important;
    text-decoration: none !important;
    color: #050505 !important;
    transition: background 0.2s ease !important;
    box-sizing: border-box !important;
}

.fbui-static-sidebar .fbui-sidebar-list a:hover {
    background: #e4e6eb !important;
}

.fbui-static-sidebar .fbui-sidebar-list .fbui-sidebar-label {
    font-size: 15px !important;
    font-weight: 600 !important;
    color: #050505 !important;
    line-height: 1.2 !important;
}

.fbui-static-sidebar .fbui-sidebar-list .fbui-sidebar-avatar,
.fbui-static-sidebar .fbui-sidebar-list .fbui-sidebar-avatar img {
    width: 36px !important;
    height: 36px !important;
    min-width: 36px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
    margin-right: 12px !important;
}

.fbui-static-sidebar .fbui-sidebar-list .fbui-sidebar-icon {
    width: 36px !important;
    height: 36px !important;
    min-width: 36px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin-right: 12px !important;
    overflow: visible !important;
}

.fbui-static-sidebar .fbui-sidebar-list .fbui-sidebar-icon i {
    font-size: 24px !important;
    line-height: 1 !important;
    width: auto !important;
    height: auto !important;
    display: inline-block !important;
    transform: scale(1.05) !important;
    background-clip: text !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
}

/* Gradients */

.fbui-static-sidebar .fbui-sidebar-list .icon-photos i {
    background: linear-gradient(135deg, #f59e0b 0%, #ec4899 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-meta-ai i {
    background: linear-gradient(135deg, #a855f7 0%, #6366f1 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-friends i {
    background: linear-gradient(135deg, #18acfe 0%, #0163e0 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-watch i {
    background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-groups i {
    background: linear-gradient(135deg, #00c6ff 0%, #0052cc 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-pages i {
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-events i {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-marketplace i {
    background: linear-gradient(135deg, #06b6d4 0%, #2563eb 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-saved i {
    background: linear-gradient(135deg, #f35369 0%, #a238ff 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-memories i {
    background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-blogs i {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-polls i {
    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-mp3 i {
    background: linear-gradient(135deg, #ff5e62 0%, #ff9966 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-members i {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-games i {
    background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-adsmanager i {
    background: linear-gradient(135deg, #64748b 0%, #2563eb 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-messenger i {
    background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%) !important;
    -webkit-background-clip: text !important;
}
.fbui-static-sidebar .fbui-sidebar-list .icon-newsfeed i {
    background: linear-gradient(135deg, #1877f2 0%, #0052c2 100%) !important;
    -webkit-background-clip: text !important;
}
/* See More Circle */
.fbui-static-sidebar .fbui-sidebar-list .icon-see-more {
    width: 36px !important;
    height: 36px !important;
    background: #e4e6eb !important;
    border-radius: 50% !important;
}

.fbui-static-sidebar .fbui-sidebar-list .icon-see-more i {
    font-size: 14px !important;
    transform: none !important;
    color: #050505 !important;
    -webkit-text-fill-color: #050505 !important;
    background: none !important;
}
/* Sidebar Collapsible Containers */
.fbui-links-collapsible,
.fbui-shortcuts-collapsible {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
}
.fbui-links-collapsible.expanded,
.fbui-shortcuts-collapsible.expanded {
    max-height: 1500px;
}

/* Shortcuts Font Size & Layout Styling */
.fbui-sidebar-list .fbui-shortcut-item .fbui-sidebar-label {
    font-size: 15px !important;
    font-weight: 500;
}
.fbui-shortcut-item {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.fbui-shortcut-item a {
    flex: 1;
    display: flex;
    align-items: center;
    overflow: hidden;
}
.fbui-shortcut-cover {
    border-radius: 8px;
    background-size: cover;
    background-position: center;
}
.fbui-shortcut-delete {
    display: none;
    position: absolute;
    right: 12px;
    width: 32px;
    height: 32px;
    background-color: transparent;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #65676b;
    transition: background-color 0.2s ease, color 0.2s ease;
}
.fbui-shortcut-item:hover .fbui-shortcut-delete {
    display: flex;
}
.fbui-shortcut-delete:hover {
    background-color: rgba(0, 0, 0, 0.08);
    color: #e41e3f;
}
.fbui-sidebar-divider {
    border-top: 1px solid #e4e6eb;
    margin: 8px 12px;
}
/* Divider before Your Shortcuts */
.fbui-shortcuts-divider {
    border-top: 2px solid #b8b9ba !important;
    margin: 0.5rem 0;
}

/* Shortcut Header Styling */
.fbui-sidebar-header span {
    font-size: 13px;
    font-weight: 600;
    color: #65676b;
    padding: 4px 16px 8px 5px;
    display: block;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Increased Font Size for Shortcut Items */
.fbui-sidebar-list .fbui-shortcut-item .fbui-sidebar-label {
    font-size: 16px !important;
    font-weight: 500;
    color: #050505;
}
/******** SIDEBAR.PHP END*************/
/*********** TOOBAR.PHP **********/
/* Facebook-style Top Loading Bar */
#fbui-ajax-loader {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    background: #1877f2; /* FB Blue */
    z-index: 99999;
    width: 0;
    display: none;
    transition: width 0.3s ease;
}
/*******************************
	FBUI Topbar Full Stylesheet
********************************/
.ossn-layout-contents,
.ossn-layout-media,
.ossn-layout-module,
.ossn-layout-newsfeed {
    margin-top: 65px;
}

/* 1. Base Header Setup */
.topbar {
    font-family: var(--fb-font-family);
    background: #ffffff;
    color: var(--fb-text-primary);
    height: 56px;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1051;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid var(--fb-border);
    padding: 0 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-sizing: border-box;
}

/* 2. Left Section (Logos & Search Bar) */
.fbui-topbar-left {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Desktop Circle 'f' Logo */
.fbui-logo-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    background: linear-gradient(135deg, #1877f2 0%, #0866ff 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    overflow: hidden;
    position: relative;
    padding: 0;
    margin: 0;
    box-shadow: none;
    border: none;
}

.fbui-logo-icon span {
    color: #ffffff;
    background: transparent;
    border: none;
    border-radius: 0;
    box-shadow: none;
    padding: 0;
    margin: 0;
    font-family: "Segoe UI Black", "Arial Black", -apple-system,
        BlinkMacSystemFont, sans-serif;
    font-size: 26px;
    font-weight: 900;
    line-height: 1;
    text-transform: lowercase;
    display: inline-block;
    user-select: none;
}

.fbui-logo-icon:hover {
    opacity: 0.95;
}

/* Mobile Text Wordmark Logo */
.fbui-logo-text-mobile {
    display: none;
    font-family: "Klavika", -apple-system, BlinkMacSystemFont, "Segoe UI",
        Roboto, Helvetica, Arial, sans-serif;
    font-size: 27px;
    font-weight: 800;
    color: var(--fb-brand-blue);
    text-decoration: none;
    letter-spacing: -1.2px;
    line-height: 1;
    user-select: none;
}

.fbui-search-box {
    background: #f0f2f5;
    border-radius: 50px;
    height: 40px;
    padding: 0 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    width: 240px;
}

.fbui-search-box i {
    color: #65676b;
    font-size: 15px;
}

.fbui-search-box input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 15px;
    color: #050505;
    width: 100%;
}

.fbui-search-box input::placeholder {
    color: #65676b;
}

/* 3. Center Navigation Tabs */
.fbui-topbar-center {
    display: flex;
    height: 100%;
    align-items: center;
    justify-content: center;
    flex: 1;
    max-width: 580px;
    margin: 0 auto;
}

.fbui-nav-tabs {
    display: flex;
    height: 100%;
    width: 100%;
    justify-content: space-around;
    list-style: none;
    margin: 0;
    padding: 0;
}

.fbui-nav-tabs li {
    height: 100%;
    flex: 1;
    max-width: 110px;
    position: relative;
    background: transparent;
}

.fbui-nav-tabs li a {
    display: flex;
    align-items: center;
    justify-content: center;
    height: calc(100% - 8px);
    width: 100%;
    margin: 4px 0;
    border-radius: 8px;
    transition: background 0.2s ease;
    text-decoration: none;
}

.fbui-nav-tabs li a i {
    color: #65676b;
    font-size: 22px;
}

.fbui-nav-tabs li a:hover {
    background: #f2f2f2;
}

.fbui-nav-tabs li.active a i {
    color: var(--fb-blue);
}

.fbui-nav-tabs li.active::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background-color: var(--fb-blue);
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}

/* 4. Right Controls Section */
.topbar-menu-right {
    background: transparent;
}

.topbar-menu-right > ul {
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.topbar-menu-right > ul > li {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    position: relative;
    margin: 0;
    padding: 0;
    background: transparent;
}

.topbar-menu-right > ul > li > a,
.topbar-menu-right .fbui-action-btn,
.topbar-menu-right .ossn-notifications-friends,
.topbar-menu-right .ossn-notifications-messages,
.topbar-menu-right .ossn-notifications-notification {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--fb-icon-bg);
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    padding: 0;
    margin: 0;
    transition: background 0.2s ease;
}

.topbar-menu-right > ul > li > a:hover,
.topbar-menu-right .fbui-action-btn:hover {
    background: var(--fb-icon-bg-hover);
}

.topbar-menu-right span,
.topbar-menu-right .ossn-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    background: transparent;
}

.topbar-menu-right i,
.topbar-menu-right .fa {
    font-size: 17px;
    color: var(--fb-icon-color);
    margin: 0;
    line-height: 1;
}

#ossn-notif-messages i::before {
    content: "\f4ad";
}

#ossn-notif-notification i::before {
    content: "\f0f3";
}

/* Avatar Button (Desktop Top Right) */
.fbui-user-avatar-btn {
    position: relative;
    width: 40px;
    height: 40px;
    background: transparent;
    padding: 0;
    border-radius: 50%;
}

.fbui-avatar-wrapper {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    position: relative;
    display: inline-block;
}

.fbui-avatar-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.fbui-avatar-caret {
    position: absolute;
    bottom: -1px;
    right: -1px;
    width: 15px;
    height: 15px;
    background: var(--fb-icon-bg);
    border: 2px solid #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
}

.fbui-avatar-caret i {
    font-size: 8px !important;
    color: #050505;
}

/*************************************************
	FACEBOOK MOBILE APP TWO-ROW HEADER
**************************************************/
@media (max-width: 767px) {
    .fbui-avatar-wrapper img {
        width: 36px;
        height: 36px;
    }
    /* 1. Layout Structure */
    .topbar {
        height: auto;
        flex-wrap: wrap;
        padding: 8px 12px 0 12px;
    }

    .fbui-search-box {
        display: none;
    }

    .topbar-menu-right > ul {
        gap: 6px;
    }

    .topbar-menu-right > ul > li,
    .topbar-menu-right > ul > li > a,
    .topbar-menu-right .fbui-action-btn {
        width: 36px;
        height: 36px;
    }

    /* 3. Bottom Row Navigation Bar */
    .fbui-topbar-center {
        display: flex;
        width: 100%;
        flex: 0 0 100%;
        max-width: 100%;
        order: 3;
        margin-top: 6px;
        border-top: 1px solid #f0f2f5;
    }

    .fbui-nav-tabs {
        width: 100%;
        justify-content: space-between;
    }

    .fbui-nav-tabs li {
        max-width: none;
    }

    .fbui-nav-tabs li a {
        height: 40px;
        margin: 0;
        border-radius: 0;
    }

    .fbui-nav-tabs li a i {
        font-size: 20px;
    }
}

/* OSSN Notification Overrides */
#ossn-notif-friends,
#ossn-notif-messages,
#ossn-notif-notification,
#ossn-notif-friends *,
#ossn-notif-messages *,
#ossn-notif-notification * {
    border: none;
    outline: none;
    box-shadow: none;
    border-radius: 0;
    background-color: transparent;
}

#ossn-notif-friends > a,
#ossn-notif-messages > a,
#ossn-notif-notification > a {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e4e6eb;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: none;
    border: none;
}

@media (max-width: 767px) {
    #ossn-notif-friends > a,
    #ossn-notif-messages > a,
    #ossn-notif-notification > a {
        width: 36px;
        height: 36px;
    }
}

#ossn-notif-friends > a:hover,
#ossn-notif-messages > a:hover,
#ossn-notif-notification > a:hover {
    background: #d8dadf;
}
#fbui-ajax-loader {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    background: #1877f2; /* FB Blue */
    z-index: 99999;
    width: 0;
    display: none;
    transition: width 0.3s ease;
}

/* Facebook-style Simple Search Dropdown */
.fbui-search-box {
    position: relative;
}

#fbui-search-dropdown {
    position: absolute;
    top: 48px;
    left: 0;
    width: 100%;
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 1060;
    overflow: hidden;
}

.fbui-search-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    text-decoration: none;
    color: #050505;
    transition: background 0.15s ease;
}

.fbui-search-item:hover {
    background: #f0f2f5;
}

.fbui-search-item span {
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
/*************** TOPBAR.PHP END *******/
/**************** newsfeed.php*******/
**************************************************/ .fbui-megamenu-overlay {
    background: #f7f8fa;
    border-radius: 12px;
    box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    padding: 16px;
    width: 580px;
    max-width: 100%;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI Historic",
        "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    box-sizing: border-box;
}

.fbui-megamenu-header {
    font-size: 24px;
    font-weight: 700;
    color: #050505;
    margin-bottom: 12px;
    padding-left: 4px;
}

.fbui-megamenu-grid {
    display: flex;
    gap: 16px;
}

/* Left Column: Social & Navigation Links */
.fbui-megamenu-left {
    flex: 1.2;
    background: #ffffff;
    border-radius: 8px;
    padding: 12px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    max-height: 480px;
    overflow-y: auto;
}

/* Search Box Inside Left Panel */
.fbui-megamenu-search {
    background: #f0f2f5;
    border-radius: 20px;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

.fbui-megamenu-search i {
    color: #65676b;
    font-size: 14px;
}

.fbui-megamenu-search input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 14px;
    width: 100%;
    color: #050505;
}

/* Right Column: "Create" Shortcuts Panel */
.fbui-megamenu-right {
    flex: 0.8;
    background: #ffffff;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    height: fit-content;
}

.fbui-megamenu-right-title {
    font-size: 20px;
    font-weight: 700;
    color: #050505;
    margin-bottom: 12px;
}

/* Section Headlines (e.g. Social, Groups, Links) */
.sidebar-menu-nav .sidebar-parent-item-main {
    list-style: none;
    font-size: 17px;
    font-weight: 700;
    color: #050505;
    margin-top: 12px;
    margin-bottom: 8px;
    padding: 0 4px;
    text-transform: capitalize;
}

.sidebar-menu-nav .sidebar-parent-item-main a {
    color: inherit;
    text-decoration: none;
    pointer-events: none; /* Keep titles clean like FB */
}

.sidebar-menu-nav .sidebar-parent-item-main i,
.sidebar-menu-nav .sidebar-parent-item-main .arrow {
    display: none; /* Hide default drop arrows */
}

/* Submenu Links List */
.sidebar-menu-nav ul.sub-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: block !important; /* Force items visible */
}

.sidebar-menu-nav ul.sub-menu li {
    margin-bottom: 4px;
}

.sidebar-menu-nav ul.sub-menu li a {
    display: flex;
    align-items: center;
    padding: 8px;
    border-radius: 8px;
    text-decoration: none;
    color: #050505;
    font-weight: 600;
    font-size: 15px;
    transition: background 0.2s ease;
}

.sidebar-menu-nav ul.sub-menu li a:hover {
    background: #f2f2f2;
}

/* Icon Container Inside Items */
.sidebar-menu-nav ul.sub-menu li a i,
.sidebar-menu-nav ul.sub-menu li a .ossn-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    background: #e4e6eb;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-size: 18px;
    color: #050505;
}

/* "Create" Right List Items */
.fbui-create-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.fbui-create-list li a {
    display: flex;
    align-items: center;
    padding: 8px;
    border-radius: 8px;
    text-decoration: none;
    color: #050505;
    font-weight: 600;
    font-size: 15px;
    transition: background 0.2s ease;
}

.fbui-create-list li a:hover {
    background: #f2f2f2;
}

.fbui-create-list .fbui-create-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    background: #e4e6eb;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-size: 16px;
    color: #050505;
}

.fbui-create-divider {
    height: 1px;
    background: #e4e6eb;
    margin: 8px 0;
}

@media (max-width: 767px) {
    .fbui-megamenu-grid {
        flex-direction: column;
    }
}
.fbui-megamenu-overlay {
    transition: opacity 0.3s ease, transform 0.3s ease !important;
    opacity: 1;
    transform: scale(1);
}

/* Class added via JS to trigger the exit animation */
.fbui-megamenu-hiding {
    opacity: 0 !important;
    transform: scale(0.96) !important;
}

/* FIX: Restored the rounded background hover effect and alignment */
.sidebar-menu-nav ul.sub-menu a {
    display: block;
    text-decoration: none !important;
}

.sidebar-menu-nav ul.sub-menu a li {
    display: flex !important;
    align-items: center !important;
    padding: 6px 10px !important;
    border-radius: 8px !important;
    transition: background 0.2s ease !important;
    margin-bottom: 2px !important;
}

.sidebar-menu-nav ul.sub-menu a:hover li {
    font-weight: bold;
    background: #f2f2f2 !important; /* The rounded gray hover background */
}

/* 1. Base Setup for Pseudo-Element Icons */
.sidebar-menu-nav ul.sub-menu li:before,
.sidebar-menu-nav ul.sub-menu a li:before {
    font-family: "Font Awesome 5 Free" !important;
    font-weight: 900 !important;
    font-style: normal !important;
    font-variant: normal !important;
    text-rendering: auto !important;
    -webkit-font-smoothing: antialiased;

    display: inline-flex !important;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    min-width: 36px;
    margin-right: 12px;
    font-size: 16px;
    color: #ffffff !important; /* White icon glyph */

    /* Removed float: left; so flexbox can center everything nicely */

    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease;
    background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);

    border-radius: 50% !important;
    overflow: hidden !important;
    box-sizing: border-box !important;
}

/* News Feed (Blue Gradient) */
.menu-section-item-newsfeed:before {
    content: "\f1ea" !important; /* fa-newspaper */
    background: linear-gradient(135deg, #1877f2 0%, #0052c2 100%) !important;
}

/* Friends (Cyan/Blue Gradient) */
.menu-section-item-friends:before {
    content: "\f500" !important; /* fa-user-friends */
    background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%) !important;
}

/* Photos (Teal/Green Gradient) */
.menu-section-item-photos:before {
    content: "\f03e" !important; /* fa-image */
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
}

/* Notifications (Amber/Orange Gradient) */
.menu-section-item-notifications:before {
    content: "\f0f3" !important; /* fa-bell */
    background: linear-gradient(135deg, #ff9900 0%, #ff5500 100%) !important;
}

/* Messages (Purple/Pink Gradient) */
.menu-section-item-messages:before {
    content: "\f4ad" !important; /* fa-comment-dots / messenger */
    background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%) !important;
}

/* Invite Friends (Violet/Blue Gradient) */
.menu-section-item-invite-friends:before {
    content: "\f234" !important; /* fa-user-plus */
    background: linear-gradient(135deg, #6366f1 0%, #3b82f6 100%) !important;
}

/* Wallet (Green/Emerald Gradient) */
.menu-section-item-wallet:before {
    content: "\f555" !important; /* fa-wallet */
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
}

/* Add Group (Blue/Indigo Gradient) */
.menu-section-item-addgroup:before {
    content: "\f0c0" !important; /* fa-users */
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
}

/* My Groups & All Groups (Indigo Gradient) */
.menu-section-item-mygroups:before,
.menu-section-item-allgroups:before {
    content: "\f500" !important; /* fa-user-friends */
    background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%) !important;
}

/* eGifts (Red/Pink Gradient) */
.menu-section-item-egifts-list:before,
.menu-section-item-egifts-sent:before,
.menu-section-item-egifts-received:before {
    content: "\f06b" !important; /* fa-gift */
    background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%) !important;
}

/* Marketplace (Orange/Yellow Gradient) */
.menu-section-item-marketplace:before,
.menu-section-item-marketplacemy:before,
.menu-section-item-marketplaceadd:before {
    content: "\f54e" !important; /* fa-store */
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}

/* Fallback/Default Gradient for Unmatched Items */
.sidebar-menu-nav ul.sub-menu li:not([class*="menu-section-item-"]):before {
    content: "\f02b" !important; /* fa-tag */
    background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%) !important;
}
.menu-section-item-profileviews:before,
.menu-section-item-a-profileviews li:before {
    content: "\f06e" !important; /* fa-eye */
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
}

/* Watch / Videos (Red Gradient) */
.menu-section-item-videoswatch:before,
.menu-section-item-a-videoswatch li:before,
.menu-section-item-videos-all:before,
.menu-section-item-a-videos-all li:before,
.menu-section-item-videos-my:before,
.menu-section-item-a-videos-my li:before,
.menu-section-item-videos-pending:before,
.menu-section-item-a-videos-pending li:before,
.menu-section-item-videos-add:before,
.menu-section-item-a-videos-add li:before {
    content: "\f144" !important; /* fa-play-circle */
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
}

/* Saved / Bookmarks (Pink/Purple Gradient) */
.menu-section-item-bookmarks:before,
.menu-section-item-a-bookmarks li:before {
    content: "\f02e" !important; /* fa-bookmark */
    background: linear-gradient(135deg, #f35369 0%, #a238ff 100%) !important;
}

/* Business Pages (Orange Gradient) */
.menu-section-item-businesspage-all:before,
.menu-section-item-a-businesspage-all li:before,
.menu-section-item-businesspage-liked:before,
.menu-section-item-a-businesspage-liked li:before,
.menu-section-item-businesspage-mypages:before,
.menu-section-item-a-businesspage-mypages li:before,
.menu-section-item-businesspage-add:before,
.menu-section-item-a-businesspage-add li:before {
    content: "\f0a1" !important; /* fa-bullhorn */
    background: linear-gradient(135deg, #f97316 0%, #ea580c 100%) !important;
}

/* Polls (Purple/Pink Gradient) */
.menu-section-item-polls-my:before,
.menu-section-item-a-polls-my li:before,
.menu-section-item-polls-all:before,
.menu-section-item-a-polls-all li:before {
    content: "\f080" !important; /* fa-chart-bar */
    background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%) !important;
}

/* Events (Red/Orange Gradient) */
.menu-section-item-events-all:before,
.menu-section-item-a-events-all li:before,
.menu-section-item-events-calendar:before,
.menu-section-item-a-events-calendar li:before,
.menu-section-item-events-my:before,
.menu-section-item-a-events-my li:before,
.menu-section-item-events-add:before,
.menu-section-item-a-events-add li:before {
    content: "\f133" !important; /* fa-calendar-alt */
    background: linear-gradient(135deg, #ef4444 0%, #f97316 100%) !important;
}

/* Site Members (Blue Gradient) */
.menu-section-item-emembers-male:before,
.menu-section-item-a-emembers-male li:before,
.menu-section-item-emembers-female:before,
.menu-section-item-a-emembers-female li:before {
    content: "\f007" !important; /* fa-user */
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
}

/* Games / Play Component (Rose Gradient) */
.menu-section-item-games:before,
.menu-section-item-a-games li:before,
.menu-section-item-play:before,
.menu-section-item-a-play li:before {
    content: "\f11b" !important; /* fa-gamepad */
    background: linear-gradient(135deg, #f43f5e 0%, #fb7185 100%) !important;
}
/*************************************************
	 9-DOT MEGAMENU POPOVER STYLES
**************************************************/

.fbui-megamenu-overlay {
    background: #f7f8fa;
    border-radius: 12px;
    box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.2), 0 2px 4px 0 rgba(0, 0, 0, 0.1);
    padding: 16px;
    width: 580px;
    max-width: 100%;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI Historic",
        "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    box-sizing: border-box;
}

.fbui-megamenu-header {
    font-size: 24px;
    font-weight: 700;
    color: #050505;
    margin-bottom: 12px;
    padding-left: 4px;
}

.fbui-megamenu-grid {
    display: flex;
    gap: 16px;
}

/* Left Column: Social & Navigation Links */
.fbui-megamenu-left {
    flex: 1.2;
    background: #ffffff;
    border-radius: 8px;
    padding: 12px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    max-height: 480px;
    overflow-y: auto;
}

/* Search Box Inside Left Panel */
.fbui-megamenu-search {
    background: #f0f2f5;
    border-radius: 20px;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

.fbui-megamenu-search i {
    color: #65676b;
    font-size: 14px;
}

.fbui-megamenu-search input {
    border: none;
    background: transparent;
    outline: none;
    font-size: 14px;
    width: 100%;
    color: #050505;
}

/* Right Column: "Create" Shortcuts Panel */
.fbui-megamenu-right {
    flex: 0.8;
    background: #ffffff;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    height: fit-content;
}

.fbui-megamenu-right-title {
    font-size: 20px;
    font-weight: 700;
    color: #050505;
    margin-bottom: 12px;
}

/* Section Headlines (e.g. Social, Groups, Links) */
.sidebar-menu-nav .sidebar-parent-item-main {
    list-style: none;
    font-size: 17px;
    font-weight: 700;
    color: #050505;
    margin-top: 12px;
    margin-bottom: 8px;
    padding: 0 4px;
    text-transform: capitalize;
}

.sidebar-menu-nav .sidebar-parent-item-main a {
    color: inherit;
    text-decoration: none;
    pointer-events: none; /* Keep titles clean like FB */
}

.sidebar-menu-nav .sidebar-parent-item-main i,
.sidebar-menu-nav .sidebar-parent-item-main .arrow {
    display: none; /* Hide default drop arrows */
}

/* Submenu Links List */
.sidebar-menu-nav ul.sub-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    display: block !important; /* Force items visible */
}

.sidebar-menu-nav ul.sub-menu li {
    margin-bottom: 4px;
}

.sidebar-menu-nav ul.sub-menu li a {
    display: flex;
    align-items: center;
    padding: 8px;
    border-radius: 8px;
    text-decoration: none;
    color: #050505;
    font-weight: 600;
    font-size: 15px;
    transition: background 0.2s ease;
}

.sidebar-menu-nav ul.sub-menu li a:hover {
    background: #f2f2f2;
}

/* Icon Container Inside Items */
.sidebar-menu-nav ul.sub-menu li a i,
.sidebar-menu-nav ul.sub-menu li a .ossn-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    background: #e4e6eb;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-size: 18px;
    color: #050505;
}

/* "Create" Right List Items */
.fbui-create-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.fbui-create-list li a {
    display: flex;
    align-items: center;
    padding: 8px;
    border-radius: 8px;
    text-decoration: none;
    color: #050505;
    font-weight: 600;
    font-size: 15px;
    transition: background 0.2s ease;
}

.fbui-create-list li a:hover {
    background: #f2f2f2;
}

.fbui-create-list .fbui-create-icon {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    background: #e4e6eb;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-size: 16px;
    color: #050505;
}

.fbui-create-divider {
    height: 1px;
    background: #e4e6eb;
    margin: 8px 0;
}

/*************************************************
	FULL MOBILE STYLESHEET (@media max-width: 767px)
**************************************************/

@media (max-width: 767px) {
    /* ==========================================
	   1. TOPBAR & TWO-ROW LAYOUT
	   ========================================== */
    .topbar {
        height: auto !important;
        flex-wrap: wrap !important;
        padding: 8px 12px 0 12px !important;
    }

    body:has(.landing-split) .ossn-inner-page {
        margin-top: 0px !important;
    }

    body:not(:has(.topbar.position-relative)) .ossn-inner-page {
        margin-top: 96px !important;
    }
    .fbui-topbar-left .fbui-logo-text-mobile {
        display: inline-block !important;
        font-family: "Klavika", -apple-system, BlinkMacSystemFont, "Segoe UI",
            Roboto, sans-serif !important;
        font-size: 27px !important;
        font-weight: 800 !important;
        color: #1877f2 !important;
        text-decoration: none !important;
        letter-spacing: -1.2px !important;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Hide search bar input box on header */
    .fbui-search-box {
        display: none !important;
    }

    .topbar-menu-right > ul {
        gap: 6px !important;
    }

    .topbar-menu-right > ul > li,
    .topbar-menu-right > ul > li > a,
    .topbar-menu-right .fbui-action-btn,
    #ossn-notif-friends > a,
    #ossn-notif-messages > a,
    #ossn-notif-notification > a {
        width: 36px !important;
        height: 36px !important;
    }

    /* ==========================================
	   2. BOTTOM ROW NAVIGATION BAR & AVATAR TAB
	   ========================================== */
    .fbui-topbar-center {
        display: flex !important;
        width: 100% !important;
        flex: 0 0 100% !important;
        max-width: 100% !important;
        order: 3 !important;
        margin-top: 6px !important;
        border-top: 1px solid #f0f2f5 !important;
    }

    .fbui-nav-tabs {
        width: 100% !important;
        justify-content: space-between !important;
    }

    .fbui-nav-tabs li {
        max-width: none !important;
    }

    .fbui-nav-tabs li a {
        height: 40px !important;
        margin: 0 !important;
        border-radius: 0 !important;
    }

    .fbui-nav-tabs li a i {
        font-size: 20px !important;
    }

    /* Mobile Profile Avatar Nav Tab (Far Right) */
    .fbui-nav-tabs .nav-tab-profile {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .fbui-nav-tabs .fbui-mobile-nav-avatar {
        position: relative !important;
        width: 28px !important;
        height: 28px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 auto !important;
    }

    .fbui-nav-tabs .fbui-mobile-nav-avatar img {
        width: 28px !important;
        height: 28px !important;
        object-fit: cover !important;
        border-radius: 50% !important;
    }

    /* Hamburger Overlay Badge on Avatar */
    .fbui-nav-tabs .fbui-mobile-nav-avatar-badge {
        position: absolute !important;
        bottom: -2px !important;
        right: -2px !important;
        width: 14px !important;
        height: 14px !important;
        background: #65676b !important;
        border: 1.5px solid #ffffff !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-sizing: border-box !important;
        z-index: 2 !important;
    }

    .fbui-nav-tabs .fbui-mobile-nav-avatar-badge i,
    .fbui-nav-tabs .fbui-mobile-nav-avatar-badge .fa {
        font-size: 7px !important;
        color: #ffffff !important;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
    }

    /* ==========================================
	   3. 9-DOT MEGAMENU OVERLAY
	   ========================================== */
    .fbui-megamenu-dropdown {
        position: static !important;
    }

    .fbui-megamenu-dropdown .dropdown-menu {
        position: fixed !important;
        top: 96px !important; /* Positions flush below header bar */
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: calc(100dvh - 96px) !important; /* Smooth dynamic height */
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        border-radius: 0 !important;
        background: #f7f8fa !important;

        /* Menu scrolling & lock body chaining */
        overflow-y: auto !important;
        overscroll-behavior: contain !important;
        -webkit-overflow-scrolling: touch;
        z-index: 1050 !important;

        transform: none !important; /* FIX: Stops Bootstrap from injecting a translate transform! */
    }

    .fbui-megamenu-overlay {
        width: 100% !important;
        max-width: 100% !important;
        min-height: 100% !important;
        padding: 12px 12px 36px 12px !important; /* Tight top padding */
        box-sizing: border-box !important;
        background: #f7f8fa !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .fbui-megamenu-header {
        font-size: 20px !important;
        margin-top: 4px !important;
        margin-bottom: 12px !important;
        padding-left: 4px !important;
        font-weight: 700 !important;
        color: #050505 !important;
    }

    /* Stack Megamenu Grid Panels */
    .fbui-megamenu-grid {
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
    }

    /* Re-order "Create" Panel to Top */
    .fbui-megamenu-right {
        order: 1 !important;
        width: 100% !important;
        background: #ffffff !important;
        border-radius: 12px !important;
        padding: 12px !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        box-sizing: border-box !important;
    }

    /* Links List Panel Below */
    .fbui-megamenu-left {
        order: 2 !important;
        width: 100% !important;
        max-height: none !important; /* Eliminates nested scrollbars */
        overflow: visible !important;
        background: #ffffff !important;
        border-radius: 12px !important;
        padding: 12px !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        box-sizing: border-box !important;
    }

    /* 2-Column Grid for Create Actions */
    .fbui-create-list {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 8px !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .fbui-create-list li a {
        background: #ffffff !important;
        border: 1px solid #e4e6eb !important;
        padding: 8px 10px !important;
        border-radius: 10px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        display: flex !important;
        align-items: center !important;
    }

    .fbui-create-list .fbui-create-icon {
        background: #e4e6eb !important;
        color: #050505 !important;
        width: 32px !important;
        height: 32px !important;
        min-width: 32px !important;
        font-size: 15px !important;
        margin-right: 8px !important;
        border-radius: 50% !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .fbui-create-divider {
        display: none !important;
    }

    .fbui-megamenu-search {
        padding: 10px 14px !important;
        margin-bottom: 12px !important;
    }

    .fbui-megamenu-search input {
        font-size: 16px !important; /* Prevents iOS Safari auto-zoom */
    }

    /* Spacing for Menu List Items & Gradient Badges */
    .sidebar-menu-nav ul.sub-menu {
        padding: 0 !important;
        margin: 0 !important;
    }

    .sidebar-menu-nav ul.sub-menu li a {
        padding: 10px 8px !important;
        font-size: 15px !important;
    }

    .sidebar-menu-nav ul.sub-menu li:before,
    .sidebar-menu-nav ul.sub-menu a li:before {
        width: 36px !important;
        height: 36px !important;
        min-width: 36px !important;
        font-size: 16px !important;
        margin-right: 12px !important;
    }
}
.sidebar-menu-nav .sidebar-menu .menu-content {
    padding: 0px;
}
/************ newsfeed.php end*********/
.sidepanel-logo {
    width: 150px;
    margin: 0 auto;
    display: block;
    margin-top: 25px;
}
/************** index.php ***************/

.landing-split {
    display: flex;
    width: 100%;
    min-height: 100vh;
    margin: 0;
    position: relative;
}

/* ---- LEFT: brand / collage / heading / features ---- */
.landing-split__left {
    flex: 1 1 58%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #ffffff;
    padding: 40px clamp(24px, 6vw, 100px);
    box-sizing: border-box;
}

.brand-glass-box {
    margin-bottom: 8px;
}

.brand-glass-box .main-logo {
    max-width: 64px;
    height: auto;
}

/* ---- decorative collage (pure CSS, no external images) ---- */
.collage {
    position: relative;
    width: 100%;
    max-width: 600px;
    height: 340px;
    margin: 8px 0 20px 0;
}

.collage-card {
    position: absolute;
    border-radius: 18px;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.collage-card--a {
    width: 190px;
    height: 190px;
    left: 0;
    top: 60px;
    background: linear-gradient(135deg, #a8c0ff 0%, #0866ff 100%);
    transform: rotate(-6deg);
}

.collage-card--a .collage-card__icon {
    font-size: 2.4rem;
    opacity: 0.85;
}

.collage-card--b {
    width: 230px;
    height: 300px;
    left: 150px;
    top: 0;
    background: linear-gradient(160deg, #ffd7a8 0%, #f2994a 55%, #eb5757 100%);
    transform: rotate(4deg);
    flex-direction: column;
    padding: 16px;
    box-sizing: border-box;
    align-items: stretch;
    justify-content: flex-start;
    gap: 10px;
}

.collage-card--b .collage-card__bar {
    width: 60%;
    height: 6px;
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.7);
}

.collage-card--b .collage-card__icon {
    font-size: 3.2rem;
    align-self: center;
    margin: auto 0;
    opacity: 0.9;
}

.collage-card--b .collage-card__lines {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.collage-card--b .collage-card__lines span {
    display: block;
    height: 6px;
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.55);
}

.collage-card--b .collage-card__lines span:nth-child(1) {
    width: 90%;
}
.collage-card--b .collage-card__lines span:nth-child(2) {
    width: 70%;
}
.collage-card--b .collage-card__lines span:nth-child(3) {
    width: 50%;
}

.collage-card--c {
    width: 150px;
    height: 150px;
    left: 300px;
    top: 150px;
    background: linear-gradient(135deg, #b7f0c1 0%, #27ae60 100%);
    transform: rotate(-3deg);
}

.collage-card--c .collage-card__icon {
    font-size: 2rem;
    opacity: 0.85;
}

.collage-card--d {
    width: 130px;
    height: 160px;
    left: 400px;
    top: 50px;
    background: linear-gradient(150deg, #d6a8ff 0%, #8a5cf6 60%, #6c5ce7 100%);
    transform: rotate(9deg);
}

.collage-card--d .collage-card__icon {
    font-size: 2rem;
    opacity: 0.85;
}

.collage-badge {
    position: absolute;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #ffffff;
    color: #1c1e21;
    font-size: 0.85rem;
    font-weight: 700;
    padding: 8px 14px;
    border-radius: 999px;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
    z-index: 3;
}

.collage-badge--time {
    top: -14px;
    left: 300px;
    right: auto;
    color: #6c5ce7;
}

.collage-badge--emoji {
    top: 10px;
    left: 60px;
    font-size: 1.6rem;
    padding: 8px;
    line-height: 1;
    color: orange;
}

.collage-badge--heart {
    right: 4px;
    top: 170px;
    right: 30px;
    color: #eb5757;
    font-size: 1.2rem;
    padding: 10px;
}

.collage-avatar {
    position: absolute;
    left: 260px;
    bottom: 0;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ffe58a, #f2994a);
    border: 4px solid #0866ff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.6rem;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
}

.landing-split__heading {
    font-size: 2.9rem;
    font-weight: 800;
    line-height: 1.15;
    color: #1c1e21;
    margin: 0 0 24px 0;
}

.landing-split__heading .text-highlight {
    color: #0866ff;
}

.modern-features {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.feature-tag {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(8, 102, 255, 0.15);
    color: #1c1e21;
    font-size: 0.9rem;
    font-weight: 500;
    padding: 8px 14px;
    border-radius: 999px;
    backdrop-filter: blur(6px);
}

.feature-tag i {
    color: #0866ff;
}

/* ---- RIGHT: auth panel ---- */
.landing-split__right {
    flex: 1 1 45%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    padding: 40px clamp(24px, 4vw, 80px);
    box-sizing: border-box;
    border-left: 1px solid #dadde1;
    position: relative;
}

.signup-panel {
    width: 100%;
    max-width: 440px;
}

.signup-title {
    text-align: left;
    margin-bottom: 22px;
}

.signup-title h2 {
    font-size: 1.6rem;
    font-weight: 700;
    color: #1c1e21;
    margin: 0 0 4px 0;
}

.signup-title span {
    color: #65676b;
    font-size: 0.95rem;
}

/* Form field polish */
.auth-form-box input[type="text"],
.auth-form-box input[type="email"],
.auth-form-box input[type="password"] {
    width: 100%;
    padding: 14px 16px;
    margin-bottom: 14px;
    border: 1px solid #ccd0d5;
    border-radius: 6px;
    font-size: 1rem;
    box-sizing: border-box;
    background: #ffffff;
}

.auth-form-box input[type="text"]:focus,
.auth-form-box input[type="email"]:focus,
.auth-form-box input[type="password"]:focus {
    border-color: #0866ff;
    outline: none;
    box-shadow: 0 0 0 2px #e7f3ff;
}

/* Exact Facebook Solid Blue Button Styling */
#ossn-submit-button,
.auth-form-box input[type="submit"],
.auth-form-box button[type="submit"] {
    width: 100% !important;
    padding: 14px 16px !important;
    border-radius: 6px !important;
    background: #0866ff !important;
    color: #ffffff !important;
    font-size: 20px !important;
    line-height: 24px !important;
    font-weight: 700 !important;
    letter-spacing: normal !important;
    margin-top: 10px !important;
    cursor: pointer !important;
    transition: background-color 0.2s ease !important;
    box-shadow: none !important;
    border: 1px solid #0866ff !important;
}

#ossn-submit-button:hover,
.auth-form-box input[type="submit"]:hover,
.auth-form-box button[type="submit"]:hover {
    background: #166fe5 !important;
    border-color: #166fe5 !important;
    color: #ffffff !important;
    box-shadow: none !important;
    transform: none !important;
}

/* Switch links text styling */
.auth-switch-text {
    margin-top: 20px;
    text-align: center;
    font-size: 0.95rem;
    color: #65676b;
}

.auth-switch-text a {
    color: #0866ff;
    font-weight: 600;
    text-decoration: none;
}

.auth-switch-text a:hover {
    text-decoration: underline;
}

/* ---- responsive: stack on small screens ---- */
@media (max-width: 991px) {
    .landing-split {
        flex-direction: column;
    }

    .landing-split__left,
    .landing-split__right {
        flex: 1 1 auto;
        padding: 40px 6vw;
    }

    .landing-split__right {
        border-left: none;
        border-top: 1px solid #dadde1;
    }

    .landing-split__heading {
        font-size: 2.1rem;
    }

    .collage {
        height: 260px;
        max-width: 100%;
    }

    .collage-card--a {
        width: 130px;
        height: 130px;
        top: 50px;
    }
    .collage-card--b {
        width: 160px;
        height: 220px;
        left: 110px;
    }
    .collage-card--c {
        width: 100px;
        height: 100px;
        left: 210px;
        top: 110px;
    }
    .collage-card--d {
        width: 90px;
        height: 110px;
        left: 270px;
        top: 30px;
    }
    .collage-avatar {
        left: 190px;
        width: 56px;
        height: 56px;
    }
    .collage-badge--time {
        left: 210px;
        top: 34px;
    }
    .collage-badge--heart {
        right: 10px;
        top: 100px;
        right: 0px;
    }
}
/******** BIRTHDAYS ********/
/* Main Widget Container */
.fbui-birthdays-widget {
    padding: 8px 0;
    margin-top: 8px;
    border-top: 1px solid #ced0d4;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI Historic", "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

/* Header Title */
.fbui-birthdays-header {
	font-size: 17px;
	font-weight: 700;
	color: #65676b;
	margin-bottom: 8px;
	padding: 0 8px;
}

/* Individual Item Row */
.fbui-birthday-item {
	display: flex;
	align-items: center; /* Vertically centers icon wrapper and text container */
	gap: 5px;
	padding: 8px;
	border-radius: 8px;
	cursor: pointer;
	text-decoration: none !important;
	color: #050505;
	transition: background-color 0.15s ease;
}

.fbui-birthday-item:hover {
	background-color: rgba(0, 0, 0, 0.05);
}

/* Gift/Cake Icon Wrapper */
.fbui-birthday-icon-wrapper {
	width: 32px;
	height: 32px;
	min-width: 32px;
	display: flex;
	align-items: center;
	justify-content: center;
	line-height: 0; /* Prevents inline whitespace shift */
}

/* SVG Gift Box Styling */
.fbui-gift-svg {
	width: 28px;
	height: 28px;
	display: block; /* Removes baseline inline gap */
}

/* Text Content Container */
.fbui-birthday-content {
	font-size: 14px;
	line-height: 1.35; /* Normalizes line-height for exact vertical centering */
	color: #050505;
	display: inline-block;
	margin-top:-4px;
}

.fbui-birthday-content b {
	font-weight: 600;
	color: #050505;
}

/* Subtext for Upcoming Dates */
.fbui-birthday-subtext {
	font-size: 13px;
	color: #65676b;
	margin-top: 2px;
}

/* Empty State Fallback */
.fbui-no-birthdays {
	font-size: 14px;
	color: #65676b;
	padding: 8px;
}
/*************************************************
	NEWSFEED RIGHT COLUMN CONTACTS WIDGET
**************************************************/
.fbui-newsfeed-contacts-widget {
	background: transparent;
	padding: 8px 0;
	margin-top: 12px;
	border-top: 1px solid #ced0d4;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI Historic", "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

/* Header Section */
.fbui-contacts-header {
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 4px 8px 8px 8px;
}

.fbui-contacts-title {
	font-size: 17px;
	font-weight: 700;
	color: #65676b;
}

.fbui-contacts-actions {
	display: flex;
	align-items: center;
}

.fbui-contact-icon-btn {
	background: transparent;
	border: none;
	width: 32px;
	height: 32px;
	border-radius: 50%;
	color: #65676b;
	cursor: pointer;
	display: flex;
	align-items: center;
	justify-content: center;
	transition: background 0.2s ease;
}

.fbui-contact-icon-btn:hover {
	background: rgba(0, 0, 0, 0.06);
}

/* Search Box Input */
.fbui-contacts-search {
	padding: 4px 8px 8px 8px;
}

.fbui-contacts-search input {
	width: 100%;
	padding: 6px 12px;
	border-radius: 18px;
	border: none;
	background: #e4e6eb;
	font-size: 13px;
	outline: none;
	box-sizing: border-box;
}

/* Scrollable Contacts List Container */
.fbui-contacts-list {
	list-style: none !important;
	margin: 0 !important;
	padding: 0 !important;
	height: 380px !important;
	max-height: 380px !important;
	overflow-y: scroll !important;
	display: block !important;
}

.fbui-contacts-list::-webkit-scrollbar {
	width: 6px;
}

.fbui-contacts-list::-webkit-scrollbar-thumb {
	background-color: #ced0d4;
	border-radius: 3px;
}

/* Contact Item Row */
.fbui-contact-item {
	display: flex;
	align-items: center;
	gap: 12px;
	padding: 8px;
	border-radius: 8px;
	cursor: pointer;
	transition: background 0.15s ease;
}

.fbui-contact-item:hover {
	background: rgba(0, 0, 0, 0.05);
}

/* Avatar Wrapper & Badges */
.fbui-contact-avatar-wrapper {
	position: relative;
	width: 36px;
	height: 36px;
	min-width: 36px;
}

.fbui-contact-avatar-wrapper img {
	width: 36px;
	height: 36px;
	border-radius: 50%;
	object-fit: cover;
}

.fbui-status-badge {
	position: absolute;
	bottom: -1px;
	right: -2px;
	border: 2px solid #ffffff;
	border-radius: 10px;
	font-size: 9px;
	font-weight: 700;
	line-height: 1;
	box-sizing: border-box;
}

.fbui-status-online {
	width: 12px;
	height: 12px;
	background-color: #31a24c;
	border-radius: 50%;
}

.fbui-status-recent {
	background-color: #e4e6eb;
	color: #31a24c;
	padding: 2px 4px;
	border-radius: 8px;
}

.fbui-contact-name {
	font-size: 15px;
	font-weight: 600;
	color: #050505;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

/* CENTERED LOADING SPINNER SENTINEL */
#fbui-contacts-scroll-sentinel {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 100%;
	padding: 12px 0;
}

#fbui-contacts-scroll-sentinel .ossn-loading {
	margin: 0 auto;
}

/* Hide native pagination container visually */
.fbui-contacts-pagination-container {
	display: none !important;
}