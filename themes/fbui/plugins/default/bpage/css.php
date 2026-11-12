/*******************************************************
   1. BUSINESS PAGE PROFILE - HEADER & BASICS
********************************************************/
.fbui-bpage-max-width {
    max-width: 1095px;
    margin-left: auto;
    margin-right: auto;
}

/* Hide default system inputs and elements */
#bpage-upload-photo-btn,
#save-position-cover-page,
#upload-cover-page,
.business-page #cover-menu {
    display: none;
}

/* Cover Repositioning Styles */
.business-page-cover {
    cursor: default;
}
.business-page-cover.repositioning {
    cursor: move;
}

/* Uploading States */
.business-page .user-cover-uploading {
    opacity: 0.5;
}
.business-page .user-photo-uploading {
    opacity: 0.5;
    background: rgba(255, 255, 255, 0.7);
}
.business-page .user-photo-uploading span {
    display: none;
}

/* Fix icon spacing inside buttons */
.business-page .unlike-page i,
.business-page .like-page i,
.business-page-cover-controls a i {
    margin-right: 6px;
}

/* Loading Spinner inside buttons */
.business-page-metadata .buttons .ossn-loading:not(:required) {
    -moz-animation: three-quarters-loader 1250ms infinite linear;
    -webkit-animation: three-quarters-loader 1250ms infinite linear;
    animation: three-quarters-loader 1250ms infinite linear;
    border: 3px solid #fff;
    border-right-color: transparent;
    border-radius: 50%;
    display: inline-block;
    width: 16px;
    height: 16px;
    margin-left: 8px;
    vertical-align: middle;
}
.bpage-meta-profile {
	margin-top: -85px; 
    margin-bottom: 20px;
}
/* --- Faded Background Layer --- */
.bpage-blurred-bg-container {
    height: 400px;
    z-index: 0;
}
.bpage-blurred-bg-img {
    background-size: cover;
    background-position: center;
    filter: blur(45px);
    transform: scale(1.1);
    opacity: 0.65;
}
.bpage-blurred-bg-overlay {
    background: linear-gradient(to bottom, rgba(255,255,255,0) 40%, rgba(255,255,255,1) 100%);
}

