/***********************************
	Ossn Wall <style>
*************************************/

.ossn-wall {}

.ossn-wall-items {}

.ossn-wall-item {
	padding: 15px;
	padding-top: 10px;
	margin-top: 20px;
	background-color: #fff;
	padding-bottom: 0px;
	border-radius: 10px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
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

.ossn-wall-container .controls {
	background-color: #F6F7F8;
	margin-top: 5px;
	border: 1px solid #E9EAED;
	padding: 5px 10px;
	margin-left: -10px;
	margin-right: -10px;
	border-left: 0;
	border-right: 0;
}

.ossn-wall-container .wall-tabs {
	background-color: #F6F7F8;
	border: 1px solid #E9EAED;
	border-top-right-radius: 10px;
	border-top-left-radius: 10px;
}

.ossn-wall-container .wall-tabs .item {
	padding: 10px;
	display: inline-flex;
	cursor: pointer;
}

.ossn-wall-container .wall-tabs .item:hover {
	background: #eee;
}

.ossn-wall-container .wall-tabs .item:first-child {
	border-top-left-radius: 10px;
}

.ossn-wall-container .wall-tabs .item div {
	display: inline-block;
}

.ossn-wall-container .wall-tabs .item .text {
	font-weight: bold;
	margin-top: 1px;
	margin-left: 5px;
	position: absolute;


	font-size: 15px;
}

.ossn-wall-container .tabs-input {}

.ossn-wall-container .controls li {
	padding: 7px;
	background: #e5e5e5e0;
	display: inline-block;
	border-radius: 50%;
	cursor: pointer;
	width: 35px;
	height: 35px;
	text-align: center;
}

.ossn-wall-container .controls .ossn-wall-friend,
.ossn-wall-container .controls .ossn-wall-location,
.ossn-wall-container .controls .ossn-wall-photo,
.ossn-wall-container-control-menu-emojii-selector {
	color: #5d5d5d;
}

.ossn-wall-container .controls li:hover {
	background: #fff;
}

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