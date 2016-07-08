<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
*/
body {
	font-family: 'Roboto Slab', serif;
}
.logo {

}
.header {
	height:65px;
    color:#fff;
    background: #3D3D3D;
}
.header .container {
	  padding-top: 15px;
}
.header-dropdown {
	text-align:right;
}
.header-dropdown .navbar-right {
	margin-right:initial;
}
.header-dropdown a i{
	color:#fff;
  font-size: 30px;
  padding-top: 5px;
}
select,
input[type="password"],
input[type="text"],
textarea {
    color: #333;
    font-size: 13px;
    border: 1px solid #eee;
    border-radius: 2px;
    -webkit-border-radius: 2px;
    display:block;
    -moz-border-radius: 2px;
    -o-border-radius: 2px;
    outline: none;
    padding: 12px 14px;
    width:100%;
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
input[type="submit"] {
	display:inherit;
}
label {
	font-size: 16px;
	color: #000;
	font-weight: 300;
	cursor: pointer;
    display:block;
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
	margin-bottom:10px;
}
.topbar-menu li a i{
  margin-left: 5px;
  float: right;
}
.page-title {
  font-size: 20px;
  border-bottom: 1px solid #eee;
  padding-bottom: 10px;
  margin-bottom:10px;
  text-transform: uppercase;
}
.page-botton-notice {
  margin-top:10px;
}
.no-right-margins {
	margin-right:0px;
}
.ossn-form div:not('.ossn-editor') {
	margin-top:10px;
}
.margin-top-10 {
	margin-top:10px;
}
.margin-bottom-10 {
	margin-bottom:10px;
}
.right {
	float:right;
}
.left {
	float:left;
}
.text-right {
	text-align:right;
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
	display:block;
}
.inline-block {
	display:inline-block;
}
.admin-dashboard-item {
	margin-top:10px;
}
.admin-dashboard-fixed-height {
	height:230px;
}
.admin-dashboard-item canvas {
  padding: 14px;
}
.admin-dashboard-box {
	min-height:200px;
}
.admin-dashboard-title {
  background-color: #f8f8f8;
  border: 1px solid #e7e7e7;
  padding: 10px;
  font-weight: 700;
}
.admin-dashboard-contents .text {
  font-size: 40px;
  padding: 74px;
  color:#747474;
}
.admin-dashboard-contents {
  padding: 10px;
  border-bottom: 1px solid #e7e7e7;
  border-left: 1px solid #e7e7e7;
  border-right: 1px solid #e7e7e7;
  
  max-height:250px;
  margin-bottom: 15px; 
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
	text-align:center;
}
.charjs-legend .title {
    display: inline-block;
    margin-bottom: 0.5em;
    line-height: 1.2em;
	margin-left:10px;
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
	text-align:center;
}
.text-right {
	text-align:right;
}
.loading-version {
	background:url('<?php echo ossn_theme_url(); ?>images/loading.gif') no-repeat;
    width:24px;
    height:24px;
    margin: 0 auto;
}
.component-title-icon{
  font-size: 20px !important;
}
.component-title-check {
  color: #147B25;
}
.component-title-delete {
	color:#E70F0F;
}
.components-list-buttons a {
  margin-right: 10px;
}
.components-list-buttons a i{
  margin-right: 5px;
}
.radio-block {
	margin-top:10px;
    margin-bottom:10px;
}
.radio-block span {
	margin-left:5px;
    font-weight:bold;
}
.ui-datepicker-year,
.ui-datepicker-month {
    padding: 0px;
    display: inline-block;
}
