/**** <style> ******/
/*******************************
	Profile
********************************/
.ossn-profile .top-container {
	background: #fff;
	border: 1px solid #C4CDE0;
	border-width: 1px 1px 2px;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
}

.ossn-profile-usermetadata {
	position: relative;
	min-height: 85px;
	padding-bottom: 10px;
	border-bottom: 1px solid #eee;
}

.profile-hr-menu {
	border-bottom: 1px solid #eee;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}

.ossn-profile .top-container .profile-cover {
	height: 300px;
	overflow: hidden;
	opacity: .99;
	background: -moz-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 1%, rgba(0, 0, 0, .38) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)), color-stop(1%, rgba(0, 0, 0, 0)), color-stop(100%, rgba(0, 0, 0, .38)));
	background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 1%, rgba(0, 0, 0, .38) 100%);
	background: -o-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 1%, rgba(0, 0, 0, .38) 100%);
	background: -ms-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 1%, rgba(0, 0, 0, .38) 100%);
	background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, 0) 1%, rgba(0, 0, 0, .38) 100%);
	filter: progid: DXImageTransform.Microsoft.gradient(startColorstr='#00000000', endColorstr='#94000000', GradientType=0);
	position: relative;
}

.ossn-profile .top-container .profile-cover img {
	width: auto;
}

.ossn-profile-row {
	margin-bottom: 20px;
}

.profile-hr-menu ul {
	margin: 7px 0 5px;
	padding: 0px;
}

.profile-hr-menu ul li {
	display: inline-block;
}

.profile-hr-menu ul li a:not(.dropdown a) {
	display: block;
	padding: 15px;
	margin-right: 5px;
	font-weight: bold;
}

.profile-hr-menu a:hover {
	color: initial;
}

.profile-hr-menu>li>a:not(.profile-hr-menu .dropdown-toggle):hover,
.profile-hr-menu>ul>li:hover>a:not(.profile-hr-menu .dropdown-toggle) {
	background: #F6F7F8;
	text-decoration: none;
	border-radius: 10px;
}

.profile-hr-menu .dropdown-menu {
	margin-left: 0px;
}

.profile-hr-menu .dropdown-menu li {
	display: block;
	border-bottom: 0;
	padding: initial;
	margin: auto;
}

.profile-hr-menu .dropdown a i {
	margin-left: 5px;
}

.profile-hr-menu .dropdown-menu li a {
	border-right: 0px;
	margin-right: 0px;
}

.profile-hr-menu ul li:hover {}

