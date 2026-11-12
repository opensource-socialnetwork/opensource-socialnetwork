/*************************************************
	FULL-WIDTH FACEBOOK PROFILE HEADER
**************************************************/

.ossn-profile-facebook {
	width: 100%;
    margin-top:-10px;
}

/* Screen-Stretched Outer Background Container */
/* Outer Full-Width Header Wrapper */
.fb-header-fullwidth-wrapper {
	position: relative;
	width: 100vw;
	left: 50%;
	right: 50%;
	margin-left: -50vw;
	margin-right: -50vw;
	background-color: #ffffff; /* Ensures lower section is solid white */
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
	margin-bottom: 16px;
	overflow: hidden;
}

/* Ambient Blur Restricted to Cover Height with Smooth Bottom Fade */
.fb-header-ambient-blur {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	height: 300px; /* Locked to exact height of the cover image */
	background-image: var(--fb-cover-bg);
	background-size: cover;
	background-position: center;
	filter: blur(80px) brightness(1.05) saturate(0.7);
	opacity: 0.85;
	transform: scale(1.2);
	z-index: 1;

	/* Fade mask: Full color at top -> Smoothly dissolves to transparent before bottom of cover */
	-webkit-mask-image: linear-gradient(
		to bottom, 
		rgba(0, 0, 0, 1) 0%, 
		rgba(0, 0, 0, 0.7) 50%, 
		rgba(0, 0, 0, 0.2) 80%, 
		rgba(0, 0, 0, 0) 100%
	);
	mask-image: linear-gradient(
		to bottom, 
		rgba(0, 0, 0, 1) 0%, 
		rgba(0, 0, 0, 0.7) 50%, 
		rgba(0, 0, 0, 0.2) 80%, 
		rgba(0, 0, 0, 0) 100%
	);
	pointer-events: none;
}

/* Centered Inner Wrapper (1250px Max Width) */
.fb-profile-centered-container {
	position: relative;
	z-index: 3;
	max-width: 1095px;
	margin: 0 auto;
	padding: 0 16px;
}

.fb-profile-centered-container .top-container {
	background: transparent;
	border: none;
	border-radius: 0;
}

/* Cover Photo Container */
.fb-profile-cover {
	position: relative;
	width: 100%;
	height: 350px;
	background-color: #f0f2f5;
	border-radius: 0 0 12px 12px;
	overflow: hidden;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.fb-profile-cover img#draggable {
	position: absolute;
	width: 100%;
	min-height: 100%;
	object-fit: cover;
	cursor: move;
	left: 0 !important;   /* Locks horizontal movement to the left edge */
    right:  0 !important;  /* Forces it to span the full width cleanly */    
}

/* Cover Action Buttons */
.profile-cover-controls {
	position: absolute;
	width: auto;
	top: auto;
	bottom: 16px;
	right: 16px;
	margin: 0;
	z-index: 10;
	display: flex;
	gap: 8px;
}

.fb-btn-cover-action {
	float: none;
	margin: 0;
	background: #ffffff;
	color: #050505;
	padding: 8px 12px;
	border-radius: 6px;
	font-weight: 600;
	font-size: 14px;
	text-decoration: none;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
	border: none;
	transition: background 0.15s ease-in-out;
}

.fb-btn-cover-action:hover {
	background: #f0f2f5;
	color: #050505;
	text-decoration: none;
}

/* Save Reposition Button Menu */
#cover-menu {
	position: absolute;
	right: 16px;
	bottom: 16px;
	z-index: 12;
	display: none; /* Controlled dynamically by Ossn JS */
}

.fb-btn-save-cover {
	padding: 8px 16px;
	border-radius: 6px;
	font-weight: 600;
	font-size: 14px;
}

/* User Metadata Row */
.fb-profile-header-content {
	display: flex;
	align-items: flex-end;
	padding: 0 32px 16px 32px;
	position: relative;
	gap: 16px;
	border-bottom: 1px solid #e4e6eb;
	background: #ffffff;
}

