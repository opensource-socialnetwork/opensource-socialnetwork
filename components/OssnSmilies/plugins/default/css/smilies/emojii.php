.emojii-container {
	background: #fff;
	width: 320px;
	border: 1px solid #ececec;
	position: fixed;
	z-index: 10000;
	box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
	top: 30%;
	left: 50%;
	transform: translate(-50%, -30%);
	padding: 0 5px 5px;
	border-radius: 5px;
}

.emojii-container .nav {
	padding: 3px 0;
}

.emojii-container .emojii-list {
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
	font-weight: initial;
}

.emojii-container-main {
	display: none;
}

.ossn-emojii-output {
	font-style: initial;
	font-size: 20px;
}

.ossn-comment-attach-photo .fa-smile,
.ossn-message-attach-photo .fa-smile {
	float: right;
	position: relative;
	margin-right: 5px;
	margin-top: 5px;
	width: 25px;
	height: 25px;
	padding: 5px;
	cursor: pointer;
	font-weight: 400;
}

.ossn-comment-attach-photo .fa-smile {
	margin-top: 3px;
	font-size: 18px;
	color: #999;
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

.smiles-close {
	float: right;
	margin-top: 8px;
	background: #eee;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	text-align: center;
}

.smiles-close i {
	margin: 0 auto;
}