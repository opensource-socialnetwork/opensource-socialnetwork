<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
?>
/**
*    OpenSource-SocialNetwork
*
* @package   (Informatikon.com).ossn
* @author    OSSN Core Team
<info@opensource-socialnetwork.com>
* @copyright 2014 iNFORMATIKON TECHNOLOGIES
* @license   General Public Licence http://opensource-socialnetwork.com/licence
* @link      http://www.opensource-socialnetwork.com/licence
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
font-size: 13px;
font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
color: #333;
}
a {
color:#2B5470;
text-decoration:none;
}
.ossn-header {
background:linear-gradient(to bottom, #333, #000);
height:70px;
}
.logo-admin {
background:url('<?php echo ossn_site_url(); ?>themes/ossnblack/images/logo_admin.png') no-repeat;
height:57px;
width:187px;
}
.ossn-header .inner{
padding:10px;
width:985px;
margin:0 auto;
color:#fff;
}
.ossn-admin-topmenu {
background:#333;
height:40px;
}
.ossn-admin-button {
display: inline-block;
outline: none;
cursor: pointer;
text-align: center;
font-weight:bold;
text-decoration: none;
font: 14px;
padding: .5em 2em .55em;
text-shadow: 0 1px 1px rgba(0,0,0,.3);
-webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
box-shadow: 0 1px 2px rgba(0,0,0,.2);
}
.ossn-admin-button:hover {
text-decoration: none;
}
.ossn-admin-button:active {
position: relative;
top: 1px;
}

.button-orange {
color: #fef4e9;
border: solid 1px #da7c0c;
background: #f78d1d;
background: -webkit-gradient(linear, left top, left bottom, from(#faa51a), to(#f47a20));
background: -moz-linear-gradient(top,  #faa51a,  #f47a20);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#faa51a', endColorstr='#f47a20');
}
.button-orange:hover {
background: #f47c20;
background: -webkit-gradient(linear, left top, left bottom, from(#f88e11), to(#f06015));
background: -moz-linear-gradient(top,  #f88e11,  #f06015);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f88e11', endColorstr='#f06015');
}
.button-orange:active {
color: #fcd3a5;
background: -webkit-gradient(linear, left top, left bottom, from(#f47a20), to(#faa51a));
background: -moz-linear-gradient(top,  #f47a20,  #faa51a);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f47a20', endColorstr='#faa51a');
}

.button-white {
color: #606060;
border: solid 1px #b7b7b7;
background: #fff;
background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));
background: -moz-linear-gradient(top,  #fff,  #ededed);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
}
.button-white:hover {
background: #ededed;
background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#dcdcdc));
background: -moz-linear-gradient(top,  #fff,  #dcdcdc);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dcdcdc');
}
.button-white:active {
color: #999;
background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#fff));
background: -moz-linear-gradient(top,  #ededed,  #fff);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#ffffff');
}
.button-dark-blue {
color: #fff;
border: solid 1px #345162;
background: #406479;
background: -webkit-gradient(linear, left top, left bottom, from(#406479), to(#345162));
background: -moz-linear-gradient(top, #406479, #345162);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#406479', endColorstr='#345162');
}
.button-dark-blue:hover {
border: solid 1px #628092;
background: #628092;
background: -webkit-gradient(linear, left top, left bottom, from(#345162), to(#406479));
background: -moz-linear-gradient(top, #345162, #406479);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#345162', endColorstr='#406479');
}
.button-red {
color: #faddde;
border: solid 1px #980c10;
background: #d81b21;
background: -webkit-gradient(linear, left top, left bottom, from(#ed1c24), to(#aa1317));
background: -moz-linear-gradient(top,  #ed1c24,  #aa1317);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ed1c24', endColorstr='#aa1317');
}
.button-red:hover {
background: #b61318;
background: -webkit-gradient(linear, left top, left bottom, from(#c9151b), to(#a11115));
background: -moz-linear-gradient(top,  #c9151b,  #a11115);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#c9151b', endColorstr='#a11115');
}
.button-red:active {
color: #de898c;
background: -webkit-gradient(linear, left top, left bottom, from(#aa1317), to(#ed1c24));
background: -moz-linear-gradient(top,  #aa1317,  #ed1c24);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#aa1317', endColorstr='#ed1c24');
}

.button-blue {
color: #d9eef7;
border: solid 1px #0076a3;
background: #0095cd;
background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
background: -moz-linear-gradient(top,  #00adee,  #0078a5);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
}
.button-blue:hover {
background: #007ead;
background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
background: -moz-linear-gradient(top,  #0095cc,  #00678e);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
}
.button-blue:active {
color: #80bed6;
background: button--webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
background: -moz-linear-gradient(top,  #0078a5,  #00adee);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
}
.button-green {
color: #e8f0de;
border: solid 1px #538312;
background: #64991e;
background: -webkit-gradient(linear, left top, left bottom, from(#7db72f), to(#4e7d0e));
background: -moz-linear-gradient(top,  #7db72f,  #4e7d0e);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#7db72f', endColorstr='#4e7d0e');
}
.button-green:hover {
background: #538018;
background: -webkit-gradient(linear, left top, left bottom, from(#6b9d28), to(#436b0c));
background: -moz-linear-gradient(top,  #6b9d28,  #436b0c);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#6b9d28', endColorstr='#436b0c');
}
.button-green:active {
color: #a9c08c;
background: -webkit-gradient(linear, left top, left bottom, from(#4e7d0e), to(#7db72f));
background: -moz-linear-gradient(top,  #4e7d0e,  #7db72f);
filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#4e7d0e', endColorstr='#7db72f');
}
.ossn-com-install-notice {
margin-top: 12px;
background: #eee;
padding: 18px;
font-weight: bold;
border: 1px solid #ccc;
}
.ossn-admin-form input[type='text'],
.ossn-admin-form input[type='password'],
.ossn-admin-form textarea {
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
.ossn-admin-form textarea {
height:100px;
max-width:300px;
}
.ossn-admin-form input[type='password']:focus,
.ossn-admin-form input[type='text']:focus {
box-shadow: 0 0 5px #ccc;
border: 1px solid #ccc;
}
.ossn-admin-form select {
padding:6px;
display:block;
margin-bottom:10px;
}
.ossn-admin-form input {
margin-bottom: 10px;
}
.ossn-admin-form label {
padding: 3px 4px;
margin-bottom: 3px;
color: #406479;
display: block;
font-weight: bold;
}
.groups-inline select {
display:inline-block;
}
table {
max-width: 100%;
background-color: transparent;
border-collapse: collapse;
border-spacing: 0;
border: 1px solid #eee;

}
.table {
width: 100%;
margin-bottom: 18px;
}

.table th,
.table td {
padding: 10px;
line-height: 18px;
text-align: left;
vertical-align: top;
border-top: 1px solid #ddd;
}
.table th {
font-weight: bold;
}
.table caption + thead tr:first-child th,
.table caption + thead tr:first-child td,
.table colgroup + thead tr:first-child th,
.table colgroup + thead tr:first-child td,
.table thead:first-child tr:first-child th,
.table thead:first-child tr:first-child td {
border-top: 0;
}
.table tbody + tbody {
border-top: 2px solid #ddd;
}
.table .table {
background-color: #fff;
}
.table tbody > tr:nth-child(odd) > td,
.table tbody > tr:nth-child(odd) > th {
background-color: #f9f9f9;
}
.table-titles td {
font-weight:bold;
color:#406479;
background-image: linear-gradient(to bottom, #F8F8F8, #EBEBEB) !important;
}
.ossn-users-list .image {
width:32px;
height:32px;
padding-bottom: 7px;
}
.top-controls { float:left; margin-bottom:10px;margin-top:6px; }
.top-controls a{
margin-right:5px;
}
.user-search {
position:absolute;
}
.ossn-admin-login {
background: #f8f8f8;
width: 320px;
border-radius: 4px;
margin-left: auto;
margin-right: auto;
padding: 10px 20px;
box-shadow: 0px 1px 5px #999;

margin:0 auto;
}
.ossn-admin-login h3{
text-align:center;
}
.ossn-login-form {
wdith:250px;
margin:0 auto;
}
.ossn-admin-footer {
width:990px;
margin:0 auto;
border-top:2px solid #eee;

padding:10px;
margin-bottom:30px;
}
.ossn-admin-footer .powered{
float:right;
}
.ossn-admin-footer .copyrights {
float:left;
}
.ossn-admin-body {
min-height:500px;
}

.ossn-layout-admin {
width:990px;
margin:0 auto;
margin-top: 25px;
}
.ossn-layout-admin .sidebar {
display:inline-table;
width: 215px;
}
.ossn-layout-admin .contents {
width:760px;
display: inline-table;
}
.ossn-layout-admin .contents .title {
font-size: 20px;
font-weight: bold;
border-bottom: 1px solid;

color: #406479;
border-color: #406479;
}
.ossn-layout-admin .contents .content {
padding:10px;
}
.ossn-layout-admin-login {
width:990px;
margin:0 auto;
margin-top: 25px;
}
.ossn-layout-admin-login .contents {
float:right;
width:990px;
}
.ossn-message-error {
background-color: #f2dede;
border-color: #eed3d7;
border:1px solid;
border-radius:2px;

color: #b94a48;
padding: 20px;
}
.ossn-message-success {
background-color: #dff0d8;
border-color: #d6e9c6;
border:1px solid;
border-radius:2px;

color: #468847;
padding: 20px;

}


.ossn-admin-dsahboard .dashboard-block {
border: 1px solid #eee;
width: 215px;

-webkit-box-shadow: 0px 1px 1px #ccc;
-moz-box-shadow: 0px 1px 1px #ccc;
box-shadow: 0px 1px 1px #ccc;

display: inline-block;
margin-right: 27px;
margin-bottom:20px;
}
.ossn-admin-dsahboard
.dashboard-block
.dashboard-block-title
{
background: #F6F7F8;
padding: 10px;
font-weight: bold;
font-size: 14px;
text-align: center;
}
.ossn-admin-dsahboard
.dashboard-block
.dsahboard-block-contents
{
padding: 28px;
text-align: center;
font-size: 40px;

}

/*components and themes*/
.ossn-components-item {
border: 1px solid #eee;
padding: 10px;
min-height: 51px;
margin-bottom: 11px;
}
.ossn-components-item .component-name{
font-weight: bold;
font-size: 14px;
color: #406479;
}
.component-description {
margin-top: 6px;
font-size: 14px;

}
.component-controls {
float: right;
margin-top: -4px;
}
.component-controls a {
margin-right:5px;
}
.components-button {
border-left: 1px solid;
border-right: 1px solid;
border-bottom: 1px solid;
border-color: #eee;
padding: 7px;
color: #fff;
font-weight: bold;

-webkit-box-shadow: 0px 1px 1px #ccc;
-moz-box-shadow: 0px 1px 1px #ccc;
box-shadow: 0px 1px 1px #ccc;
}
.components-button-blue {
background: #6098B8;
}
.components-button-red {
background: #aa1317;
}
.components-button-green {
background: #00A59B;
}
.components-button-orange {
background:#F99315;
}
/*** Sidemenu ****/

