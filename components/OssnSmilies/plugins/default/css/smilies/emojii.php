.emojii {
	font-size:17px !important;
}

.emojii-container {
	background: #fff;
	width: 254px;
	border: 1px solid #ececec;
	position: fixed;
	bottom: 1px;
	right: 1px;
	z-index: 10000;
	box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
}

.emojii-container .nav {}

.emojii-container .emojii-list {
	Xpadding: 5px;
	display: none;
	height: 179px;
	overflow: hidden;
	overflow-y: scroll;
}

.emojii-container .emojii-list li {
	display: inline-block;
	font-size: 19px;
	padding: 3px;
}

.emojii-container .emojii-list li:hover {
	background: #eee;
	cursor: pointer;
}

.emojii-container .emojii-list-emoticons {
	display: block;
}

.emojii-container .nav a {
	font-size: 20px;
}

.emojii-container .nav>li>a {
	padding: 10px 4px;
}

.ossn-wall-container-control-menu-emojii-selector i {
	font-weight: bold;
}

.emojii-container-main {
	display: none;
}

.ossn-emojii-output {
	font-style: initial;
	font-size: 20px;
}

.ossn-comment-attach-photo .fa-smile-o,
.ossn-message-attach-photo .fa-smile-o {
	float: right;
	position: relative;
	margin-right: 5px;
	margin-top: 5px;
	width: 25px;
	height: 25px;
	padding: 5px;
	cursor: pointer;
	font-weight: bold;
}

.comment-container .emojii-container-main {
	float: right;
	margin-right: 285px;
}

.message-emojii {
	float: right;
	position: relative;
	top: 105px;
}


/***************************************
	Override the comment box width
****************************************/

.comment-box {
	padding: 6px 65px 6px 12px !important;
}

.comment-container {
	z-index: initial;
}


/***************************************
	Add system fonts for consistent
	emoji appearance on all platforms
.ossn-wall-container {
	font-family: "PT sans", "Apple Color Emoji","Segoe UI Emoji","NotoColorEmoji","Segoe UI Symbol","Android Emoji","EmojiSymbols";
}

.ossn-wall-item {
	font-family: "PT sans", "Apple Color Emoji","Segoe UI Emoji","NotoColorEmoji","Segoe UI Symbol","Android Emoji","EmojiSymbols";
}
.message-inner {
	font-family: "PT sans", "Apple Color Emoji","Segoe UI Emoji","NotoColorEmoji","Segoe UI Symbol","Android Emoji","EmojiSymbols";
}
.ossn-form textarea {
	font-family: "PT sans", "Apple Color Emoji","Segoe UI Emoji","NotoColorEmoji","Segoe UI Symbol","Android Emoji","EmojiSymbols";
}

.ossn-message-box {
	font-family: "PT sans", "Apple Color Emoji","Segoe UI Emoji","NotoColorEmoji","Segoe UI Symbol","Android Emoji","EmojiSymbols";
}
.ossn-chat-containers {
	font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif, "Apple Color Emoji","Segoe UI Emoji","NotoColorEmoji","Segoe UI Symbol","Android Emoji","EmojiSymbols";
}
.friend-tab-item .friend-tab input[type='text'] {
	font-family: 'lucida grande',tahoma,verdana,arial,sans-serif, "Apple Color Emoji","Segoe UI Emoji","NotoColorEmoji","Segoe UI Symbol","Android Emoji","EmojiSymbols";
}

****************************************/

.ossn-chat-base {
	font-family: "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "NotoColorEmoji", "Segoe UI Symbol", "Android Emoji", "EmojiSymbols";
}

body {
	font-family: "PT Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "NotoColorEmoji", "Segoe UI Symbol", "Android Emoji", "EmojiSymbols";
}
