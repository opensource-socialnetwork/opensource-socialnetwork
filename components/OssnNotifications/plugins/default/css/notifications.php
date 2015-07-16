/**
 * Open Source Social Network
 * 
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence 
 */
.ossn-notifications-all li{
padding: 10px;
border-bottom: 1px solid #ddd;
display: block !important;

min-height: 15px;
}
.ossn-notifications-all li:hover{
background:#F6F7F8;
}
.ossn-notification-icon-comment {
background:url('<?php echo ossn_site_url("components/OssnNotifications/images/comment.png"); ?>');
width:18px;
height:18px;
position:absolute;
}

.ossn-notification-icon-tag {
background:url('<?php echo ossn_site_url("components/OssnNotifications/images/post.png"); ?>');
width:18px;
height:18px;
position:absolute;
}
.ossn-notification-icon-like {
background:url('<?php echo ossn_site_url("components/OssnNotifications/images/like.png"); ?>');
width:18px;
height:18px;
position:absolute;
}
.ossn-notification-icon-like-post {
background:url('<?php echo ossn_site_url("components/OssnNotifications/images/like.png"); ?>');
width:18px;
height:18px;
position:absolute;
}
.ossn-notifications-all .data{
position: absolute;
margin-left: 23px;
margin-top: 1px;
}
.friends-added-text {
margin-right:10px;
}
.ossn-notification-unviewed {
background:#EEEEEE;
}
.ossn-no-notification {
padding: 21px;
text-align: center;
font-size: 12px;
font-weight: bold;
color:#ccc;
}

.notification-friends li{
display:block !important;
border-bottom: 1px solid #eee;
}
notification-friends .user{
font-size: 13px;
font-weight: bold;
}
.notification-friends .image {
width:50px;
height:50px;
display:inline-table;
}
.ossn-notifications-friends-inner {
padding: 6px;
}
.ossn-notifications-friends-inner form{
display:inline-table;
}
.ossn-notification-page li img {
display:none;
}
.ossn-notif-hide {
display:none;
}    
.ossn-notification-mark-read {
  float: right;
  font-weight: normal;
}
.ossn-notification-mark-read:hover {
	text-decoration:underline;
}