.ossn-admin-sidemenu .title{
display: block;
margin-bottom: 4px;
font-size: 13px;
font-weight: bold;
line-height: 18px;
color: #999;
text-shadow: 0 1px 0 rgba(255,255,255,0.5);
text-transform: uppercase;
}
.ossn-admin-sidemenu .links li {
display:block;
}
.ossn-admin-sidemenu .links li:hover {
background:#EEEEEE;
cursor:pointer;
}
.ossn-admin-sidemenu .links li .icon{
width: 16px;
height: 16px;
}
.ossn-admin-sidemenu .links .inner-li .text,
.ossn-admin-sidemenu .links li .inner-li .icon{
display:inline-block;
}

.ossn-admin-sidemenu .links a{
font-size:14px;
color: #555;
text-shadow: 0 1px 0 rgba(255,255,255,0.5);
}
.ossn-admin-sidemenu .links {
margin-bottom: 10px
}
.ossn-admin-sidemenu .inner-li {
padding: 6px;
}
.ossn-admin-sidemenu .inner-li .text {
position: absolute;
margin-left: 5px;
}
/** Topbar menu ***/
.ossn-admin-menu-topbar {
width:985px;
margin: auto;
}

.ossn-admin-menu-topbar ul {
text-align: left;
display: inline;
margin: 0;
list-style: none;
margin-left: -41px;

}
.ossn-admin-menu-topbar ul a{
color:#fff;
}