/* Overlapping Avatar */
.fb-profile-avatar-wrapper {
	position: relative;
	width: 168px;
	height: 168px;
	margin-top: -84px;
	margin-left: 0;
	flex-shrink: 0;
	border-radius: 50%;
	border: 4px solid #ffffff;
	background: #ffffff;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
	z-index: 5;
}

.fb-profile-avatar-wrapper img {
	width: 100%;
	height: 100%;
	border-radius: 50%;
	object-fit: cover;
	display: block;
}

/* Camera Badge Icon */
.fb-profile-avatar-wrapper {
	position: relative;
	display: inline-block;
}
.upload-photo,
.fb-avatar-upload-icon {
	position: absolute;
	bottom: 8px;
	right: 8px;
	width: 36px;
	height: 36px;
	background-color: #e4e6eb;
	border-radius: 50%;
	display: flex;
	align-items: center;
	justify-content: center;
	cursor: pointer;
	color: #050505;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
	transition: background-color 0.2s ease;
}
.upload-photo:hover,
.fb-avatar-upload-icon:hover {
	background-color: #d8dadf;
}
.user-photo-uploading img {
	opacity:0.3;
}
.user-photo-uploading .upload-photo {
	display:none;
}
.upload-photo i,
.fb-avatar-upload-icon i {
	font-size: 18px;
	color: #050505;
}

.fb-avatar-upload-icon span {
	margin: 0;
}

/* User Details */
.fb-profile-user-details {
	flex: 1;
	padding-bottom: 8px;
}

.fb-user-fullname {
	font-size: 32px;
	font-weight: 700;
	color: #050505;
	margin: 0;
	line-height: 1.2;
}

.fb-user-username {
	font-size: 15px;
	color: #65676b;
	font-weight: 600;
	margin-top: 4px;
}

.ossn-profile-role {
	font-size: 15px;
	color: #65676b;
	font-weight: 600;
}

/* Action Buttons Bar */
.fb-profile-actions {
	display: flex;
	align-items: center;
	gap: 8px;
	padding-bottom: 8px;
	margin-right: 0;
}

.fb-btn {
	padding: 8px 16px;
	border-radius: 6px;
	font-size: 15px;
	font-weight: 600;
	display: inline-flex;
	align-items: center;
	gap: 6px;
	text-decoration: none;
	cursor: pointer;
	border: none;
	transition: background 0.15s ease-in-out;
}

.fb-btn-primary {
	background-color: #0866ff;
	color: #ffffff;
}

.fb-btn-primary:hover {
	background-color: #0052cc;
	color: #ffffff;
	text-decoration: none;
}

.fb-btn-secondary {
	background-color: #e4e6eb;
	color: #050505;
}

.fb-btn-secondary:hover {
	background-color: #d8dadf;
	color: #050505;
	text-decoration: none;
}

/* Navigation Tabs Bar */
.fb-profile-navigation-bar {
	padding: 4px 16px;
	background: #ffffff;
	border: none;
	margin: 0;
}

.fb-profile-tabs {
	border-bottom: none;
}

.fb-profile-tabs ul {
	display: flex;
	align-items: center;
	gap: 4px;
	list-style: none;
	margin: 0;
	padding: 0;
}

.fb-profile-tabs ul li a:not(.dropdown a) {
	padding: 14px 16px;
	border-radius: 8px;
	font-weight: 600;
	font-size: 15px;
	color: #65676b;
	text-decoration: none;
	display: inline-block;
	transition: background 0.15s ease-in-out;
	position: relative;
	margin-right: 0;
}

.fb-profile-tabs ul li a:not(.dropdown a):hover {
	background-color: #f0f2f5;
	color: #050505;
}

.fb-profile-tabs ul li.active a,
.fb-profile-tabs ul li.selected a {
	color: #0866ff;
}