.profile-hr-menu {
	border-bottom: 1px solid #eee;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}

.profile-hr-menu ul li:last-child {
	border-right: none;
}

.ossn-profile .profile-photo {
	position: absolute;
	margin-left: 20px;
	margin-top: -80px;
	background-color: #fff;
	border-radius: 50%;
	padding: 5px;
	width: 160px;
	height: 160px;
}

.ossn-profile .profile-photo img {
	border-radius: 50%;
	width: 150px;
	height: 150px;
}

.profile-menu-hr-container {
	background: #fff;
	border: 1px solid #C4CDE0;
	border-width: 1px 1px 2px;
	margin: 10px 0;
	border-radius: 5px;
}

.ossn-profile .user-fullname {
	color: #333334;
	font-weight: bold;
	max-width: 600px;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.ossn-profile-role {
	font-size: 15px !important;
}

.ossn-profile .user-username {
	font-size: 15px;
	font-weight: normal;
}

.btn-standalone-grey {
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
	text-decoration: none;
}

.btn-standalone-grey:active {
	background: #ddd;
	border-bottom-color: #999;
	box-shadow: none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
}

.btn-standalone-grey:hover {
	color: #333;
	text-decoration: none;
}

.profile-cover-controls {
	position: absolute;
	width: 100%;
	top: 0;
	margin-top: 20px;
	z-index: 1;
}

.profile-cover-controls a:before {
	font-family: 'Font Awesome 5 Free';
	display: inline-block;
	padding-right: 5px;
	vertical-align: middle;
	font-weight: 900;
}


.profile-cover-controls a {
	float: right;
	position: relative;
	margin-right: 10px;
}

.change-cover:before {
	content: "\f303";
}

.reposition-cover:before {
	content: "\f0b2";
	font-family: 'Font Awesome 5 Free';
}

.profile-menu {
	position: relative;
	margin-right: 20px;
}

#cover-menu {
	display: none;
}

.upload-photo {
	background: #eee;
	position: absolute;
	font-size: 15px;
	font-family: sans-serif;
	bottom: 0;
	right: 0;
	margin-bottom: 20px;
	width: 40px;
	height: 40px;
	border-radius: 50%;
}

.upload-photo span {
	text-align: center;
	display: block;
	margin-top: 5px;
	font-size: 20px;
	color: #000;
}

.user-cover-uploading {
	opacity: 0.4;
}

.user-photo-uploading {
	height: 100%;
	opacity: 0.8;
	background: #fff;
	width: 100%;
	position: absolute;
	border-radius: 50%;
	margin-bottom: 0;
	margin-left: -5px;
	margin-top: -5px;
}

.user-photo-uploading span {
	display: none;
}

.ossn-profile-bottom {
	margin-top: 10px;
}

.page-sidebar,
.ossn-profile-sidebar {}

.ossn-layout-media .content {
	margin-right: 10px;
	margin-left: 10px;
}

.ossn-profile-extra-menu {
	display: inline-block;
}

#ossn-home-signup .checkbox-block,
.ossn-profile-bottom .ossn-edit-form .checkbox-block {
	margin-top: 0;
	margin-bottom: 0;
}

@media (max-width: 480px) {
	.profile-hr-menu ul li {
		padding: 10px 0;
	}

	/******************************
    	Profile
    ********************************/
	.ossn-profile .profile-photo img {}

	.ossn-profile .user-fullname {
		width: auto;
		white-space: normal;
	}

	.ossn-profile .top-container .profile-cover {
		height: 188px;
	}

	.ossn-profile .profile-photo {
		position: relative;
		margin: -51px auto;
	}

	.ossn-profile-usermetadata {
		min-height: 230px;
	}

	.profile-menu {
		float: initial;
		text-align: center;
		margin: 10px 0;
	}

	.ossn-profile .top-container .profile-cover img {
		width: auto;
	}

	.upload-photo {
		margin-bottom: 0px;
		transform: scale(0.8);
	}

	.profile-hr-menu ul li {
		display: block;
		margin-right: 0px;
		margin-left: 10px;
	}

	.profile-hr-menu ul li a:not(.dropdown a) {
		margin-right: 0px;
		padding: 10px;
	}

	.ossn-profile-role {
		font-size: 15px !important;
		position: relative;
	}
}

@media only screen and (max-width: 992px) {
	.profile-menu {
		margin: 10px 0;
	}

	.ossn-profile .user-fullname {
		max-width: initial;
	}
}

@media only screen and (max-width: 1199px) {
	.ossn-profile .user-fullname {
		max-width: initial;
	}
}

@media only screen and (max-width: 767px) {
	.ossn-profile .user-fullname {
		max-width: initial;
	}

}

/**************************** End *****************/
.ossn-profile-module-friends img {
	padding: 1.5px;
}

.ossn-profile-module-friends .user-image {
	width: 100px;
	height: 100px;
	margin-bottom: 5px;
	display: inline-block;
}

.ossn-profile-module-friends .user-name {
	position: absolute;
	margin-top: -27px;
	margin-left: 8px;
	font-size: 12px;
	color: #fff;
	max-width: 90px;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}

.ossn-profile-module-friends h3 {
	padding: 4px;
	text-align: center;
	font-size: 16px;
	color: #ccc;
}

.ossn-profile-extra-menu {
	display: inline-block;
}

.ossn-profile-extra-menu .btn-action i {
	margin: 0 auto;
}

.ossn-profile .profile-cover img {
	position: relative;
}

.ossn-covers-uploading-annimation {
	float: right;
	background: rgba(255, 255, 255, 0.62);
	padding: 20px;
	border-radius: 20px;
	z-index: 1;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

.ossn-profile-bottom .ossn-edit-form .radio-block {
	margin-top: 0;
	margin-bottom: 0;
}

/** profile edit layout **/
.ossn-profile-edit-layout {
	background: #fff;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}

.profile-edit-tabs {}

.profile-edit-tabs a {
	padding: 12px 4px 12px 16px;
	display: block;
	border-left: 2px solid #fff;
	cursor: pointer;
	text-decoration: none;
}

.profile-edit-tab-item-active {
	border-left: 3px solid #5088a3 !important;
	font-weight: bold;
}

.profile-edit-tabs a {}

.profile-edit-layout-right {
	padding: 10px;
	border-left: 1px solid #eee;
}

.profile-edit-layout-title {
	background: #F9F7F7;
	border: 1px solid #eee;
	padding: 12px 20px;
	font-weight: bold;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
}

.profile-hr-menu .dropdown-toggle::after {
	display: none;
}