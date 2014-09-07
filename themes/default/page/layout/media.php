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
<style>
body { background:#fff;}
</style>
<div class="ossn-layout-media"><br />
 <div class="content">  
   <?php echo $params['content']; ?>
  </div>
  <div class="sidebar">
        <?php 
	 if(com_is_active('OssnAds')){	
		echo ossn_view('components/OssnAds/page/view');
	 }
		?>
  </div> 
</div>