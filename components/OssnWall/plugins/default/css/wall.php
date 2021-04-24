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
	cursor:pointer;
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
.before-post-user-image {
	margin-left:5px;
}
.before-post-user-image img {
	border-radius:50%;
}
.before-post-user-image,
.before-post-user-image strong {
    margin-left: 5px;
}
.before-post-user-image {
	float:left;
}
.wall-container-active .before-post-user-image{
	float:initial;
    margin-bottom: 10px;
}
.before-post-user-image strong { 
	display:none;
}
.wall-container-active  .before-post-user-image strong {
	display:initial;
}
.wall-container-active textarea {
	padding: 10px;
    width: 100%;
    border: 1px solid;
    border: 0;
    border-top: 0px;
    resize: none;
    outline: none;
    background: #fff;
    border-radius: 0;
    font-size: 15px;
    resize: vertical;
    margin-left:0;
}
.ossn-wall-privacy,
.ossn-wall-post-button-container,
.ossn-wall-container .controls {
   display:none;
   opacity:0;
}
.wall-container-active .ossn-wall-privacy,
.wall-container-active .ossn-wall-post-button-container {
	display:inline-block;
    animation: fadeinWall 1s; 
    opacity:1;
}
.group-wall .wall-container-active .ossn-wall-post-button-container {
	float:initial;
}
.group-wall .wall-container-active .ossn-wall-post-button-container {
	height:50px;
    display: block;
}
.group-wall .wall-container-active .ossn-wall-post {
	float:right;
}
.wall-container-active .controls {
	display:block;
    animation: fadeinWall 1s; 
    opacity:1;
}
@keyframes fadeinWall {
    from { opacity: 0; }
    to { opacity: 1; }
}