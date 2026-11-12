/*************************************************
	FULL-WIDTH FACEBOOK GROUP PROFILE STYLES
**************************************************/

.fbui-group-page-wrapper {
	width: 100%;
	margin: 0;
	padding: 0;
	margin-top:-10px;
}
.ossn-wall-privacy-dummy .fa-lock {
	    font-size: 11px;
}

/* Full-bleed header container across entire browser width */
.fbui-group-header-card {
	background: #ffffff;
	width: 100%;
	border-bottom: 1px solid #ced0d4;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
	margin-bottom: 16px;
	position: relative;
}

/* FADING SIDE BACKDROP */
.fbui-cover-blur-container {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	height: 360px;
	overflow: hidden;
	z-index: 1;
	background: #ffffff;
	-webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.45) 0%, rgba(0, 0, 0, 0.1) 70%, rgba(0, 0, 0, 0) 100%);
	mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.45) 0%, rgba(0, 0, 0, 0.1) 70%, rgba(0, 0, 0, 0) 100%);
}

.fbui-cover-blur-bg {
	width: 100%;
	height: 100%;
	background-size: cover;
	background-position: center;
	filter: blur(60px) brightness(1.2) saturate(1.1);
	transform: scale(1.25);
}

/* Constrained content container inside full-width band */
.fbui-group-header-inner,
.fbui-group-main-container,
.ossn-group-bottom-row {
	max-width: 1095px;
	margin: 0 auto;
	padding: 0 16px;
	box-sizing: border-box;
	position: relative;
	z-index: 2;
}

/* Cover Image Wrapper */
.fbui-group-cover-wrapper {
	position: relative;
	width: 100%;
	height: 360px;
	background-color: #f0f2f5;
	border-radius: 0 0 12px 12px;
	overflow: hidden;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
}

.fbui-group-cover-wrapper .ossn-group-cover {
	width: 100%;
	height: 100%;
	position: relative;
}

.fbui-group-cover-wrapper img#draggable {
	position: absolute;
	width: 100%;
	min-height: 100%;
	object-fit: cover;
	cursor: move;
	left: 0 !important;   /* Locks horizontal movement to the left edge */
    right:  0 !important;  /* Forces it to span the full width cleanly */      
}

/* Neutral Fallback when no cover photo is uploaded */
.fbui-group-cover-placeholder {
	width: 100%;
	height: 100%;
	background: #e4e6eb;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #8a8d91;
	font-size: 48px;
}

/* Cover Reposition Button Container */
.fbui-cover-actions,
.ossn-group-cover-button {
	position: absolute;
	bottom: 16px;
	right: 16px;
	display: flex;
	gap: 8px;
	z-index: 5;
}

.fbui-btn-glass {
	background: rgba(255, 255, 255, 0.9);
	backdrop-filter: blur(8px);
	color: #050505 !important;
	font-weight: 600;
	font-size: 14px;
	padding: 8px 12px;
	border-radius: 6px;
	text-decoration: none !important;
	box-shadow: 0 1px 2px rgba(0,0,0,0.15);
	transition: background 0.2s ease;
	display: inline-flex;
	align-items: center;
	gap: 6px;
}

.fbui-btn-glass:hover {
	background: #ffffff;
}

/* Group Info & Actions Row */
.fbui-group-info-bar {
	padding: 20px 8px 12px 8px;
	display: flex;
	align-items: flex-start;
	justify-content: space-between;
	gap: 16px;
	background: #ffffff;
}

.fbui-group-title {
	font-size: 28px;
	font-weight: 800;
	margin: 0 0 6px 0;
	line-height: 1.2;
	color: #050505;
}

.fbui-group-title a {
	color: #050505 !important;
	text-decoration: none !important;
}

.fbui-group-meta {
	font-size: 15px;
	color: #65676b;
	display: flex;
	align-items: center;
	gap: 6px;
	margin-bottom: 12px;
}

.fbui-dot {
	font-weight: bold;
	color: #65676b;
	padding: 0 2px;
}

/* Stacked Avatar Bubbles */
.fbui-avatar-stack {
	display: flex;
	align-items: center;
	margin-top: 8px;
}

.fbui-avatar-stack a {
	display: inline-block;
	margin-right: -8px;
}

.fbui-avatar-stack img {
	width: 32px;
	height: 32px;
	border-radius: 50%;
	border: 2px solid #ffffff;
	object-fit: cover;
	transition: transform 0.2s ease;
}

.fbui-avatar-stack a:hover img {
	transform: translateY(-2px);
	z-index: 10;
	position: relative;
}

