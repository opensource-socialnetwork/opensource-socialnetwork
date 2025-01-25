<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$site_name  = ossn_site_settings('site_name');
$copyrights = ossn_site_settings('copyrights');

if (isset($params['title'])) {
    $title = $params['title'] . ' : ' . $site_name;
} else {
    $title = ossn_site_settings('site_name');
}
if (isset($params['contents'])) {
    $contents = $params['contents'];
} else {
    $contents = '';
}
$custom_settings = ossn_goblue_get_custom_logos_bgs_setting();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?php echo ossn_add_cache_to_url(ossn_theme_url().'images/favicon.ico');?>" type="image/x-icon" />	
    <title><?php echo $title; ?></title>
    
    <?php echo ossn_fetch_extend_views('ossn/endpoint'); ?>   
    <?php echo ossn_fetch_extend_views('ossn/admin/head'); ?>

    <script>
        <?php echo ossn_fetch_extend_views('ossn/admin/js/head'); ?>

    </script>
    <script>
        tinymce.init({
            toolbar: "bold italic underline alignleft aligncenter alignright bullist numlist image media link unlink emoticons autoresize fullscreen insertdatetime print spellchecker preview",
            selector: '.ossn-editor',
            plugins: "code image media link emoticons fullscreen insertdatetime print spellchecker preview lists",
            convert_urls: false,
            relative_urls: false,
            language: "<?php echo ossn_site_settings('language'); ?>",
		content_css: Ossn.site_url + 'css/view/bootstrap.min.css'
        });
    </script>

</head>
<body>
	<div class="ossn-page-loading-annimation">
    		<div class="ossn-page-loading-annimation-inner">
            	<div class="ossn-loading"></div>
            </div>
    </div>

	<div class="ossn-halt ossn-light"></div>
	<div class="ossn-message-box"></div>
	<div class="ossn-viewer" style="display:none"></div>
    
	<div class="header">
    	<div class="container">
        
        	<div class="row">
			<div class="col-6 col-lg-6">
            			<?php if(isset($custom_settings) && isset($custom_settings['logo_admin'])){ ?>
            			<img src="<?php echo ossn_add_cache_to_url(ossn_theme_url("logos_backgrounds/logo_admin_{$custom_settings['logo_admin']}"));?>"/>
                        <?php } else { ?>
            			<img src="<?php echo ossn_theme_url(); ?>images/logo_admin.jpg"/>                        
                        <?php } ?> 
            		</div>
                <?php if(ossn_isAdminLoggedin()){ ?>
            	<div class="col-6 col-lg-6 header-dropdown">
					<ul class="navbar-right">	
                        <div class="dropdown">
                        	<a id="dLabel" role="button" data-bs-toggle="dropdown" data-bs-target="#"><i class="fa fa-bars fa-3"></i></a> 
    						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
             					 <li><a class="dropdown-item" href="<?php echo ossn_site_url("action/admin/logout", true);?>"><?php echo ossn_print('admin:logout');?></a></li>
           					 </ul>
      		    		</div>
                     </ul>   
           		</div>
                <?php } ?>
        	</div>        
        
        </div>
    </div>
    <?php if(ossn_isAdminLoggedin()){ ?>
		<div class="topbar-menu">
    	  <?php echo ossn_view_menu('topbar_admin'); ?>
    	</div>
    <?php } ?>
	<div class="container">
    	<div class="row">
        	<div class="col-lg-12">
            	 <?php echo $contents; ?>
            </div>
        </div>
        
        <!-- footer -->
        <footer>
      	  	<div class="row">
        		<div class="col-lg-6">
 				<?php echo ossn_print('copyright'); ?> <a href="<?php echo ossn_site_url(); ?>"><?php echo $copyrights; ?></a>            			
           	 	</div>
                <div class="col-lg-6 text-right">
                	 <?php echo 'POWERED <a href="http://www.opensource-socialnetwork.org">OPEN SOURCE SOCIAL NETWORK</a>'; ?>
                </div>
        	</div>
        </footer>
        <!-- /footer -->
    </div> <!-- /container -->
</body>
</html>
