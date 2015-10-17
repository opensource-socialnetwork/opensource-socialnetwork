/**
* Open Source Social Network
*
* @package   (Informatikon.com).ossn
* @author    OSSN Core Team
<info@opensource-socialnetwork.org>
* @copyright 2014 iNFORMATIKON TECHNOLOGIES
* @license   General Public Licence http://www.opensource-socialnetwork.org/licence
* @link      http://www.opensource-socialnetwork.org/licence
*/
body, fieldset, table, textarea, input {
margin: 0;
padding: 0;
border: 0;
outline: 0;
font-weight: inherit;
font-style: inherit;
}
body {
font-size: 11px;
font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
color: #333;
}
hr {
background: #D9D9D9;
border-width: 0;
color: #D9D9D9;
height: 1px;
}
a {
color:#2B5470;
text-decoration:none;
}
.ossn-layout-contents {
width: 985px;
margin: 0 auto;
}
.ossn-content-spacing {
margin-top:50px;
}
.ossn-form input[type='text'],
.ossn-form input[type='password']{
border-color: #1D2A5B;
color: #000;
font-size: 11px;
margin: 0;
padding: 3px 3px 4px;
width: 150px;
}
#ossn-login .long-input,
#ossn-home-signup .long-input {
width: 325px;
}
.ossn-button {
color: #333;
font-weight: bold;
text-decoration: none;
width: auto;
margin: 0;
font-size: 11px;
line-height: 16px;
padding: 2px 6px;
cursor: pointer;
outline: none;
text-align: center;
white-space: nowrap;

-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #FFF;
-moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.10), inset 0 1px 0 #fff;
box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #FFF;

border: 1px solid #999;
border-bottom-color: #888;
background: #EEE;
background: -webkit-gradient(linear, 0 0, 0 100%, from(#F5F6F6), to(#E4E4E3));
background: -moz-linear-gradient(#f5f6f6, #e4e4e3);
background: -o-linear-gradient(#f5f6f6, #e4e4e3);
background: linear-gradient(#F5F6F6, #E4E4E3);
}
.ossn-button-submit {
color: #FFF !important;
background: #47718B;
border-color: #369 #369 #1A356E;

-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #89A6C4;
-moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.10), inset 0 1px 0 #89A6C4;
box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #89A6C4;
}
.ossn-button-submit:focus {
background: #5C8CA9;
}


.ossn-header {
background:#222222;
height:90px;
}
.logo-second {
background:url('<?php echo ossn_theme_url(); ?>images/logo_2.png') no-repeat;
height:28px;
width:28px;
}
.ossn-header .inner{
padding:10px;
width:985px;
margin:0 auto;
color:#fff;
}
.ossn-logo {
background:url('<?php echo ossn_theme_url(); ?>images/logo.jpg') no-repeat;
height: 49px;
width: 166px;

margin-top: 15px;
}
.ossn-home-container {
background:url('<?php echo ossn_theme_url(); ?>images/home-new-bg.jpg') repeat-x;
min-height:465px;
color:#fff;
}
.ossn-home-container a{
color:#fff !important;
text-decoration:underline;
}
.ossn-home-container .login-error {
color:#000;
}
.ossn-home-container .inner {
width: 985px;
margin: 0 auto;
padding-bottom: 20px;
min-height: 530px;
}
.home-left-contents {
width: 556px;
display:inline-table;
float:left;
}
.home-left-contents h1{
font-size:20px;
margin-top: 32px;
}
.home-right-contents {
display:inline-table;
margin-left: 35px;
width: 376px;
}
.home-right-contents h1{
font-size: 30px;
}
.home-right-contents .h1-bottom {
font-family:"lucida grande",tahoma,verdana,arial,sans-serif;
font-size: 22px;
font-weight: normal;
line-height: 28px;

margin-top: -20px;
}
.ossn-home-container img {
box-shadow: 1px 4px 5px #333;
margin-top: 16px;
}

#ossn-header-login {
float: right;
margin-top: -52px;
padding: 6px;
}

#ossn-header-login label {
color:white;
display: block;
font-weight: normal;
padding: 2px 2px 4px;
}


#ossn-header-login div {
display: inline-block;
margin-bottom: 3px;
padding-right: 10px;
}
#ossn-header-login a{
color:#fff;
text-decoration:none;
}
#ossn-header-login a:hover{
color:#fff;
text-decoration:underline;
cursor:pointer;
}
#ossn-header-login .input {
border-color: #1D2A5B;
color: black;
font-size: 11px;
margin:0;
padding: 3px 3px 4px;
width: 150px;
}
#ossn-login input,
#ossn-home-signup input{
font-size: 18px;
padding: 8px 10px;
border: 1px solid #BDC7D8;
border-radius:5px;
}
#ossn-login div,
#ossn-home-signup div{
margin-bottom:10px;
}
#ossn-home-signup span {
display:inline-block;
margin-right:10px;
}
#ossn-home-signup select,
#ossn-home-signup option {
margin-top:-5px;
height: 31px;
padding: 5px;
}