/* --- Cover Photo Layer --- */
.bpage-cover-main {
    height: 400px;
    background: #e4e6eb;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}
.bpage-hidden-btn {
    display: none;
}

/* --- Metadata & Profile Photo --- */
.bpage-metadata-zindex {
    z-index: 2;
}
.bpage-photo-zindex {
    z-index: 4;
}
.bpage-photo-container {
    width: 176px;
    height: 176px;
    padding: 4px;
}
.bpage-photo-upload-btn {
    width: 36px;
    height: 36px;
    cursor: pointer;
    margin-right: 12px;
    margin-bottom: 12px;
    transition: transform 0.2s ease;
}

/* --- Typography & Buttons --- */
.bpage-title-text {
    font-size: 32px;
    line-height: 1.1;
}
.bpage-btn-blue {
    background-color: #0866ff;
    border-color: #0866ff;
}
/*******************************************************
   2. BUSINESS PAGE MENU TABS (Horizontal Profile Nav)
********************************************************/
.bpage-menu-hr-container {
    width: 100%;
    background: transparent !important;
    border: none !important;
    padding-top:3px;
}

.bpage-hr-menu {
    border: none !important;
}

/* Use > ul to strictly target the main menu row, NOT the dropdowns! */
.bpage-hr-menu > ul {
    display: flex;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    list-style: none;
}

.bpage-hr-menu > ul > li {
    margin-right: 4px;
}

.bpage-hr-menu > ul > li > a {
    display: block;
    padding: 16px 16px;
    font-weight: 600;
    font-size: 15px;
    color: #65676b;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.15s ease, color 0.15s ease;
    margin-bottom: 4px; /* Small gap before bottom line */
}

.bpage-hr-menu > ul > li > a:hover {
    background: #f0f2f5;
    color: #050505;
}

/* Active Menu Tab State (Blue Underline) */
.bpage-hr-menu > ul > li.active > a,
.bpage-hr-menu > ul > li > a.active {
    color: #0866ff;
    position: relative;
    border-radius: 8px 8px 0 0;
    background: transparent !important;
}

.bpage-hr-menu > ul > li.active > a::after,
.bpage-hr-menu > ul > li > a.active::after {
    content: '';
    position: absolute;
    bottom: -4px; /* Aligns with the bottom edge of the header */
    left: 0;
    width: 100%;
    height: 3px;
    background-color: #0866ff;
    border-radius: 3px 3px 0 0;
}

/* -----------------------------------------
   Dropdown Menu Fixes 
------------------------------------------ */
.bpage-hr-menu .dropdown-toggle::after {
    display: none;
}

.bpage-hr-menu .dropdown-menu {
    display: none; /* Forces it to stay closed until clicked */
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: none;
    padding: 8px;
    margin-top: 0px;
    min-width: 180px;
}

/* Let Bootstrap open it normally when toggled */
.bpage-hr-menu .dropdown.show .dropdown-menu,
.bpage-hr-menu .dropdown.open .dropdown-menu,
.bpage-hr-menu .dropdown-menu.show {
    display: block;
}

.bpage-hr-menu .dropdown-menu li {
    display: block;
    width: 100%;
    margin-right: 0;
}

.bpage-hr-menu .dropdown-menu li a {
    display: block;
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 500;
    margin-bottom: 0;
    color: #050505;
}

.bpage-hr-menu .dropdown-menu li a:hover {
    background: #f0f2f5;
}
/*******************************************************
   3. BOTTOM CONTENT & SIDEBAR WIDGETS
********************************************************/
.bpage-bottom {
    margin-top: 15px;
}

.business-page-desc {
    background: #ffffff;
    padding: 16px;
    border-radius: 10px;
    border: 1px solid #e4e6eb;
    min-height: 70px;
    color: #050505;
}

.business-page-about li {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    color: #050505;
}

.business-page-about .fa-solid,
.business-page-about .fa {
    width: 24px;
    font-size: 20px;
    color: #8c939d;
    margin-right: 12px;
    text-align: center;
}

.business-page-about p {
    text-align: left;
    margin: 0;
    color: #050505;
}

/* Custom Wall Tweaks inside Business Page */
.bpage-bottom .ossn-wall-container .controls {
    margin-top: 0px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
    border-bottom: 0px;     
    padding: 10px;   
}
.bpage-bottom .ossn-wall-container input[type='submit'] {
    margin: 5px 0;
}
.bpage-bottom .ossn-wall-container textarea {
    margin-bottom: 0px;
}

/* Sidebar Menu Icons */
.menu-section-bpage i:before {
    font-family: 'Font Awesome 5 Free';
    content: "\f1ad" !important;
}
.menu-section-item-businesspage-all:before {
    font-family: 'Font Awesome 5 Free';
    content: "\f0cb" !important;
}
.menu-section-item-businesspage-add:before {
    font-family: 'Font Awesome 5 Free';
    content: "\f067" !important;
}
.menu-section-item-businesspage-liked:before {
    content: "\f164" !important;
}
.menu-section-item-businesspage-mypages:before {
    content: "\f013" !important;
}

/*******************************************************
   4. BUSINESS PAGES DIRECTORY (List View)
********************************************************/
.business-pages-list {
    --biz-bg-card: #ffffff;
    --biz-bg-img: #f8f9fa;
    --biz-text-main: #212529;
    --biz-text-muted: #6c757d;
    --biz-border: #e4e6eb;
    --biz-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    --biz-shadow-hover: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.business-pages-list.white-darkmode,
.white-darkmode .business-pages-list {
    --biz-bg-card: var(--bg-inner-containers);
    --biz-bg-img: var(--bg-image-container);
    --biz-text-main: var(--main-title-color);
    --biz-text-muted: var(--text-color);
    --biz-border: var(--main-border-color);
    --biz-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
    --biz-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
}

.business-pages-list .object-fit-cover { object-fit: cover; }
.business-pages-list .absolute-fill { position: absolute; top: 0; left: 0; }
.business-pages-list .text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.business-pages-list .card {
    background-color: var(--biz-bg-card) !important;
    border: 1px solid var(--biz-border) !important;
    box-shadow: var(--biz-shadow) !important;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.business-pages-list .hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: var(--biz-shadow-hover) !important;
}

.business-pages-list .img-holder { background-color: var(--biz-bg-img) !important; }
.business-pages-list .business-title-link { color: var(--biz-text-main) !important; font-weight: 600; }
.business-pages-list .card-text,
.business-pages-list .text-secondary,
.business-pages-list .business-email-link { color: var(--biz-text-muted) !important; }
.business-pages-list .border-top { border-top-color: var(--biz-border) !important; }

.business-pages-list .biz-like-badge {
    background-color: var(--biz-bg-img) !important;
    border-color: var(--biz-border) !important;
    color: var(--biz-text-main) !important;
}

.white-darkmode .business-pages-list .biz-like-badge {
    background-color: var(--bg-image-container) !important;
    border-color: var(--main-border-color) !important;
    color: var(--main-title-color) !important;
}

/*******************************************************
   5. BUSINESS PAGE EDIT & SETTINGS
********************************************************/
.bpage-header-card {
    background-color: #ffffff;
    border: 1px solid #e4e6eb;
    border-radius: 10px;
    padding: 1.5rem;
}

.bpage-title { color: #050505; }
.border-color-adapt { border-color: #e4e6eb !important; }

/* Edit Tabs Styling */
.custom-bpage-tabs { gap: 8px; border: none; }
.custom-bpage-tabs .nav-link {
    border-radius: 6px;
    font-weight: 600;
    color: #65676b;
    padding: 0.6rem 1rem;
    background-color: #f0f2f5;
    border: 1px solid #e4e6eb;
    transition: all 0.2s ease-in-out;
}
.custom-bpage-tabs .nav-link:hover { color: #0866ff; background-color: #e4e6eb; }
.custom-bpage-tabs .nav-link.active {
    color: #ffffff !important;
    background-color: #0866ff !important;
    border-color: #0866ff !important;
    box-shadow: 0 2px 4px rgba(8, 102, 255, 0.25);
}

.custom-bpage-tabs .nav-link.tab-danger { color: #dc3545; }
.custom-bpage-tabs .nav-link.tab-danger.active {
    color: #ffffff !important;
    background-color: #dc3545 !important;
    border-color: #dc3545 !important;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.25);
}

.bpage-card {
    background-color: #ffffff;
    border: 1px solid #e4e6eb !important;
}

/* Dark Mode Overrides for Edit Settings */
.white-darkmode .bpage-header-card { background-color: #242526 !important; border-color: #3a3b3c !important; }
.white-darkmode .bpage-title { color: #e4e6eb !important; }
.white-darkmode .border-color-adapt { border-color: #3a3b3c !important; }
.white-darkmode .custom-bpage-tabs .nav-link { background-color: #3a3b3c; border-color: #4e4f50; color: #b0b3b8; }
.white-darkmode .custom-bpage-tabs .nav-link:hover { background-color: #4e4f50; color: #ffffff; }
.white-darkmode .custom-bpage-tabs .nav-link.active { background-color: #2374e1 !important; border-color: #2374e1 !important; color: #ffffff !important; }
.white-darkmode .custom-bpage-tabs .nav-link.tab-danger.active { background-color: #e41e3f !important; border-color: #e41e3f !important; }
.white-darkmode .bpage-card { background-color: #242526 !important; border-color: #3a3b3c !important; color: #e4e6eb !important; }
.white-darkmode .bpage-readonly-input,
.white-darkmode .form-control { background-color: #3a3b3c !important; color: #e4e6eb !important; border-color: #4e4f50 !important; }

/* Misc Fixes */
#token-input-bpage-friend-input {
    background: none;
    border: 0;
}

@media (max-width: 768px) {
    .business-page-cover-img {
        top: 0 !important;
        left: 0 !important;
        height: 100% !important;
        width: 100% !important;
        object-fit: cover !important;
        transform: none !important;
    }
    
    /* Ensure the mobile container has a safe height */
    .business-page-cover {
        height: 250px !important; 
    }
}
@media (max-width: 768px) {
    /* Move cover controls to the top right on mobile to avoid avatar collision */
    .business-page-cover-controls {
        bottom: auto !important;
        top: 12px !important;
        right: 12px !important;
        margin: 0 !important;
        display: flex;
        flex-direction: column; /* Stacks the buttons neatly if there are multiple */
        gap: 8px;
        align-items: flex-end;
    }
    
    /* Make the buttons slightly more compact for mobile */
    .business-page-cover-controls .btn {
        padding: 6px 10px !important;
        font-size: 13px !important;
    }
}
/* Ensure the cover controls container sits on top of everything in the header */
.business-page-cover-controls {
    z-index: 10 !important;
    position: absolute !important;
}

/* Ensure individual buttons inside are fully interactive */
.business-page-cover-controls .btn {
    position: relative;
    z-index: 11;
    pointer-events: auto !important;
}

/* Keep metadata below the controls */
.bpage-metadata-zindex {
    z-index: 2;
}