.ossn-admin-menu-topbar ul li {
font: bold 12px/18px sans-serif;
display: inline-block;
margin-right: -4px;
position: relative;
padding: 11px 15px;
cursor: pointer;
-webkit-transition: all 0.2s;
-moz-transition: all 0.2s;
-ms-transition: all 0.2s;
-o-transition: all 0.2s;
background:#333;
transition: all 0.2s;
color: #FFF;
}
.ossn-admin-menu-topbar  ul li:hover {
background: #8B8B8B;
color: #fff;
}
.ossn-admin-menu-topbar  ul li ul {
padding: 0;
z-index: 1;
position: absolute;
top: 40px;
left: 40.5px;
width: 150px;
-webkit-box-shadow: none;
-moz-box-shadow: none;
box-shadow: none;
display: none;
opacity: 0;
visibility: hidden;
-webkit-transiton: opacity 0.2s;
-moz-transition: opacity 0.2s;
-ms-transition: opacity 0.2s;
-o-transition: opacity 0.2s;
-transition: opacity 0.2s;
}
.ossn-admin-menu-topbar  ul li ul li {
background: #333;
display: block;
color: #fff;
text-shadow: 0 -1px 0 #000;
}
.ossn-admin-menu-topbar  ul li ul li:hover {
background: #8B8B8B;
}
.ossn-admin-menu-topbar  ul li:hover ul {
display: block;
opacity: 1;
visibility: visible;
}
.ossn-admin-menu-topbar .right {
float:right;
}
/** Pagination ***/
.ossn-pagination {
background:#F7F7F7;

text-align: center;
border:1px solid #BBBBBB;
}
.ossn-pagination li{
display:inline-block;
padding: 10px;
}
.ossn-pagination a{
font-size:12px;
}
.ossn-pagination .selected {
border-bottom: 2px solid #2B5470;
}
