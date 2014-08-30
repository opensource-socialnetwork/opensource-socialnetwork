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
 

echo '<div><div class="layout-installation"><h2>'.bframework_print('ossn:settings').'</h2><br /><div style="margin:0 auto; width:900px;">';
if(substr(PHP_VERSION, 0, 6) >= 5.3){
        echo '<div class="ossn-installation-message ossn-installation-success"> PHP '.PHP_VERSION.' </div>';
} else {
	  echo '<div class="ossn-installation-message ossn-installation-fail">You have old PHP '.PHP_VERSION.'. You need PHP 5.3 or Higher </div>';
      $error[] = 'php';
  
}
if(preg_match('/apache/i', $_SERVER["SERVER_SOFTWARE"])){
     echo '<div class="ossn-installation-message ossn-installation-success"> Apache Found </div>';
} else {
	  echo '<div class="ossn-installation-message ossn-installation-fail">Ossn can only be run on apache.</div>';
	 $error[] = 'apache';
}    
echo '<br />';
echo '<form action="'.bframework_get_url().'settings">';
if(!isset($error)){ 
        echo '<input style="float:right;" type="submit" value="Next" class="button-blue primary">';
} 

echo '</form></div><br /><br /></div>';
