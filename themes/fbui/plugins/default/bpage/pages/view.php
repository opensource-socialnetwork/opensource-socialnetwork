<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   OPENTEKNIK  LLC, COMMERCIAL LICENSE, COMMERCIAL LICENSE https://www.openteknik.com/license/commercial-license-v1
 * @link      https://www.opensource-socialnetwork.org/
 */
$cover_top = '';
if(!empty($params['page']->cover_top)){
	$cover_top = "top:{$params['page']->cover_top};";
}
$cover_left = '';
if(!empty($params['page']->cover_left)){
	$cover_left = "left:{$params['page']->cover_left};";
}
$like = new \Ossn\Component\BusinessPage\Likes;
$total_likes = $like->CountLikes($params['page']->guid);
if(empty($total_likes)){
	$total_likes = 0;	
}
$cats = business_page_categories();
$cover_rh = '';
if(isset($params['page']->cover_entity_guid) && empty($params['page']->cover_entity_guid) || !isset($params['page']->cover_entity_guid)){
	$cover_rh = ' d-none';	
}
$bluetick = ossn_plugin_view('bpage/verified', array(
			'page' => $params['page'],
));
$is_liked_check = false;
if(ossn_isLoggedin()){
	$is_liked_check = $like->isLiked($params['page']->guid, ossn_loggedin_user()->guid);
	if($is_liked_check){
		fbui_add_user_shortcut(ossn_loggedin_user()->guid, 'businesspage', $params['page']->guid);	
	}
}
?>

