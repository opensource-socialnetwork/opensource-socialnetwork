/********* <style> ********/
.ossn-comment-menu {
	float: right;
	margin-left: 10px;
}

.comments-item:hover .ossn-comment-menu {
	display: block;
	margin-left: 10px;
}

.comments-likes {
	width: 100%;
}

.comments-list {
	background-color: #FBFBFB;
	margin-left: -15px;
	margin-right: -15px;
	padding-left: 10px;
	padding-right: 10px;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
}

.comments-list .comments-item {
	padding-top: 10px;
	padding-bottom: 5px;
}

.comments-list .comments-item:first-child {
	margin-top: 0px;
	padding-top: 10px;
}

.comments-list .comments-item:last-child {
	border-bottom: none;
}

.comments-list .comments-item .comment-user-img {
	display: inline-block;
	border-radius: 32px;
}


/** UI improvements comments #1524 **/

.comments-list .comments-item .comment-contents {
	display: inline-block;
	margin-top: -3px;
	background-color: #ebedf0;
	border-radius: 18px;
	width: auto;
	line-height: 16px;
	padding: 6px 12px 7px 12px;
}

.comment-container {
	position: relative;
	z-index: 0;
}

.comments-item .col-lg-11 {
	padding-left: 0px;
}

.comment-metadata .time-created,
.comment-metadata a {
	display: inline-block;
}

.comment-contents p {
	margin: 0px;
	word-break: break-word;
	text-align: left;
}

.comment-contents p img {
	display: block;
	margin-top: 10px;
	margin-bottom: 10px;
	max-width: 100%;
}

.comment-contents .owner-link {
	font-weight: bold;
	margin-right: 5px;
	font-size: 14px;
}

.comment-contents {
	width: 100%;
}

.comment-container span[readonly='readonly'],
.comment-container input[readonly='readonly'] {
	background: #eee;
}

.comments-item .comment-metadata {
	margin-top: 5px;
}

.comment-box {
	width: 100%;
	border: 1px solid #eee;
	padding: 6px 65px 6px 12px;
	margin-bottom: 5px;
	outline: none;
	display: block;
	resize: vertical;
	min-height: 32px;
	background-color: #f2f3f5;
	border: 1px solid #ccd0d5;
	border-radius: 15px;
	word-break: break-word;
	text-align: left;
}

.ossn-edit-comment:before {
	content: "\f303" !important;
}

.ossn-delete-comment:before {
	content: "\f2ed" !important;
}

.comment-metadata .dropdown-item {
	padding: 0.4rem 1rem;
}

@media (max-width: 480px) {}

@media only screen and (max-width: 992px) {}

@media only screen and (max-width: 1199px) {}

/********* comments theme code copied end *********/
.ossn-comment-attach-photo {
	width: 100%;
}

.ossn-comment-attach-photo .fa-camera {
	float: right;
	position: relative;
	margin-right: 5px;
	margin-top: 3px;
	width: 25px;
	height: 25px;
	padding: 5px;
	font-size: 17px;
	cursor: pointer;
	color: #999;
}

.ossn-comment-attachment {
	width: 115px;
	margin-left: 40px;
	padding-bottom: 10px;
	margin-top: -5px;
	display: none;
}

.ossn-comment-attachment .image-data {
	padding: 6px;
	background: #fff;
	border: 1px solid #eee;

	/* Please, check scaling algorithm of comment picture previews #682 */
	/** 
    comments attachment image not responsive #938
    display: flex; **/

	max-height: 180px;
	text-align: center;
}

.ossn-comment-attachment .image-data img {
	max-width: 100%;
	height: 100px;
	border: 1px solid #ccc;
}

.ossn-viewer-comments .ossn-comment-attachment {
	width: 115px;
}

.ossn-viewer .comments-item .row {
	margin-left: 10px;
	margin-right: 10px;
}

.ossn-viewer .comments-item .col-lg-1 {
	display: none;
}

.ossn-viewer-comments .comments-likes .ossn-comment-attach-photo .fa-camera {
	float: none;
	margin-right: 0px;
	margin-left: 10px;
}

.ossn-viewer-comments .ossn-comment-attachment {
	margin-left: 10px;
	padding-bottom: 10px;
	margin-top: 5px;
}

.ossn-viewer-comments .like-share {
	margin-left: 0px;
	margin-right: 0px;
}

.ossn-form textarea#comment-edit {
	height: 125px;
}

.ossn-delete-comment {
	color: #EC2020 !important;
}

.comment-post-btn {
	float: right;
	border-radius: 10px;
	padding: 2px 20px;
}

.comment-text {
	padding: 5px 0;
	display: block;
}