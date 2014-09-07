<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
?>
<style> body { background:#E9EAED; } </style>
<div class="ossn-layout-group">
<div class="ossn-inner">
      <div class="coloum-left">
   &nbsp;
   <?php 
   if(ossn_is_hook('newsfeed', "left")){
	$newsfeed_left = ossn_call_hook('newsfeed', "left", NULL, array());
	echo implode('', $newsfeed_left);
   }
   ?>
      </div>  
      <div class="coloum-middle">
             <?php echo $params['content']; ?>
      </div>
     
     </div>
</div>