.ossn-button-green,
#ossn-login input[type='submit'],
#ossn-home-signup input[type='submit']{
box-shadow: 0px 1px 1px #517185 inset;
border-color: #517185;
background: linear-gradient(#517185, #2F4959) repeat scroll 0% 0% #2F4959;
color: #fff;
cursor: pointer;
}
.home-footer {
width: 985px;
margin: 0 auto;
padding:5px;
font-size:12px;
}
.home-footer-links {
margin-top: 21px;
border-top: 1px solid #CCC;
}
.home-footer-links li{
display:inline-block;
}
/********************
Topbar
*********************/
.ossn-topbar {
background:linear-gradient(to bottom, #333, #000);
height:42px;
position: fixed;
left: 0;
right: 0;
top:0;
z-index: 10000;
}
/********************
Login Page
*********************/
.ossn-error-container,
.login-error {
border:1px  solid #DD3C10;
border-width: 1px;
background-color: #FFEBE8;
padding:13px;
color:#000;
}
.login-page {
width: 583px;
min-height: 200px;
margin-top: 70px;
position: absolute;
margin-left: 193px;
}
.login-page-fields {
padding: 14px;
text-align: center;
}
.login-page-fields a{
margin-top:10px;
}
.login-page-fields a:hover{
text-decoration:underline;
}
.login-page-fields span{
font-size: 11px;
font-weight: bold;
}
/*************************
Forms
*************************/
.ossn-red-borders {
border:1px solid #DB2727 !important;
}
#ossn-signup-errors {
display:none;
margin-top: -15px;
width: 325px;
}
.ossn-message-done{
border: 1px solid #1EB0DF;
border-width: 1px;
background-color: #DAF6FF;
padding: 13px;
text-align:left;
}
.ossn-required {
color:#DB2727;
}
.button-blue-light {
margin-left: 4px;
color: #fff;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.2);
background: #4D96BE;
background-image: linear-gradient(top bottom, #ffffff, #f6f7f8);

-webkit-background-clip: padding-box;

background-clip: padding-box;
border: 1px solid;

-webkit-border-radius: 2px;
border-radius: 2px;
-moz-border-radius: 2px;

-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
-moz-box-shadow: 0 1px 1px rgba(0,0,0,.05);

-webkit-box-sizing: content-box;
box-sizing: content-box;
-moz-box-sizing: content-box;
-webkit-font-smoothing: antialiased;

line-height: 22px;
font-weight: 700;
font-size: 12px;
position: relative;
text-align: center;
vertical-align: middle;
cursor: pointer;
display: inline-block;
text-decoration: none;
white-space: nowrap;
border-color: #3684AF #3C86C0 #175F81 !important;
padding: 0 8px;
}
.button-grey-light {
margin-left: 4px;
color: #4E5665;
text-shadow: 0 1px 0 #FFF;
background: #F6F7F8;
background-image: linear-gradient(top bottom,#ffffff,#f6f7f8);
-webkit-background-clip: padding-box;
background-clip: padding-box;
border: 1px solid;
-webkit-border-radius: 2px;
border-radius: 2px;
-moz-border-radius: 2px;
-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
-moz-box-shadow: 0 1px 1px rgba(0,0,0,.05);
-webkit-box-sizing: content-box;
box-sizing: content-box;
-moz-box-sizing: content-box;
-webkit-font-smoothing: antialiased;
line-height: 22px;
font-weight: 700;
font-size: 12px;
position: relative;
text-align: center;
vertical-align: middle;
cursor: pointer;
display: inline-block;
text-decoration: none;
white-space: nowrap;
border-color: #CDCED0 #C5C6C8 #B6B7B9!important;
padding: 0 8px;
}
.button-grey {
color: #333;
font-weight: bold;
text-decoration: none;
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
border: 1px solid #999;
border-bottom-color: #888;
background: #EEE;
background: -webkit-gradient(linear, 0 0, 0 100%, from(#F5F6F6), to(#E4E4E3));
background: -moz-linear-gradient(#f5f6f6, #e4e4e3);
background: -o-linear-gradient(#f5f6f6, #e4e4e3);
background: linear-gradient(#F5F6F6, #E4E4E3);
}
.button-grey:active {
background: #ddd;
border-bottom-color:#999;

box-shadow: none;
-webkit-box-shadow: none;
-moz-box-shadow: none;
}
/***
Icons
*******/
.ossn-icons-topbar-messages,
.ossn-icons-topbar-notification,
.ossn-icons-topbar-friends,
.ossn-icons-topbar-friends-new,
.ossn-icons-topbar-messages-new,
.ossn-icons-topbar-notifications-new{
background: url('<?php echo ossn_theme_url(); ?>images/icons/topbar.png') no-repeat;
}
.ossn-icons-topbar-messages{
background-position: 0 -50px ;
width: 21px;
height: 19px;
}
.ossn-icons-topbar-notification{
background-position: 0 -25px ;
width: 19px;
height: 20px;
}
.ossn-icons-topbar-friends {
background-position: 0 0;
width: 22px;
height: 19px;
}

.ossn-icons-topbar-friends-new{
background-position: 0 -76px ;
width: 22px;
height: 19px;
}

.ossn-icons-topbar-messages-new{
background-position: 0 -127px ;
width: 21px;
height: 19px;
}

.ossn-icons-topbar-notifications-new{
background-position: 0 -103px ;
width: 19px;
height: 20px;
}
.ossn-icon {
width:22px;
}
.ossn-icons-topbar {
position: absolute;
margin-top: 3px;
}
.ossn-loading {
background:url('<?php echo ossn_theme_url(); ?>images/loading.gif') no-repeat;
height:24px;
width:24px;
}
.ossn-box-loading {
margin-left: 216px;
margin-top: 37px;
}
.ossn-wall-friend {
background:url('<?php echo ossn_theme_url(); ?>images/icons/wall/friend.png') no-repeat;
width:20px;
height:17px;
}
.ossn-wall-status {
background:url('<?php echo ossn_theme_url(); ?>images/icons/wall/status.png') no-repeat;
width:16px;
height:16px;
}
.ossn-wall-location {
background:url('<?php echo ossn_theme_url(); ?>images/icons/wall/location.png') no-repeat;
width:20px;
height:17px;
}
.ossn-wall-photo {
background:url('<?php echo ossn_theme_url(); ?>images/icons/wall/photo.png') no-repeat;
width:17px;
height:17px;
}
.ossn-icon-access-friends {
background:url('<?php echo ossn_theme_url(); ?>images/icons/access/friends.png') no-repeat;
width:12px;
height:12px;
}
.ossn-icon-access-public {
background:url('<?php echo ossn_theme_url(); ?>images/icons/access/public.png') no-repeat;
width:12px;
height:13px;
}
.ossn-icon-access-private {
background:url('<?php echo ossn_theme_url(); ?>images/icons/access/private.png') no-repeat;
width:10px;
height:12px;
}
.ossn-inline-table {
display:inline-table;
}
/**************
Menu
***************/
.ossn-menu-newsfeed {
margin-top:10px;
}
.ossn-menu-section-name {
color: #999;
font-size: 13px;
font-weight: bold;
margin-bottom: 3px;
}
.ossn-menu-newsfeed .title {
font-size:11px;
color:#999;
font-weight:bold;
margin-left:3px;
margin-bottom:2px;
}
.ossn-menu-newsfeed li{
display:block;
line-height: 24px;
}
.ossn-menu-newsfeed li img {
position: absolute;
padding: 4px;
}
.ossn-menu-newsfeed li a{
color:#141823;
font-size:12px;
}
.ossn-menu-newsfeed li .text {
margin-left: 25px;
text-overflow: ellipsis;
overflow: hidden;
width: 132px;
white-space: nowrap;
}
.ossn-menu-newsfeed li:hover{
background:#DDDEE0;
}


.ossn-menu-search {
margin-top:-5px;
}
.ossn-menu-search .title {
font-size:11px;
color:#999;
font-weight:bold;
margin-left:3px;
margin-bottom:2px;
}
.ossn-menu-search li{
display:block;
line-height: 24px;
}
.ossn-menu-search li img {
position: absolute;
padding: 4px;
}
.ossn-menu-search li a{
color:#141823;
font-size:12px;
}
.ossn-menu-search li .text {
margin-left: 25px;
}
.ossn-menu-search li:hover{
background:#DDDEE0;
}


/**************
Profile
Menu hr
************************/
.profile-hr-menu {
margin-top: 32px;
margin-left: 205px;
position: absolute;
}
.profile-hr-menu .first-item {
border-left: 1px solid #EEE;
}
#profile-hr-menu {
border: none;
border: 0px;
padding: 0px;
font-size: 14px;
font-weight: bold;
width: auto;
}
#profile-hr-menu ul {
background: #fff;
height: 35px;
list-style: none;
margin: 0;
padding: 0;
}
#profile-hr-menu li {
float: left;
padding: 0px;

border-right: 1px solid #EEE;
}
#profile-hr-menu li a {
background: #fff;
display: block;
font-weight: normal;
line-height: 45px;
margin: 0px;
padding: 0px 20px;
text-align: center;
text-decoration: none;
}
#profile-hr-menu > ul > li > a {
color: #2F4979;
font-weight:bold;
height: 44px;
}
#profile-hr-menu ul ul a {
color: #2F4979;
}
#profile-hr-menu li > a:hover,
#profile-hr-menu ul li:hover > a {
background: #F6F7F8;
text-decoration: none;
}
#profile-hr-menu li ul {
background: #fff;
display: none;
height: auto;
padding: 0px;
margin: 0px;
position: absolute;
width: 120px;
z-index: 200;