<div class="business-page fbui-profile-page-wrapper w-100">
    
    <!-- FULL WIDTH HEADER BACKGROUND -->
    <div class="fbui-profile-header bg-white shadow-sm w-100 position-relative">
        
        <!-- THE FACEBOOK FADED/BLURRED SIDES EFFECT (Always 100% width) -->
        <div class="position-absolute top-0 start-0 w-100 overflow-hidden bpage-blurred-bg-container">
            <div class="position-absolute w-100 h-100 bpage-blurred-bg-img" style="background-image: url('<?php echo $params['page']->coverURL();?>');"></div>
            <div class="position-absolute w-100 h-100 top-0 start-0 bpage-blurred-bg-overlay"></div>
        </div>

        <!-- COVER PHOTO (Centered using fbui-bpage-max-width) -->
        <div class="fbui-cover-wrapper position-relative fbui-bpage-max-width bpage-cover-zindex">
            <div id="container" class="business-page-cover position-relative overflow-hidden shadow-sm bpage-cover-main">
                
                <div class="business-page-cover-controls position-absolute bottom-0 end-0 m-3 z-3">                        
                    <?php if(ossn_isLoggedin() && ($params['page']->owner_guid == ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate())){ ?>
                    
                    <a href="javascript:void(0);" onclick="Ossn.Clk('.coverfile');" class="btn btn-light btn-sm fw-semibold shadow-sm px-3 py-2 rounded-2 me-1" id="change-bpcover-btn">
                        <i class="fa-solid fa-camera me-2"></i><?php echo ossn_print('bpage:change:cover');?>
                    </a>
                    
                    <a href="javascript:void(0);" id="reposition-cover-page" class="btn btn-light btn-sm fw-semibold shadow-sm px-3 py-2 rounded-2 me-1 <?php echo $cover_rh;?>">
                        <i class="fa-solid fa-arrows-up-down-left-right me-2"></i><?php echo ossn_print('bpage:reposition');?>
                    </a>
                    
                    <a href="javascript:void(0);" id="save-position-cover-page" class="btn btn-primary btn-sm fw-semibold shadow-sm px-3 py-2 rounded-2 bpage-hidden-btn">
                        <i class="fa-solid fa-check me-2"></i><?php echo ossn_print('bpage:save:position');?>
                    </a>            
                    
                    <?php } ?>
                </div>
                <?php
                    echo ossn_view_form('bpage/cover', array(
                            'action' => ossn_site_url('action/bpage/cover/add'),
                            'params' => $params,
                            'id' => 'upload-cover-page',
                         ))
                    ?>
                <!-- Note: The top/left dynamic styles must stay inline -->
                <img id="draggable" class="business-page-cover-img position-absolute w-100" src="<?php echo $params['page']->coverURL();?>" data-guid="<?php echo $params['page']->guid;?>" style='<?php echo $cover_top; ?><?php echo $cover_left; ?>' />
            </div>
        </div>

        <!-- PROFILE METADATA & BUTTONS (Centered using fbui-bpage-max-width) -->
        <div class="business-page-metadata position-relative fbui-bpage-max-width px-4 pb-0 pt-2 bpage-metadata-zindex">
            <div class="d-flex flex-column flex-md-row align-items-center align-items-md-end text-center text-md-start position-relative bpage-meta-profile">
                
                <!-- LOGO / PROFILE PHOTO -->
                <div class="business-page-photo position-relative mb-3 mb-md-0 me-md-4 bpage-photo-zindex">
                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center bpage-photo-container">
                        <img data-fancybox href="<?php echo $params['page']->photoURL('master');?>" class="logo-page rounded-circle w-100 h-100 object-fit-cover cursor-pointer" src="<?php echo $params['page']->photoURL();?>" />
                    </div>
                    <?php if(ossn_isLoggedin() && ($params['page']->owner_guid == ossn_loggedin_user()->guid || ossn_loggedin_user()->canModerate())){ ?>
                    <div class="upload-photo position-absolute bottom-0 end-0 bg-light rounded-circle shadow border d-flex align-items-center justify-content-center bpage-photo-upload-btn">
                        <span onclick="Ossn.Clk('#bpage-upload-photo-btn');" title="Change Photo"><i class="fa-solid fa-camera text-dark"></i></span>
                        <?php 
                            echo ossn_view_form('bpage/photo', array(
                                'action' => ossn_site_url('action/bpage/photo/add'),
                                'params' => $params,
                                'id' => 'upload-photo-page',
                                ));
                        ?>
                    </div>
                    <?php } ?>                                            
                </div>

                <!-- TITLE & LIKES -->
                <div class="subdata flex-grow-1 mb-3 mb-md-0 pb-md-3">
                    <div class="name d-flex align-items-center justify-content-center justify-content-md-start flex-wrap fw-bold text-dark gap-2 bpage-title-text">
                        <span><?php echo $params['page']->title;?></span><?php echo $bluetick;?>
                    </div>
                    <div class="page-likes text-muted fw-semibold fs-6 mt-1">
                        <?php echo ossn_print('bpage:likes', [business_page_like_formatter($total_likes)]);?>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="buttons d-flex justify-content-center align-items-center gap-2 pb-md-3">
                    <?php if(ossn_isLoggedin() && (ossn_loggedin_user()->guid == $params['page']->owner_guid || ossn_isAdminLoggedin())){ ?>
                    <a href="<?php echo ossn_site_url("page/edit/{$params['page']->guid}");?>" class="btn btn-light fw-semibold px-3 py-2 d-flex align-items-center gap-2 border shadow-sm">
                        <i class="fas fa-pencil"></i><?php echo ossn_print('bpage:edit');?>
                    </a>
                    <?php } ?>
                    
                    <?php if(ossn_isLoggedin()){ ?>
                        <?php if(!$is_liked_check){ ?>
                        <a href="javascript:void(0);" class="btn btn-primary fw-semibold px-4 py-2 d-flex align-items-center gap-2 shadow-sm like-page bpage-btn-blue" data-guid="<?php echo $params['page']->guid;?>">
                            <i class="fa fa-thumbs-up"></i><?php echo ossn_print('ossn:like');?>
                        </a>           
                        <?php } else { ?>
                        <a href="javascript:void(0);" class="btn btn-light fw-semibold px-4 py-2 d-flex align-items-center gap-2 shadow-sm border unlike-page" data-guid="<?php echo $params['page']->guid;?>">
                            <i class="fa fa-thumbs-down"></i><?php echo ossn_print('ossn:unlike');?>
                        </a>                            
                        <?php } ?>
                    <?php } ?> 
                </div>
            </div>

            <!-- DIVIDER LINE -->
            <hr class="m-0 text-secondary opacity-25">

            <!-- NAVIGATION TABS -->
            <div class="bpage-menu-hr-container border-0 bg-transparent m-0 rounded-0">
                <div class="bpage-hr-menu border-0 p-0 d-none d-lg-block">
                    <?php echo ossn_plugin_view('menus/business_page_profile', array('menu_width' => 60)); ?>
                </div>
                <div class="bpage-hr-menu border-0 p-0 d-none d-md-block d-lg-none">
                    <?php echo ossn_plugin_view('menus/business_page_profile', array('menu_width' => 40)); ?>
                </div>
                <div class="bpage-hr-menu border-0 p-0 d-none d-sm-block d-md-none">
                    <?php echo ossn_plugin_view('menus/business_page_profile', array('menu_width' => 25)); ?>
                </div>
                <div class="bpage-hr-menu border-0 p-0 d-block d-sm-none">
                    <?php echo ossn_plugin_view('menus/business_page_profile', array('menu_width' => 1)); ?>
                </div>
            </div>
        </div>
    </div> <!-- / END FULL WIDTH HEADER -->

    <!-- BOTTOM CONTENT SECTION (Centered using fbui-bpage-max-width) -->
    <div class="container bpage-content-wrapper mt-4 px-0 px-md-3 fbui-bpage-max-width">
        <?php echo ossn_plugin_view('bpage/view/bottom', $params); ?>
    </div>
</div>