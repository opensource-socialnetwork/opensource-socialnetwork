:root{
	--ossn-chat-panel-width: 330px;
    --ossn-chat-panel-height: 400px;
    --ossn-inchat-icon-color: #0b769c;
}
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
    position:relative;
}

.ossn-chat-base .ossn-chat-bar .inner:hover {
    background: #fff;
}
.ossn-chat-windows-long .friends-list-item img {
    border: 3px solid #ec2828;
}
.ossn-chat-base .ossn-chat-bar .friends-list {
    background: #fff;
    width: 195px;
	min-height: 271px;
    margin-top: -271px;
    margin-left: 5px;
    position: fixed;
    height: 268px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    display: none;
	box-shadow: 0 12px 28px 0 rgb(0 0 0 / 20%), 0 2px 4px 0 rgb(0 0 0 / 10%);    
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
    background: #fff;
    color: #000;
    height: 48px;
    padding: 10px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    box-shadow: 0 1px 2px rgb(0 0 0 / 10%), 0 -1px rgb(0 0 0 / 10%) inset, 0 2px 1px -1px rgb(255 255 255 / 50%)    
}

.ossn-chat-inline-table {
    display: inline-table;
}

.ossn-chat-tab-titles .options {
	float: right;
    color: #FFF;
    font-size: 15px;
    cursor: pointer;
}

.ossn-chat-tab-titles .options .item:hover {
    background: #5E72A2;
    width: 17px;
    margin-right: -4px;
    text-align: center;
}

.ossn-chat-tab-titles .text {
    color: #353535;
    font-weight: bold;
    margin-left: 9px;
    padding-top: 4px;
    max-width: 190px;
    white-space: nowrap;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 14px;
}

