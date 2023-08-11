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
	display:none;
}
.ossn-comment-attachment  .image-data  {
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
.ossn-comment-attachment  .image-data img {
	max-width:100%;
	height: 100px;
	border: 1px solid #ccc;
}
.ossn-viewer-comments .ossn-comment-attachment {
	width:115px;
}
.ossn-viewer .comments-item .row {
	margin-left:10px;
    margin-right:10px;
}
.ossn-viewer .comments-item .col-md-1 {
	display:none;
}
.ossn-viewer-comments .comments-likes .ossn-comment-attach-photo .fa-camera {
	float:none;
    margin-right:0px;
    margin-left:10px;
}

.ossn-viewer-comments .ossn-comment-attachment {
    margin-left: 10px;
    padding-bottom: 10px;
    margin-top: 5px;
}
.ossn-viewer-comments .like-share {
	margin-left:0px;
    margin-right:0px;
}
.ossn-form textarea#comment-edit{
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