/* FB Action Buttons Container */
.groups-buttons,
.fbui-group-actions {
	display: flex;
	align-items: center;
	gap: 8px;
	margin-top: 4px;
}

/* Save Position Button Hidden by Default */
.group-c-position {
	display: none;
}

.fbui-btn {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 8px 16px;
	border-radius: 6px;
	font-size: 15px;
	font-weight: 600;
	text-decoration: none !important;
	transition: filter 0.2s ease;
	border: none;
}

.fbui-btn-primary {
	background-color: #0866ff !important;
	color: #ffffff !important;
}

.fbui-btn-primary:hover {
	filter: brightness(0.95);
}

.fbui-btn-secondary {
	background-color: #e4e6eb !important;
	color: #050505 !important;
}

.fbui-btn-secondary:hover {
	background-color: #d8dadf !important;
}

.fbui-divider {
	height: 1px;
	background-color: #e4e6eb;
}

/* Group Subnav Header Menu Tabs */
.fbui-group-nav {
	padding: 4px 0 0 0;
	background: #ffffff;
	margin-bottom: 5px;
}

/* Target ONLY the main top-level UL for horizontal flex layout */
.fbui-group-nav .group-header-menu > ul {
	display: flex;
	list-style: none;
	margin: 0;
	padding: 0;
	gap: 4px;
	position: relative;
}

.fbui-group-nav .group-header-menu li {
	position: relative;
}

.fbui-group-nav .group-header-menu li a {
	padding: 14px 16px;
	font-size: 15px;
	font-weight: 600;
	color: #65676b;
	border-radius: 8px;
	text-decoration: none !important;
	display: block;
	position: relative;
	transition: background 0.2s ease, color 0.2s ease;
}

.fbui-group-nav .group-header-menu li a:hover {
	background: #f2f2f2;
}

/* Remove Bootstrap default caret arrow from dropdown toggles here */
.fbui-group-nav .group-header-menu .dropdown-toggle::after {
	display: none !important;
}

/* Fix Dropdown Menu behavior on Mobile/Overflow with high z-index */
.fbui-group-nav .group-header-menu .dropdown-menu {
	display: none; /* Hidden by default until Bootstrap toggles it */
	position: absolute;
	top: 100%;
	right: 0;
	float: none;
	min-width: 160px;
	padding: 8px 0;
	margin: 2px 0 0;
	background-color: #fff;
	border: 1px solid rgba(0,0,0,.15);
	border-radius: 8px;
	box-shadow: 0 4px 12px rgba(0,0,0,0.15);
	z-index: 9999; /* Higher z-index to stay on top of other layout blocks */
}

.fbui-group-nav .group-header-menu .dropdown-menu.show {
	display: block; 
}

.fbui-group-nav .group-header-menu .dropdown-menu li {
	display: block;
	width: 100%;
}

.fbui-group-nav .group-header-menu .dropdown-menu li a {
	display: block;
	padding: 8px 16px;
	color: #050505;
	font-weight: 500;
	white-space: nowrap;
}

.fbui-group-nav .group-header-menu .dropdown-menu li a:hover {
	background-color: #f2f2f2;
	color: #1877f2;
}

/* Active Tab Blue Underline Indicator */
.fbui-group-nav .group-header-menu li.active a,
.fbui-group-nav .group-header-menu li a.active,
.fbui-group-nav .group-header-menu li.ossn-menu-groupheader-active a {
	color: #0866ff !important;
}

.fbui-group-nav .group-header-menu li.active a::after,
.fbui-group-nav .group-header-menu li a.active::after,
.fbui-group-nav .group-header-menu li.ossn-menu-groupheader-active a::after {
	content: "";
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	height: 3px;
	background-color: #0866ff;
	border-radius: 3px 3px 0 0;
}
.fbui-group-header-inner.profile-header.ossn-group-cover-header {
    overflow: visible !important;
    z-index: 1050 !important;
}

.fbui-group-nav {
    overflow: visible !important;
}
/* CENTERED LOADING ANIMATION OVERLAY */
.ossn-covers-uploading-annimation {

}

.ossn-covers-uploading-annimation .ossn-loading {
	margin: 0 auto;
}

/* Mobile Responsiveness */
@media (max-width: 767px) {
	.fbui-cover-blur-container,
	.fbui-group-cover-wrapper {
		height: 200px;
		border-radius: 0;
	}

	.fbui-group-info-bar {
		flex-direction: column;
		padding: 12px 0;
	}

	.groups-buttons,
	.fbui-group-actions {
		width: 100%;
	}

	.fbui-btn {
		flex: 1;
		justify-content: center;
	}

	.fbui-group-title {
		font-size: 22px;
	}
}