.fb-profile-tabs ul li.active a::after,
.fb-profile-tabs ul li.selected a::after {
	content: "";
	position: absolute;
	bottom: -4px;
	left: 0;
	right: 0;
	height: 3px;
	background-color: #0866ff;
	border-radius: 3px 3px 0 0;
}

/*************************************************
	RESPONSIVE MOBILE LAYOUT
**************************************************/
@media (max-width: 991px) {
	.fb-header-ambient-blur {
		height: 220px;
	}

	.fb-profile-cover {
		height: 220px;
	}

	.fb-profile-header-content {
		flex-direction: column;
		align-items: center;
		text-align: center;
		padding: 0 16px 16px 16px;
	}

	.fb-profile-avatar-wrapper {
		width: 140px;
		height: 140px;
		margin-top: -70px;
	}

	.fb-profile-user-details {
		padding-bottom: 0;
	}

	.fb-user-fullname {
		font-size: 24px;
	}

	.fb-profile-actions {
		width: 100%;
		justify-content: center;
	}
}

/*************************************************
	COVER PHOTO UPLOADING ANIMATION & OVERLAY
**************************************************/

/* 1. Dim & blur the cover image while uploading */
.user-cover-uploading {
	opacity: 0.3;
	filter: blur(4px);
	transition: all 0.3s ease-in-out;
}

