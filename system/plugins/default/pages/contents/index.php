<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
<div class="row ossn-page-contents">
		<div class="col-md-6 home-left-contents">
			<div class="logo">
            	<img src="<?php echo ossn_theme_url();?>images/logo.png" />
            </div>	
            <div class="description">
            	<?php echo ossn_print('home:top:heading', array(ossn_site_settings('site_name'))); ?>
            </div>
            <div class="buttons">
            	<a href="<?php echo ossn_site_url('login');?>" class="btn btn-primary">Login</a>
                <a href="<?php echo ossn_site_url('resetlogin');?>" class="btn btn-warning">Reset Password</a>
            </div>
           	 <ul  class="some-icons">
                	<li><i class="fa fa-users"></i></li>
                	<li><i class="fa fa-comments-o"></i></li>
                	<li><i class="fa fa-envelope"></i></li>
                	<li><i class="fa fa-globe"></i></li>
                	<li><i class="fa fa-picture-o"></i></li>
                	<li><i class="fa fa-video-camera"></i></li>
                	<li><i class="fa fa-map-marker"></i></li>
                	<li><i class="fa fa-calendar"></i></li>
             </ul>
 	   </div>   
       <div class="col-md-6">
    	<?php 
			$contents = ossn_view_form('signup', array(
        					'id' => 'ossn-home-signup',
        				'action' => ossn_site_url('action/user/register')
	   	 	));
			$heading = "<p>".ossn_print('its:free')."</p>";
			echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('create:account'),
						'contents' => $heading.$contents,
			));
			?>	       			
       </div>     
</div>	
