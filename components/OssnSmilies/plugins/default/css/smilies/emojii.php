.emojii-container {
	background: #fff;
    width: 285px;
    border: 1px solid #ececec;
    
	position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;    
    
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
.emojii-container .nav {
	
}
.emojii-container .emojii-list {
    padding: 5px;
    display: none;
    height: 170px;
    overflow: hidden;
    overflow-y: scroll;
}
.emojii-container .emojii-list li {
    display: inline-block;
    font-size: 20px;
    padding: 3px;		
}
.emojii-container .emojii-list li:hover {
	background:#eee;
	cursor:pointer;
}
.emojii-container .emojii-list-emoticons {
	    display: block;
}
.emojii-container .nav a {
    font-size: 20px;
}
.emojii-container .nav>li>a {
    padding: 10px 12px;
}
.ossn-wall-container-control-menu-emojii-selector i {
	font-weight:bold;
}
.emojii-container-main {
	display:none;
}
.ossn-emojii-output {
    font-style: initial;
    font-size: 20px;
}
.ossn-comment-attach-photo .fa-smile-o {
    float: right;
    position: relative;
    margin-right: 5px;
    margin-top: 5px;
    width: 25px;
    height: 25px;
    padding: 5px;
    z-index: 2;
    cursor: pointer;
    font-weight:bold;
}
.comment-container .emojii-container-main {
    float: right;
    margin-right: 285px;
}
/***************************************
	Override the comment box width
****************************************/
.comment-box {
	    padding: 5px 65px 5px 5px !important;
}
.comment-container {
    z-index: initial;
}
/***************************************
    Add system fonts for consistent
    emoji appearance on all platforms
****************************************/
body {
    font-family: "PT Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "NotoColorEmoji", "Segoe UI Symbol", "Android Emoji", "EmojiSymbols";
}
.ossn-chat-base {
	font-family: "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "NotoColorEmoji", "Segoe UI Symbol", "Android Emoji", "EmojiSymbols";
}
