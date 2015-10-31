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
.ossn-wall-container {
	width: 526px;
	background: #FFF;
	border: 1px solid;
	border-color: #E5E6E9 #DFE0E4 #D0D1D5;
	-webkit-border-radius: 3px;
}

.ossn-wall-container .controls {
	background-color: #F6F7F8;
	border-top: 1px solid #E9EAED;
	height: 40px;
	width: 100%;
	margin-top: 3px;
}

.ossn-wall-container .wall-tabs {
	width: 500px;
	border-bottom: 1px solid #E5E5E5;
	height: 26px;
}

.ossn-wall-container .wall-tabs .item {
	margin-top: 5px;
}

.ossn-wall-container .wall-tabs .item div {
	display: inline-block;
}

.ossn-wall-container .wall-tabs .item .text {
	font-weight: bold;
	margin-top: 1px;
	margin-left: 5px;
	position: absolute;
	font-size: 12px;
}

.tabs-input {
	margin: 0 12px;
	padding: 4px 0 2px;
}

.ossn-wall-container textarea {
	resize: none;
	padding-top: 20px;
	width: 500px;
	font-family: inherit;
}

.activity-item {
	background: #FFF;
	border: 1px solid;
	border-color: #E5E6E9 #DFE0E4 #D0D1D5;
	-webkit-border-radius: 3px;
	margin-bottom: 27px;
	border-bottom: 1px;
	width: 526px;
}

.user-activity {
	margin-top: 10px;
}

.activity-item-container {
	width: 490px;
	padding: 12px;
}

.activity-item-container .owner {
	display: inline-block;
	float: left;
}

.activity-item-container .friends {
	color: #ccc;
	display: initial;
}

.activity-item-container .subject {
	display: inline-block;
	margin-left: 6px;
	margin-top: 3px;
	font-size: 14px;
}

.owner-link {
	font-weight: bold;
}

.activity-item-container .time {
	font-size: 12px;
	color: #757575;
}

.activity-item-container .description .post-text {
	font-size: 14px;
	margin-top: 10px;
	width: 500px;
	line-height: 20px;
	word-wrap: break-word;
}

.activity-item-container .description img {
	margin-top: 5px;
	max-width: 500px;
}

.controls li {
	padding: 11px;
	display: inline-block;
	cursor: pointer;
}

.controls li:hover {
	background: #eee;
}

.ossn-button-submit-b {
	cursor: pointer;
	border: 1px solid #3d5e74;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	font-size: 12px;
	font-family: arial, helvetica, sans-serif;
	padding: 8px 8px 8px 8px;
	text-decoration: none;
	display: inline-block;
	text-shadow: -1px -1px 0 rgba(0,0,0,0.3);
	font-weight: bold;
	color: #FFFFFF;
	background-color: #507C99;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#507C99), to(#3C5D73));
	background-image: -webkit-linear-gradient(top, #507C99, #3C5D73);
	background-image: -moz-linear-gradient(top, #507C99, #3C5D73);
	background-image: -ms-linear-gradient(top, #507C99, #3C5D73);
	background-image: -o-linear-gradient(top, #507C99, #3C5D73);
	background-image: linear-gradient(to bottom, #507C99, #3C5D73);
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#507C99, endColorstr=#3C5D73);
}

.ossn-button-submit-b:hover {
	border: 1px solid #2d4656;
	background-color: #38586B;
	background-image: -webkit-gradient(linear, left top, left bottom, from(#38586B), to(#2F495A));
	background-image: -webkit-linear-gradient(top, #38586B, #2F495A);
	background-image: -moz-linear-gradient(top, #38586B, #2F495A);
	background-image: -ms-linear-gradient(top, #38586B, #2F495A);
	background-image: -o-linear-gradient(top, #38586B, #2F495A);
	background-image: linear-gradient(to bottom, #38586B, #2F495A);
	filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#38586B, endColorstr=#2F495A);
}

.ossn-wall-post {
	min-width: 62px;
	padding: 5px;
	margin-top: 7px;
	margin-right: 6px;
}

.ossn-wall-container input[type="text"] {
	width: 100%;
	border-top: 1px dashed #EEE;
	padding: 3px;
}

.ossn-posted-on {
	width: 0;
	height: 0;
	border-top: 5px solid transparent;
	border-bottom: 5px solid transparent;
	border-left: 5px solid #ccc;
}

.ossn-wall-on {
	display: inline-block;
	margin-left: 7px;
	margin-right: 7px;
}

#ossn-wall-friend input {
	border: none;
}
/** Token Input **/

ul.token-input-list {
	overflow: hidden;
	height: auto !important;
	height: 1%;
	width: 100%;
	cursor: text;
	font-size: 12px;
	font-family: Verdana;
	min-height: 1px;
	z-index: 999;
	margin: 0;
	padding: 0;
	background-color: #fff;
	list-style-type: none;
	clear: left;
	color: #2B5470;
	font-wight: bold;
	border-top: 1px dashed #EEE;
 /** $arsalan.shah **/;
}

li.token-input-token {
	overflow: hidden;
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
	float: left;
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
	font-family: Verdana;
	z-index: 1;
}

div.token-input-dropdown p {
	margin: 0;
	padding: 5px;
	color: ;
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

.post-controls {
	float: right;
	cursor: pointer;
	margin-top: 5px;
}

.ossn-wall-post-controls {
	background: #fff;
	position: absolute;
}

.drop-down-arrow {
	border-top: 5px solid #B9B9B9;
	border-right: 5px solid transparent;
	border-left: 5px solid transparent;
	width: 2px;
}

.ossn-wall-post-controls .post-menu {
}

.ossn-wall-post-controls .post-menu .menu-links {
	border: 1px solid #ccc;
	border-top: 1px solid #fff;
	width: 200px;
	margin-left: -183px;
	margin-top: 5px;
	background: #fff;
	box-shadow: 0px 1px 5px #888888;
	display: none;
}

.ossn-wall-post-controls .menu-links li {
	display: block;
}

.ossn-wall-post-controls .menu-links li:hover {
	border-top-color: #668EA8;
	border-bottom-color: #668EA8;
	background: #668EA8;
	color: #fff;
}

.ossn-wall-post-controls .menu-links li:hover a {
	color: #fff;
}

.ossn-wall-post-controls .menu-links a {
	color: #000;
	width: 185px;
	display: block;
	padding: 8px;
}

.ossn-wall-post-controls .menu-links a:hover {
	color: #fff;
}

.ossn-wall-privacy-lock {
	background: url("<?php echo ossn_site_url("components/OssnWall/images/privacy.png"); ?>") no-repeat;
	width: 14px;
	height: 18px;
    display: inline-block;
    float:left;
}

.ossn-wall-privacy {
	float:right;
    margin-right: 5px;
}

.ossn-wall-privacy span {
	margin-left: 10px;
	margin-top: 2px;
	font-weight: bold;
	color: #999;
}

.ossn-user-wall-privacy {

}
.ossn-wall-item-type {
	display: inline-block;
	color: #ACACAC;
}
.menu-likes-comments-share a:after {
    padding: 5px;
    content: "-";
}
.menu-likes-comments-share a:last-child:after {
    content: "";
}