/* 2. Centered Floating Glassmorphism Circle */
.ossn-covers-uploading-annimation {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	z-index: 20;
	background: rgba(255, 255, 255, 0.9);
	backdrop-filter: blur(8px);
	width: 56px;
	height: 56px;
	border-radius: 50%;
	box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
	display: flex;
	align-items: center;
	justify-content: center;
	pointer-events: none;
	animation: coverUploadPop 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

/* Pop-in animation when upload starts */
@keyframes coverUploadPop {
	from {
		opacity: 0;
		transform: translate(-50%, -50%) scale(0.8);
	}
	to {
		opacity: 1;
		transform: translate(-50%, -50%) scale(1);
	}
}

/* 3. FB Blue Spinner Ring */
.ossn-covers-uploading-annimation .ossn-loading {
	width: 28px;
	height: 28px;
	border: 3px solid #e4e6eb;
	border-top-color: #0866ff; /* FB Blue */
	border-radius: 50%;
	animation: ossnCoverSpin 0.75s linear infinite;
	margin: 0;
}

@keyframes ossnCoverSpin {
	from {
		transform: rotate(0deg);
	}
	to {
		transform: rotate(360deg);
	}
}

/*************************************************
	FACEBOOK MOBILE PROFILE RESPONSIVE FIXES
**************************************************/
@media (max-width: 767px) {
	/* 1. Reduce Cover Photo Height */
	.fb-profile-cover,
	.fb-unified-header-card .profile-cover {
		height: 200px;
	}

	.fb-header-ambient-blur {
		height: 200px;
	}

	/* 2. Position Cover Buttons at Top Right (Out of Avatar's way) */
	.profile-cover-controls {
		top: 12px;
		bottom: auto;
		right: 12px;
		gap: 6px;
	}

	.fb-btn-cover-action,
	.profile-cover-controls a.btn-action {
		padding: 5px 10px;
		font-size: 12px;
		background: rgba(255, 255, 255, 0.9);
		backdrop-filter: blur(4px);
	}

	/* Hide text labels on super tight screens if needed, or keep small text */
	.profile-cover-controls a.btn-action span {
		font-size: 12px;
	}

	/* 3. Re-align Metadata Container */
	.fb-profile-header-content,
	.fb-unified-header-card .ossn-profile-usermetadata {
		flex-direction: column;
		align-items: center;
		text-align: center;
		padding: 0 16px 16px 16px;
	}

	/* 4. Scale down Avatar & pull it up cleanly */
	.fb-profile-avatar-wrapper,
	.fb-unified-header-card .profile-photo {
		width: 130px;
		height: 130px;
		margin-top: -65px;
		margin-left: 0;
	}

	/* 5. Center User Name & Metadata */
	.fb-profile-user-details,
	.ossn-profile-page-usermeta-area {
		padding-bottom: 4px;
		width: 100%;
	}

	.fb-user-fullname,
	.fb-unified-header-card .user-fullname {
		font-size: 22px;
		text-align: center;
	}

	.fb-user-username,
	.ossn-profile-role {
		font-size: 13px;
		text-align: center;
	}

	/* 6. Full-Width / Centered Action Buttons */
	.fb-profile-actions,
	.profile-menu {
		width: 100%;
		justify-content: center;
		flex-wrap: wrap;
		gap: 8px;
		margin-top: 8px;
		padding-bottom: 0;
	}

	.fb-profile-actions .fb-btn,
	.profile-menu .btn {
		flex: 1;
		justify-content: center;
		padding: 8px 12px;
		font-size: 14px;
	}

	/* 7. Mobile Navigation Dropdown Menu */
	.fb-profile-navigation-bar,
	.profile-menu-hr-container {
		padding: 8px 16px;
	}

	.profile-hr-menu ul {
		justify-content: flex-start;
	}
.profile-hr-menu .dropdown-toggle::after {
	display: none !important;
}


/* 2. Style the Mobile Hamburger Button */
.profile-hr-menu .dropdown-toggle {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	padding: 8px 12px;
	color: #050505;
	text-decoration: none;
	border-radius: 6px;
	transition: background 0.15s ease-in-out;
}

.profile-hr-menu .dropdown-toggle:hover {
	background-color: #f0f2f5;
	color: #0866ff;
	text-decoration: none;
}

/* 3. Clean up the Mobile Dropdown Menu Container */
.profile-hr-menu .dropdown-menu {
	border: none;
	border-radius: 8px;
	box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
	padding: 8px;
	margin-top: 4px;
}

.profile-hr-menu .dropdown-menu li a {
	padding: 10px 16px;
	border-radius: 6px;
	font-weight: 600;
	color: #050505;
	font-size: 14px;
}

.profile-hr-menu .dropdown-menu li a:hover {
	background-color: #f0f2f5;
	color: #0866ff;
}    
/* Position Save Button Bar at Top Left of Cover */
	#cover-menu {
		position: absolute !important;
		top: 12px !important;
		left: 12px !important;
		right: auto !important;
		bottom: auto !important;
		z-index: 25 !important;
		margin: 0 !important;
		padding: 0 !important;
	}

	/* Style as a compact floating action pill */
	#cover-menu .fb-btn-save-cover,
	#cover-menu .btn-success {
		padding: 6px 12px !important;
		font-size: 13px !important;
		font-weight: 600 !important;
		border-radius: 6px !important;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25) !important;
		display: inline-flex !important;
		align-items: center !important;
		gap: 6px !important;
		background-color: #42b72a !important; /* FB Green */
		border: none !important;
		color: #ffffff !important;
	}

	#cover-menu .fb-btn-save-cover i {
		font-size: 13px !important;
	}
   .profile-hr-menu .dropdown-menu {
        border: none !important;
        box-shadow: none !important;
    }

    /* Only show floating shadow when user taps to open the menu */
    .profile-hr-menu .dropdown-menu.show {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    } 
}
.fb-profile-tabs i {
	margin-right:0px;
}
/*************************************************
	WIDGET OVERRIDES FOR PROFILE SIDEBAR
**************************************************/

/* Base container style */
.ossn-profile-module-friends {
	text-align: left;
}

/* Apply grid ONLY when friends exist */
.ossn-profile-module-friends.has-friends {
	display: grid;
	grid-template-columns: repeat(3, 1fr);
	gap: 10px;
}

/* Remove grid entirely when there are no friends */
.ossn-profile-module-friends.no-friends {
	display: block;
	padding: 20px 0;
}