border-left: 1px solid #EEE;
border-bottom: 1px solid #EEE;
border-right: 1px solid #EEE;

}
#profile-hr-menu li:hover ul {
display: block;
}
#profile-hr-menu li li {
display: block;
float: none;
margin: 0px;
padding: 0px;
width: 120px;
}
#profile-hr-menu li:hover li a {
background: none;
}
#profile-hr-menu li ul a {
display: block;
height: 35px;
font-size: 12px;
font-style: normal;
margin: 0px;
padding: 0px 10px 0px 15px;
text-align: left;
}
#profile-hr-menu li ul a:hover,
#profile-hr-menu li ul li:hover > a {
background: #F6F7F8;
border: 0px;
text-decoration: none;
}
#profile-hr-menu p {
clear: left;
}
/** Ossn Ads ***/

.ossn-ads {
margin-top: -10px;
}
.ossn-ads h4{
color:#999;
}
.ossn-ads .a-heading{
font-weight:bold;
font-size:14px;
}
.ossn-ads .descript,
.ossn-ads img {
display:inline-table;
}
.ossn-ads img {
width:100px;
}
.ossn-ads .descript {
width: 126px;
vertical-align: top;
}
.ossn-ads-link {
font-size: 12px;
margin-bottom: 5px;
}
.ossn-ads-item {
margin-top:5px;
border-bottom: 1px solid #eee;
padding-bottom: 5px;
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
}
.comment-container input[readonly='readonly'] {
background:#eee;
}
.ossn-all-comments {
padding: 4px;
margin-left: 5px
}
.ossn-all-comments a{
font-size:12px;
}
hr {
background: #D9D9D9;
border-width: 0;
color: #D9D9D9;
height: 1px;
}
.ossn-privacy  {
margin-top:20px;
margin-top: 20px;
border-top: 1px solid #ddd;
padding-top: 10px;
}
.ossn-privacy span {
display:inline-block;
color:#333;
position:absolute;
margin-top:-2px;
font-size:13px;
font-weight:bold;

margin-left:4px;
margin-top:4px;
}
.ossn-privacy p {
font-size: 12px;
margin-top: 1px;
}

