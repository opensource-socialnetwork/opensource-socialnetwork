.ossn-chat-base {
    border-bottom: 0;
    bottom: 0px;
    left: 15px;
    display: block;
    font-family: "Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;
    font-size: 11px;
    height: 33px;
    position: fixed;
    text-align: left;
    z-index: 1028;
    margin-top: 8px;
    left: 15%;
    color: #000;
    width: 850px;
}

.ossn-chat-base .ossn-chat-bar {
    display: block;
    bottom: 0px;
    cursor: pointer;
    width: 200px;
    float: right;
}

.ossn-chat-base .ossn-chat-bar .inner {
    padding: 10px;
    margin-left: 5px;
    background: #F7F7F7;
    -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5);
    border: 1px solid #BAC0CD;
    height: 35px;
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
}

.ossn-chat-base .ossn-chat-bar .inner:hover {
    background: #fff;
}
.ossn-chat-windows-long .friends-list-item img {
    border: 3px solid #ec2828;
}
.ossn-chat-base .ossn-chat-bar .friends-list {
    background: #F9F9FB;
    width: 195px;
	min-height: 271px;
    margin-top: -271px;
    margin-left: 5px;
    position: fixed;
    height: 268px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    display: none;
}
img.ustatus {
	border-radius: 32px;
}
img.ustatus.ossn-chat-icon-online {
    border: 3px solid #4cae4c;
}
.ossn-chat-inner-text {
    width: 145px;
    margin-left: 20px;
    font-weight: bold;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ossn-chat-tab-titles {
    background: #186DF2;
    color: #fff;
    padding: 5px;
    border: 1px solid #186DF2;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
}

.ossn-chat-inline-table {
    display: inline-table;
}

.ossn-chat-tab-titles .options {
    float: right;
    margin-right: 10px;
    color: #FFF;
    margin-top: 2px;
    font-size: 12px;
    cursor: pointer;
}

.ossn-chat-tab-titles .options .item:hover {
    background: #5E72A2;
    width: 17px;
    margin-right: -4px;
    text-align: center;
}

.ossn-chat-tab-titles:hover {
    background: #1b60ce;
    border:1px solid #1b60ce;
}

.ossn-chat-tab-titles .text {
    color: #FFF;
    font-weight: bold;
    margin-left: 9px;
    padding: 2px;
    max-width: 190px;
    white-space: nowrap;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
}

.ossn-chat-bar .friends-list .data {
    width: 195px;
    overflow: hidden;
    overflow-y: scroll;
    height: 236px;
    
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;    
}

.ossn-chat-base .ossn-chat-bar .friends-list-item:hover {
    background: #eee;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item .friends-item-inner {
    margin: 5px 5px 5px 5px;
    height: 36px;
    padding: 2px;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item .icon {
    display: inline-table;
    width: 32px;
    height: 32px;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item .name {
    margin-top: -28px;
    margin-left: 40px;
    max-width: 110px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item .ossn-chat-icon-online {
    border: 3px solid #4cae4c;
	border-radius: 32px;
}

.ossn-chat-none {
    padding: 5px;
    margin-top:10px;
}

.friend-tab-item {
    display: block;
    bottom: 0px;
    cursor: pointer;
    width: 200px;
    float: right;
}

.friend-tab-item .friend-tab {
    padding: 12px;
    margin-left: 5px;
    background: #F7F7F7;
    -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.5);
    border: 1px solid #ccc;
    height: 35px;
    
    border-top-right-radius: 2px;
    border-top-left-radius: 2px;
}

.ossn-chat-tab-active {
    background: #5D7D91 !important;
    border: 1px solid #2F4959 !important;
    color: #fff;
}

.friend-tab-item .tab-container {
    margin-top: -268px;
    position: absolute;
    height: 265px;
    width: 251px;
    margin-left: 5px;
    display: none;
}

.friend-tab-item .tab-container .data {
    background: #eee;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    width: 251px;
    height: 237px;
    overflow: hidden;
    overflow-y: scroll;
}

.friend-tab-item .data .message-reciever .text,
.friend-tab-item .data .message-sender .text {
    position: relative;
    margin-top: 5px;
    margin-bottom: 5px;
    max-width: 80%;
    clear: both;
}

.friend-tab-item .data .message-reciever .text {
    margin-right: auto;
    background-image: -webkit-linear-gradient(bottom, #F2F2F2, #FFF);
    background-image: -moz-linear-gradient(bottom, #F2F2F2, #FFF);
    background-image: -ms-linear-gradient(bottom, #F2F2F2, #FFF);
    background-image: linear-gradient(bottom, #F2F2F2, #FFF);
    border-radius: 3px;
    border: 1px solid #ccc;
    text-shadow: rgba(255, 255, 255, .5) 0 1px 0;
    color: #000;
    display: inline-table;
}

.friend-tab-item .data .message-reciever .text .inner {
    padding: 5px;
    line-height: 15px;
    max-width: 165px;
    word-wrap: break-word;
}

.friend-tab-item .data .message-sender {
    width: 210px;
    float: right;
}

.friend-tab-item .data .message-reciever {
    width: 222px;
    float: left;
}

.friend-tab-item .data .message-reciever .user-icon {
    display: inline-table;
    padding: 3px;
}
.friend-tab-item .data .message-reciever .user-icon img {
	width:32px;
    height:32px;
}

.friend-tab-item .data .message-sender .text {
    margin-left: 35px;
    background: linear-gradient(#C7DEFE, #E7F1FE);
    background-image: -webkit-gradient(linear, center bottom, center top, from(#C7DEFE), to(#E7F1FE));
    background-image: -webkit-linear-gradient(bottom, #C7DEFE, #E7F1FE);
    border: 1px solid #DFDFDF;
    border: 1px solid rgba(0, 0, 0, 0.18);
    border-bottom-color: rgba(0, 0, 0, 0.29);
    -webkit-border-radius: 4px;
    -webkit-box-shadow: 0 1px 0 #DCE0E6;
    display: inline-table;
}

.friend-tab-item .data .message-sender .text .inner {
    padding: 5px;
    line-height: 15px;
    max-width: 158px;
    word-wrap: break-word;
}

.ossn-chat-triangle {
    border-top: 5px solid rgba(0, 0, 0, 0);
    border-bottom: 5px solid rgba(0, 0, 0, 0);
}

.ossn-chat-triangle-blue {
    border-left: 5px solid #AFD0FE;
    margin-top: 10px;
    float: right;
}

.ossn-chat-triangle-white {
    border-right: 5px solid #B8B8B8;
    margin-top: 10px;
    margin-left: 38px;
    float: left;
}

.ossn-chat-text-data {
    margin-top: -40px;
}

.ossn-chat-text-data-right {
    float: right;
}

.friend-tab-item .friend-tab form {
    display: none;
}

.friend-tab-item .friend-tab input[type='text'] {
    width: 213px;
    height: 30px;
    padding: 2px;
	margin-top: -12px;
	margin-left: -12px;
    position: absolute;
    font-size: 12px;
    border:0px;
    outline:none;
}

.ossn-chat-tab-close {
    width: 17px;
    margin-right: -4px;
    text-align: center;
}

.ossn-chat-new-message {
    background-color: #dc0d17;
    background-image: -webkit-gradient(linear, center top, center bottom, from(#fa3c45), to(#dc0d17));
    background-image: -webkit-linear-gradient(#fa3c45, #dc0d17);
    color: #fff;
    min-height: 13px;
    padding: 1px 3px;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, .4);
    font-size: 10px;
    float: left;
    display: none;
	margin-top: -2px;
    position: absolute;     
}

.ossn-chat-icon-smilies {
    background: #FFF;
    width: 235px;
    min-height: 40px;
    padding: 5px;
    position: fixed;
    border: 1px solid #CCC;
    z-index: 1;
}

.ossn-chat-item-smiles {
    padding: 3px;
}

.ossn-chat-icon-smile-set {
    margin-top: -12px;
    background: #fff;
    width: 37px;
    padding: 4px;
    height: 27px;
    position: absolute;
    margin-left: 200px;
}

.ossn-chat-icon-smilies {
    display: none;
}
/** Icons **/
.ossn-chat-icon {}
.ossn-chat-icon-online:before {
	content: "\f111 ";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    color: #57B540;
    font-size: 12px;
    float: left;
}

.ossn-chat-icon-offline:before {
	content: "\f111 ";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    color: #D23636;
    font-size: 12px;
    float: left;
}
.ossn-chat-icon-expend:before {
    content: "\f0b2";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    color: #fff;
    font-size: 12px;
}

.ossn-chat-icon-expend:hover {
    opacity: 0.9;
}

.ossn-chat-icon-smile:before {
    content: "\f118";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    margin-left: 10px;
}

.ossn-chat-icon {
    width: 16px !important;
    height: 16px !important;
}

.ossn-chat-windows-long {
    display: none;
}

@media only screen
and (min-width : 1280px) {
    .ossn-chat-base {
        width: 910px !important;
    }
}

@media only screen
and (min-width : 1360px) {
    .ossn-chat-bar {
        display: none !important;
    }

    .ossn-chat-windows-long {
        float: right;
        position: fixed;
        min-height: 500px;
        width: 80px;
        border-left: 1px solid #ccc;
        bottom: 0px;
        right: 0;
        top: 0;
        background: #E9EAED;
        display: block;
    }

    .ossn-chat-windows-long .inner {
        margin-top: 45px;
        border-top: 1px solid #ccc;
        overflow-x: hidden;
        overflow-y: auto;
    }

    .ossn-chat-windows-long .friends-list-item .friends-item-inner {
    	margin: 5px 5px 5px 5px;
    	height: 55px;
    }

    .ossn-chat-windows-long .friends-list-item {
        border-top: 1px solid #E9EAED;
        border-bottom: 1px solid #E9EAED;
        padding-left: 2px;
            text-align: center;
    }

    .ossn-chat-windows-long .friends-list-item:hover {
        background: #E1E2E5;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        cursor: pointer;
    }

    .ossn-chat-windows-long .friends-list-item .icon {
        display: inline-block;
        width: 50px;
        height: 50px;
    }
	

    .ossn-chat-windows-long .friends-list-item .name {
        margin-top: -25px;
        margin-left: 40px;
        max-width: 110px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

   .ossn-chat-windows-long .friends-list-item .ossn-chat-icon-online:before {
    	float: right;
 	margin-right:4px;
    	margin-top: -17px;
 	content: "\f111 ";
    	font-family: FontAwesome;
    	font-style: normal;
    	font-weight: normal;
    	color: #57B540;
    	font-size: 12px;
    }
}
/** Document **/
#ossn-chat-sound {
    display: none;
}

.ossn-chat-message-sending {
    position: absolute;
    width: 218px;
    height: 11px;
    margin-top: -9px;
    margin-left: -9px;
    padding: 10px;
    background: #fff;
    display: none;
}
.friend-tab .ossn-chat-inner-text {
	margin-top: -2px;
}
.ossn-chat-sending-icon {
    background: url("<?php echo ossn_site_url();?>components/OssnChat/images/loading-small.gif") no-repeat;
    width: 16px;
    height: 11px;
}
.ossnchat-scroll-top {
	margin-top:0px !important;
}

@media (max-width: 480px){
    .ossn-chat-base {
    	display:none !important;
    }
}

@media only screen and (max-width: 480px) {
    .ossn-chat-base {
    	display:none !important;
    }
}
@media only screen and (max-width: 768px) {
    .ossn-chat-base {
    	display:none !important;
    }
}
footer { 
	margin-bottom:50px;	
}
@-ms-viewport {
   width: auto;
}