.ossn-profile-module-friends.no-friends .no-friends-text {
	font-size: 15px;
	color: #65676b;
	font-weight: normal;
	margin: 0;
}

.ossn-profile-module-friends a {
	text-decoration: none;
	color: #050505;
	display: block;
}

.ossn-profile-module-friends .user-image {
	width: 100%;
}

.ossn-profile-module-friends .user-image img {
	width: 100%;
	aspect-ratio: 1 / 1;
	object-fit: cover;
	border-radius: 8px;
	transition: filter 0.15s ease-in-out;
}

.ossn-profile-module-friends a:hover .user-image img {
	filter: brightness(0.9);
}

.ossn-profile-module-friends .user-name {
	font-size: 13px;
	font-weight: 600;
	color: #050505;
	margin-top: 6px;
	line-height: 1.2;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
}
/* 4. Photo Albums Widget (Empty / Default States) */
.ossn-profile-module-albums img {
	border-radius:8px;
}
.ossn-profile-module-albums h3 {
	font-size: 15px;
	color: #65676b;
	font-weight: 500;
	margin: 8px 0;
	text-align: center;
}


/* Profile Edit Layout Container */
.ossn-profile-edit-layout {
    background: #ffffff;
    border-radius: 8px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
}

.profile-edit-layout-title {
    font-size: 24px;
    font-weight: 700;
    color: #050505;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #e4e6eb;
}

/* Profile Edit Navigation Tabs Sidebar */
.profile-edit-tabs {
    display: flex;
    flex-direction: column;
    gap: 4px;
    background: #ffffff;
    padding: 4px;
    border-radius: 8px;
}

.profile-edit-tab-item {
    display: block;
    padding: 10px 14px;
    font-size: 15px;
    font-weight: 600;
    color: #65676b;
    text-decoration: none !important;
    border-radius: 6px;
    transition: background 0.2s ease, color 0.2s ease;
}

.profile-edit-tab-item:hover {
    background-color: #f2f2f2;
    color: #050505;
}

.profile-edit-tab-item-active {
    background-color: #e7f3ff !important;
    color: #1877f2 !important;
}

/* Form Styling inside Right Container */
.profile-edit-layout-right .ossn-edit-form label {
    font-size: 13px;
    font-weight: 600;
    color: #65676b;
    margin-bottom: 6px;
    display: block;
}

.profile-edit-layout-right .ossn-edit-form input[type="text"],
.profile-edit-layout-right .ossn-edit-form input[type="password"],
.profile-edit-layout-right .ossn-edit-form select {
    display: block;
    width: 100%;
    padding: 10px 12px;
    font-size: 15px;
    line-height: 1.5;
    color: #050505;
    background-color: #f0f2f5;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 6px;
    margin-bottom: 15px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.profile-edit-layout-right .ossn-edit-form input[type="text"]:focus,
.profile-edit-layout-right .ossn-edit-form input[type="password"]:focus,
.profile-edit-layout-right .ossn-edit-form select:focus {
    background-color: #ffffff;
    border-color: #1877f2;
    outline: 0;
    box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.2);
}

/* Radio Block & Custom Fields Alignment */
.profile-edit-layout-right .radio-block-container {
    margin-bottom: 15px;
}

.profile-edit-layout-right .radio-block {

}

.profile-edit-layout-right .radio-block input[type="radio"] {
    margin-right: 6px;
}

/* Save Submit Button */
.profile-edit-layout-right .ossn-edit-form input[type="submit"],
.profile-edit-layout-right .ossn-edit-form .btn-primary {
    background-color: #1877f2;
    border-color: #1877f2;
    color: #ffffff;
    font-weight: 600;
    padding: 8px 20px;
    font-size: 15px;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.profile-edit-layout-right .ossn-edit-form input[type="submit"]:hover,
.profile-edit-layout-right .ossn-edit-form .btn-primary:hover {
    background-color: #166fe5;
}