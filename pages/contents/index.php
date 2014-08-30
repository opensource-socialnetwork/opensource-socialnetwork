<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
 ?>
      <div class="home-left-contents"> 
       <h1><?php echo ossn_print('home:top:heading',array(ossn_site_settings('site_name'))); ?> </h1>
       <img src="<?php echo ossn_site_url();?>themes/default/images/home-people.png"  />
      </div>
    <div class="home-right-contents">
      <h1> <?php echo ossn_print('create:account');?> </h1>
      <div class="h1-bottom"> <?php echo ossn_print('its:free');?> </div><br />
           <?php echo  ossn_view_form('signup', array(
													  'id' => 'ossn-home-signup',
													  'action' => ossn_site_url('action/user/register')
													  ));?>
    </div>  
      