.ossn-chat-bar .friends-list .data {
    width: 195px;
    overflow: hidden;
    overflow-y: scroll;
    height: 236px;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item:hover {
    background: #eee;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item .friends-item-inner {
    margin: 5px 5px 5px 5px;
    padding: 5px 2px;
    height: 33px;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item .icon {
    display: inline-table;
    width: 25px;
    height: 25px;
}

.ossn-chat-base .ossn-chat-bar .friends-list-item .name {
    margin-top: -22px;
    margin-left: 30px;
    max-width: 110px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.ossn-chat-base .ossn-chat-bar .friends-list-item .user-icon-small {
	width:25px;
    height:25px;
}
.ossn-chat-base .ossn-chat-bar .friends-list-item .ossn-chat-icon-online {
    border: 3px solid #4cae4c;
	border-radius: 32px;
}

.ossn-chat-none {
    padding: 5px;
    margin-top:10px;
    text-align:center;
}

.friend-tab-item {
    display: block;
    bottom: 0px;
    cursor: pointer;
    width: 200px;
    float: right;
}

.friend-tab-item:first-child {
	margin-right: 75px;
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
    margin-top: -366px;
    position: absolute;
    height: var(--ossn-chat-panel-height);
    width: var(--ossn-chat-panel-width);
    margin-left: 5px;
    display: none;
    background:#fff;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;    
    box-shadow: 0 12px 28px 0 rgb(0 0 0 / 20%), 0 2px 4px 0 rgb(0 0 0 / 10%);
}

.friend-tab-item .tab-container .data {
    background: #fff;
    height: 305px;
    width: var(--ossn-chat-panel-width);
    overflow: hidden;
    overflow-y: auto;
}

.friend-tab-item .data .message-reciever .text,
.friend-tab-item .data .message-sender .text {
    position: relative;
    margin-top: 5px;
    margin-bottom: 5px;
    max-width: 80%;
    clear: both;
    font-size:13px;
}

.friend-tab-item .data .message-reciever .text {
	margin-right: auto;
    -webkit-border-radius: 15px;
    -webkit-box-shadow: 0 1px 0 #dce0e6;
    display: inline-table;
    background: #f1f0f0;
}

.friend-tab-item .data .message-reciever .text .inner {
    padding: 9px;
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
    -webkit-border-radius: 15px;
    -webkit-box-shadow: 0 1px 0 #c9d4bc;
    display: inline-table;
    background: #dfeecf;
}

.friend-tab-item .data .message-sender .text .inner {
    padding: 9px;
    line-height: 15px;
    max-width: 158px;
    word-wrap: break-word;
}

.ossn-chat-triangle {
    border-top: 5px solid rgba(0, 0, 0, 0);
    border-bottom: 5px solid rgba(0, 0, 0, 0);
}
.ossn-chat-text-data {
    margin-left:5px;
}

.ossn-chat-text-data-right {
    float: right;
    margin-right:5px;
}

.friend-tab-item .friend-tab form {
    display: none;
}

.friend-tab-item .friend-tab input[type='text'] {
	width: 255px;
    height: 33px;
    padding: 3px 10px 3px;
    margin-top: -20px;
    margin-left: -13px;
    position: absolute;
    font-size: 13px;
    border: 0px;
    outline: none;
    background: #F0F2F5;
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
}

.ossn-chat-tab-close {
    width: 17px;
    margin-right: -4px;
    text-align: center;
     color: #bbb;
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
    margin-top: -23px;
    width: 75px;
    padding: 4px;
    height: 27px;
    position: absolute;
    margin-left: 240px;
}

.ossn-chat-icon-smilies {
    display: none;
}
/** Icons **/
.ossn-chat-icon {}
.ossn-chat-icon-online:before {
	content: "\f111 ";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: 900;
    color: #57B540;
    font-size: 12px;
    float: left;
}

.ossn-chat-icon-offline:before {
	content: "\f111 ";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: 900;
    color: #D23636;
    font-size: 12px;
    float: left;
}
.ossn-chat-option-title-icon {
	width: 30px;
    height: 30px;
    text-align: center;
    padding-top: 4px;
    border-radius: 50%;
}
.ossn-chat-option-title-icon:hover {
    background: #f1f1f1;

}
.ossn-chat-icon-minimize:before {
    content: "\f068";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: 900;
    color: var(--ossn-inchat-icon-color);
}
.ossn-chat-icon-expend {
    transform: rotate(310deg);
}
.ossn-chat-icon-call:before {
    content: "\f03d";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: 900;
    color:var(--ossn-inchat-icon-color);
}
.ossn-chat-icon-expend:before {
    content: "\f061";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: 900;
    color: var(--ossn-inchat-icon-color);
}
.ossn-chat-tab-close:before {
    content: "\f00d";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: 900;
    color: var(--ossn-inchat-icon-color);
}

.ossn-chat-icon-expend:hover {
    opacity: 0.9;
}
.ossn-chat-icon-attachment,
.ossn-chat-icon-smile {
		display:inline-block;
        width:30px;
        height:30px;
        background: #fff;
         border-radius: 50%;
             text-align: center;
}
.ossn-chat-icon-smile:before {
    content: "\f599";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: 400;
    font-size: 20px;
    color: var(--ossn-inchat-icon-color);
}
.ossn-chat-icon-attachment:hover,
.ossn-chat-icon-smile:hover {
	background: #eee;
    text-align: center;
}
.ossn-chat-icon-attachment:before {
    content: "\f0c6";
    font-family: 'Font Awesome 5 Free';
    font-style: normal;
    font-weight: bold;
    font-size: 20px;
    color: var(--ossn-inchat-icon-color);
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

@media only screen and (min-width : 1500px) {
    .ossn-chat-base {
        width: 1100px !important;
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
    	font-family: 'Font Awesome 5 Free';
    	font-style: normal;
    	font-weight: 900;
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
    width: 255px;
    height: 34px;
    margin-top: -21px;
    margin-left: -12px;
    padding: 15px;
    display:none;
    background: #fff;
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
.friend-tab-item .container-table-pagination {
   	visibility:hidden;
}
.friend-tab-item .pagination {
	margin:0;
}
.ossn-chat-tab-user-icon {
		    border-radius: 50%;
            float: left;
}
/**
 Scroll
 **/
.ossn-chat-bar .friends-list .data,
.friend-tab-item .tab-container .data {
    scrollbar-width: thin;
    scrollbar-color: #adadad transparent
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar,
.friend-tab-item .tab-container .data::-webkit-scrollbar {
    height: 20px;
    width: 8px
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar-track,
.friend-tab-item .tab-container .data::-webkit-scrollbar-track {
    border-radius: 5px;
    background-color: transparent;
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar-track:hover,
.friend-tab-item .tab-container .data::-webkit-scrollbar-track:hover {
    background-color: transparent
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar-track,
.friend-tab-item .tab-container .data::-webkit-scrollbar-track {
    background-color: none;
    border-left:0px;
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar-track:active,
.friend-tab-item .tab-container .data::-webkit-scrollbar-track:active {
    background-color: transparent
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar-thumb,
.friend-tab-item .tab-container .data::-webkit-scrollbar-thumb {
    border-radius: 5px;
    background-color: #adadad
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar-thum:hover,
.friend-tab-item .tab-container .data::-webkit-scrollbar-thumb:hover {
    background-color: #adadad
}
.ossn-chat-bar .friends-list .data::-webkit-scrollbar-thumb:active,
.friend-tab-item .tab-container .data::-webkit-scrollbar-thumb:active {
    background-color: #adadad
}
.ossn-message-attachment {
    font-size: 10px;
    font-weight: bold;
    display: block;
    margin-top: 2px;
    font-style: italic;
}
.ossn-chat-message-attachment-details {
    position: absolute;
    width: 320px;
    height: 35px;
    margin-top: -59px;
    margin-left: -12px;
    border-top: 1px solid #eee;
    padding: 10px;
    background: #fff;
    display:none;
}
.ossn-message-attachment-remove {
    color: red;
    float: right;
    cursor:pointer;
}
.ossn-message-attachment-name {
    max-width: 250px;
    white-space: nowrap;
    display: inline-block;
    overflow: hidden;
    text-overflow: ellipsis;
}
.ossn-inchat-status-circle {
    position: absolute;
    margin-left: -13px;
    margin-top: 17px;
    border-radius: 100%;
    border: 2px solid white;
    height: 12px;
    width: 12px;
}
.ossn-inchat-status-offline {
	background:#D23636;
}
.ossn-inchat-status-online {
    background: #4cae4c;
}
.friends-list .ossn-chat-tab-titles {
    height: 35px;
    padding: 5px;
    border-bottom: 1px solid #eee;
    box-shadow: none;
}
.ossn-minichat-list-open {
    border-top-right-radius: 0px !important;
    border-top-left-radius: 0px !important;    
}
.friends-list .ossn-chat-tab-titles .text {
    font-size: 12px;
}