.ossn-viewer {
width:940px;
margin:0 auto;
position:relative;
}
.ossn-viewer .ossn-container {
height: 200px;
position: fixed;
width: 900px;
z-index: 10000;
margin-top: 70px;
min-height:515px;
}
.ossn-viewer-loding {
font-size:15px;
}
.ossn-viewer .ossn-container .close-viewer {
float:right;
cursor: pointer;
margin-right: 5px;
font-weight: bold;
font-size: 13px;
color: #ccc;
}
.ossn-container tbody{
background: #000;
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

.ossn-viewer .info-block {
background:#fff;
height:100%;
width:325px;
float:right;
margin-left: -3px;
}
.image-block img {
max-width:700px;
}
.ossn-topbar .inner {
width:990px;
margin:5px auto;
}
.ossn-topbar .inner li {
display:inline-table;
}
.ossn-topbar .inner .logo-second,
.ossn-topbar .inner .ossn-search,
.ossn-topbar .inner .ossn-topbar-menu,
.ossn-icons-topbar {
display:inline-block;
}


.ossn-search input {
padding: 6px;
border: none;
border-radius: 5px;
color: #000;
font-weight: bold;
width: 450px;
float:right;
display:inline-table;
height:16px;

}
.ossn-search {
width: 469px;
margin-top: 1px;
position: absolute;
display:inline-table;
}
.ossn-topbar-menu {
float:right;
padding: 6px;
}
.ossn-topbar-menu li a{
font-family: 'Helvetica Neue', Helvetica, Arial, 'lucida grande',tahoma,verdana,arial,sans-serif;
color:#fff;
text-shadow: 0 -1px rgba(0, 0, 0, 0.5);
font-size: 12px;
height: 22px;
font-weight:bold;
line-height: 22px;
}
.ossn-topbar-menu img {
float:left;
margin-left:2px;
}
.ossn-topbar-menu span {
margin-left: 10px;
margin-right:20px;
}
.ossn-topbar-dropdown-menu {
display: block;
display: inline-block;
margin: 0px 3px;
position: relative;
width: 46px;
}
.ossn-topbar-dropdown-menu .ossn-topbar-dropdown-menu-button {
cursor: pointer;
width: auto;
padding: 4px 5px;

font-weight: bold;
color: #717780;
line-height: 16px;
text-decoration: none !important;
}

.ossn-topbar-dropdown-menu .ossn-topbar-dropdown-menu-button .arrow {
display: inline-block;
border-top: 5px solid #999;
border-right: 5px solid transparent;
border-left: 5px solid transparent;
}

.ossn-topbar-dropdown-menu .ossn-topbar-dropdown-menu-content {
position: absolute;
border: 1px solid #777;
padding: 0px;
background: white;
margin: 0;
display: none;
}

.ossn-topbar-dropdown-menu .ossn-topbar-dropdown-menu-content li {
list-style: none;
margin-left: 0px;
line-height: 16px;
border-top: 1px solid #FFF;
border-bottom: 1px solid #FFF;
margin-top: 2px;
margin-bottom: 2px;
}

.ossn-topbar-dropdown-menu .ossn-topbar-dropdown-menu-content li:hover {
border-top-color: #ccc;
border-bottom-color: #ccc;
background: #999;
width:100%;
}

.ossn-topbar-dropdown-menu .ossn-topbar-dropdown-menu-content li a {
display: block;
padding: 2px 7px;
padding-right: 15px;
color: black;
text-decoration: none !important;
white-space: nowrap;
font-weight: normal;
text-shadow:none;
}

.ossn-topbar-dropdown-menu .ossn-topbar-dropdown-menu-content li:hover a {
color: white;
text-decoration: none !important;
}

.ossn-topbar-dropdown-menu input[type="checkbox"]:checked ~ .ossn-topbar-dropdown-menu-content { display: block }

.ossn-topbar-dropdown-menu input[type="checkbox"] { display: none }
.ossn-light {
opacity:0.4;
}
.ossn-message-box {
min-width:470px;
min-height:96px;
background:#fff;
border:1px solid #999;

position:fixed;
top: 0px;
left: 50%;
margin-left: -200px;
z-index: 60000;
margin-top:100px;
border-radius:3px;


display:none;

box-shadow: 0 2px 26px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(0, 0, 0, 0.1);
}
.ossn-message-box .close-box {
float:right;
color: #ccc;
cursor:pointer;
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
.ossn-message-box .contents{
padding:10px;
min-height:150px;
}
.ossn-message-box .control {
margin-left:10px;
margin-right:10px;
height:30px;
padding:10px;
border-top:1px solid #E9EAED;
}
.ossn-message-box .control .controls{
float:right;
}
.ossn-message-box .contents input[type='text']{
border: 1px solid #EEE;
width: 292px;
padding: 7px;
}
.ossn-message-box .contents input[type='text'],
.ossn-message-box .contents label{
display:inline-table;
}
.ossn-message-box .contents label{
color: #666;
font-weight: bold;
font-size: 13px;
margin-right: 13px;
}
.ossn-hidden {
display:none;
}

.ossn-notifications-box {
display:none;
float: right;
width: 430px;
height:540px;
background: #fff;
margin-right: 208px;
margin-top: 6px;

-webkit-box-shadow: 0 3px 8px rgba(0, 0, 0, .25);
-webkit-border-radius: 3px;
border: 1px solid rgba(100, 100, 100, .4);

position: absolute;
margin-left: 528px;
}
.ossn-notifications-box .type-name{
font-size: 12px;
font-weight: bold;
padding: 9px;
border-bottom: 1px solid #DDDDDD;
}
.ossn-notifications-box li {
min-height:50px;
}
.ossn-notifications-box .messages-inner{
overflow: hidden;
overflow-y: scroll;
position: relative;
width: 430px;
height: 465px;
background:#fff;
-moz-box-shadow: 1px 6px 6px -5px #ddd;
-webkit-box-shadow: 1px 6px 6px -5px #ddd;
box-shadow: 1px 6px 6px -5px #ddd;
}
.ossn-notifications-box .notification-image {
display: inline-block;
height:50px;
width:50px;
}
.ossn-notifications-box .notfi-meta {
display: inline-block;
margin-top: 6px;
position: absolute;
width: 346px;
margin-left: 8px;
font-size: 12px;
}
.ossn-notifications-box .bottom-all {
background:#F7F7F7;
text-align:center;
padding: 14px;
}
.ossn-notifications-box .bottom-all a{
font-weight:bold;
}
.ossn-notifications-box .selected {
width: 0;
height: 0;
border-left: 10px solid transparent;
border-right: 10px solid transparent;

border-bottom: 10px solid #fff;
float: right;

margin-top: -8px;
margin-right: 9px;
}
.ossn-notifications-box .notifications {
margin-top: -8px;
margin-right: 30px;
}

.ossn-notifications-box .messages {
margin-top: -8px;
margin-right: 60px;
}
.ossn-notifications-box  .firends {
margin-right:95px;
}
.ossn-notification-box-loading {
margin-left: 220px;
margin-top: 17px;
position: absolute;
}
.ossn-edit-form input[type='text'],
.ossn-edit-form input[type='password'],
.ossn-edit-form textarea {
padding: 8px;
border: 1px solid #c4c4c4;
height: 26px;
min-width: 300px;
background: #FDFDFD;
border-radius: 2px;
display:block;

-webkit-transition: all 0.30s ease-in-out;
-moz-transition: all 0.30s ease-in-out;
-ms-transition: all 0.30s ease-in-out;
-o-transition: all 0.30s ease-in-out;

border:1px solid #eee;
}
.ossn-edit-form textarea {
height:100px;
max-width:300px;
}
.ossn-edit-form input[type='password']:focus,
.ossn-edit-form input[type='text']:focus {
box-shadow: 0 0 5px #ccc;
border: 1px solid #ccc;
}
.ossn-edit-form select {
padding:6px;
display:block;
margin-bottom:10px;
}
.ossn-edit-form input {
margin-bottom: 10px;
}
.ossn-edit-form label {
padding: 3px 4px;
margin-bottom: 3px;
color: #406479;
display: block;
font-weight: bold;
}
.groups-inline select {
display:inline-block;
}
/** Template view and list **/

.ossn-view-users {
height:100px;
width:400px;
border:1px solid #E9EAED;
display:inline-block;
margin-left:5px;
margin-bottom:10px;
}
.ossn-view-users img,
.ossn-view-users .uinfo{
display:inline-block;
}
.ossn-view-users .uinfo .userlink{
font-size: 14px;
font-weight: bold;
position: absolute;
margin-top: -68px;
margin-left: 12px;
}
.ossn-view-users .friendlink{
float: right;
margin-top: 60x;
margin-right: 9px;
}
.ossn-list-users {
height:60px;
border-bottom:1px solid #E9EAED;
display:block;
margin-left:5px;
margin-bottom:10px;
}
.ossn-list-users img,
.ossn-list-users .uinfo{
display:inline-block;
}
.ossn-list-users .uinfo .userlink{
font-size: 14px;
font-weight: bold;
float:right;
margin-top: -38px;
margin-left: 12px;
}
.ossn-list-users .friendlink{
float: right;
margin-top: 10px;
margin-right: 9px;
}
/** System Messages ***/
.ossn-system-messages {
position: fixed;
width: 100%;
z-index: 3;
margin-top: -8px;
}
.ossn-system-messages a {
	display:none;
}
.alert-danger,
.ossn-message-error {
background: #FAE7E7;
height: 25px;
border-bottom: 1px solid #CCBABA;
padding: 13px;
color: #F53333;
font-size: 13px;
}
.alert-success,
.ossn-message-success {
background: #E7EDFA;
height: 25px;
border-bottom: 1px solid #C7CEDF;
padding: 13px;
color: #7387B1;
font-size: 13px;
}
/** Profile Widgets ***/
.ossn-profile-module-item{
border:1px solid #D3D6DB;
border-radius:3px;
background:#fff;
min-height:100px;
width: 310px;
margin-bottom: 15px;
}
.ossn-profile-module-item .module-title{
color: #6A7480;
background: #F6F7F8;
padding: 11px;
border-radius: 4px;
font-weight: bold;
font-size: 12px;
border-bottom: 1px solid #E6E7E7;
}
/** Pagination ***/
.ossn-pagination {
background:#F7F7F7;

text-align: center;
border:1px solid #BBBBBB;

padding: 0;
}
.ossn-pagination li{
display:inline-block;
}
.ossn-pagination a{
	font-size:12px;	
	padding: 10px;
    display:block;
}
.ossn-pagination .active {
border-bottom: 2px solid #2B5470;
}
/** Footer **/
.ossn-footer {
width: 990px;
margin: 0 auto;
padding-bottom: 30px;
}
.ossn-footer-inner {
color: #969696;
margin-top: 15px;
margin-bottom: 20px;
border-top: 1px solid #C5C5C5;
line-height: 30px;

font-size:12px;

}
.ossn-footer-inner a{
color:#969696;
font-size:12px;
}
.ossn-footer-menu {
float:right;
}
.ossn-footer-copyrights {
float:left;
}
.ossn-footer-menu a {
display:inline-block;
margin-right: 8px;
}
.ossn-footer-menu a:hover {
text-decoration:underline;
}
/** Error Page **/
.ossn-error-page {
text-align:center;
min-height:400px;
margin-top:20%;
}
.ossn-error-page .error-heading {
font-size: 115px;
color: #707070;
text-shadow: 4px 4px 2px #eee;
}
.ossn-error-page .error-text {
font-size: 17px;
}
/** Ossn Layout NewsFeed and Media**/
.ossn-layout-newsfeed {
width: 970px;
margin: 0 auto;
}
.ossn-layout-newsfeed .coloum-left {
width: 160px;
float:left;
display: inline-table;
vertical-align: top;
}
.ossn-layout-newsfeed .coloum-middle {
width: 525px;
display: inline-table;
margin-left: 6px;
margin-right: 6px;
}
.ossn-layout-newsfeed .coloum-right {
width: 254px;
display: inline-table;

background: #FFF;
border: 1px solid;
border-color: #E5E6E9 #DFE0E4 #D0D1D5;
-webkit-border-radius: 3px;
vertical-align: top;
}
.ossn-layout-newsfeed .ossn-inner {
width: 970px;
}
.ossn-layout-media {
width: 990px;
margin: 0 auto;
}
.ossn-layout-media .content{
display:inline-table;
width:736px;
}
.ossn-layout-media .sidebar {
display:inline-table;
width:235px;
margin-left:11px;
float:right;
}
/** Layout module **/

.ossn-layout-module {
border: 1px solid #D3D6DB;
background:#fff;
min-height:300px;
margin-top:20px;
border-radius:3px;
}
.ossn-layout-module .module-title {
background:#F6F7F8;
padding: 18px;
border-bottom: 1px solid #D3D6DB;
}
.ossn-layout-module .module-title .controls{
float:right;
display: inline-table;
vertical-align: top;
}
.ossn-layout-module .module-contents {
padding:10px;
}
.ossn-layout-module .module-title .title{
font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
font-size: 20px;
font-weight: bold;
line-height: 1;
color: #2B5470;
display: inline-table;
}
.ossn-ajax-error {
font-size: 15px;
text-align: center;
}
.ossn-reset-login {
padding: 50px;
width: 400px;
margin: 0 auto;
}
.ossn-reset-login .reset-notice {
font-size: 14px;
}
.ossn-reset-login input[type='text'] {
width: 290px;
}
