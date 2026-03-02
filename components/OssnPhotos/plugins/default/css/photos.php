/*** <style> ******/
.ossn-profile-module-albums img {
	padding: 1.5px;
	width: 100px;
	height: 100px;
}

.ossn-profile-module-albums h3 {
	padding: 4px;
	font-size: 16px;
	text-align: center;
	color: #ccc;
}

.ossn-photos {
	display: flex;
	flex-wrap: wrap;
	gap: 15px;
	padding: 0;
	list-style: none;
	justify-content: flex-start;
}

.ossn-photos li {
	width: 200px;
	height: 200px;
	position: relative;
	border-radius: 12px;
	overflow: hidden;
	background: #f0f0f0;
	/* Light grey placeholder while loading */
	transition: transform 0.3s ease;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.ossn-photos li:hover {
	transform: scale(1.03);
	z-index: 2;
}

.ossn-photos .pthumb {
	width: 100%;
	height: 100%;
	object-fit: cover;
	/* This removes the black spaces/gaps */
	display: block;
	border: 0;
}

.ossn-photos .ossn-album-name {
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	padding: 30px 10px 10px;
	background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
	color: #fff;
	font-size: 13px;
	font-weight: 600;
	text-align: center;
	pointer-events: none;
}

.ossn-photos-mod-title {
	text-align: center;
	font-size: 21px;
	text-transform: uppercase;
}

.ossn-photo-view a {
	float: right;
	margin-bottom: 10px;
}

.ossn-photo-viewer {
	text-align: center;
	background: #F6F6F6;
	/** pictures in single view are drifting rightwards out of place #629 **/
	width: 100%;
}

.ossn-viewer-comments {
	margin-top: 25px;
}

.ossn-viewer-comments .comments-likes .comment-text p img {
	max-width: 250px;
}

.ossn-viewer-comments .comments-likes .ossn-comment-attach-photo {
	margin-left: 222px;
}

.ossn-photos .pthumb {
	width: 100%;
	height: 200px;
	object-fit: cover;
}

.ossn-photo-menu li {
	display: block;
}

.ossn-photo-menu li a {
	font-size: 12px;
}

.ossn-profile-module-albums {}

.ossn-profile-module-albums a {
	margin-left: 3px;
	border: 1px solid #eee;
}

.ossn-photo-view h2 {
	font-size: 18px;
	font-weight: bold;
	margin-top: 0px;
	display: inline;
}

.ossn-photo-menu {
	margin-top: 10px;
}

.ossn-photo-viewer .image-block {
	text-align: center;
	min-height: 200px;
}

.ossn-photos-add-button {
	text-align: center;
	padding: 20px;
	margin-top: 30px;
}

.ossn-photos-add-button .images {
	display: none;
}

.ossn-photos-wall {
	background: #f9f9f9;
	margin-bottom: 10px;
	padding-top: 10px;
	border-radius: 2px;
	border: 1px solid #eee;
	text-align: center;
}

.ossn-photos-wall-plain {
	border: none;
	text-align: center;
	background: initial;
}

.ossn-photos-wall-title a {
	font-weight: normal !important;
}

.ossn-photo-wall-item-small {
	width: 100px;
}

.ossn-photo-wall-item-medium {
	width: 200px;
}

.ossn-photos-wall-item {
	display: inline-block !important;
	cursor: pointer;
	margin-right: 2px;
}

.ossn-photo-view {
	margin-bottom: 10px;
}

#ossn-photos-show-gallery i {
	margin-right: 0;
}

.ossn-photos-album-comments-likes .like-share,
.ossn-photos-album-comments-likes .comments-list {
	margin-left: -10px;
	margin-right: -10px;
}