/******** <style> ******/
/******************************************
	Ossn Ads
*******************************************/
.ad-image-container {
	background: #f6f7f8;
	padding: 5px;
	border: 1px solid #ebebeb;
}

.ossn-ad-item .ad-image {
	max-width: 200px;
	margin: 0 auto;
	display: block;
}

.ossn-ad-item a {
	text-decoration: none;
	color: #000;
	cursor: pointer;
}

.ossn-ad-item .ad-title {
	font-weight: bold;
	font-size: 15px;
	margin-bottom: 5px;
}

.ossn-ad-item .ad-link {
	margin-bottom: 5px;
}

.ossn-ad-item p {
	margin-top: 10px;
	text-align: justify;
}


.ossn-ad-item {
	border-bottom: 1px solid #eee;
	margin-bottom: 10px;
	word-break: break-word;
}

.ossn-sidebar-admin-cta {
	margin: 15px;
	padding: 20px;
	background: #fcfdfe;
	border: 1px solid #e1e8ed;
	border-radius: 12px;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
	text-align: center;
}

.admin-cta-content h4 {
	font-size: 15px;
	font-weight: 700;
	color: #2c3e50;
	margin: 0 0 8px 0;
}

.admin-cta-content p {
	color: #657786;
	line-height: 1.5;
	margin-bottom: 15px;
}

.btn-admin-cta {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	background: linear-gradient(135deg, #0b769c 0%, #08607f 100%);
	color: #ffffff !important;
	padding: 10px 20px;
	border-radius: 25px;
	font-weight: 600;
	text-decoration: none !important;
	border: none;
	/* transition: background doesn't work well with gradients, 
       so we transition the box-shadow and transform instead */
	transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
	box-shadow: 0 4px 6px rgba(11, 118, 156, 0.15);
	cursor: pointer;
}

.btn-admin-cta i {
	margin-right: 8px;
	font-size: 12px;
}

.btn-admin-cta:hover {
	/* Instead of changing background color, we use brightness 
       This keeps the gradient but makes it darker/richer */
	filter: brightness(1.1);
	transform: translateY(-2px);
	box-shadow: 0 6px 12px rgba(11, 118, 156, 0.25);
	color: #ffffff !important;
}

.btn-admin-cta:active {
	transform: translateY(0);
	filter: brightness(0.9);
}

.admin-cta-content i.fa-bullhorn {
	color: #0b769c;
}