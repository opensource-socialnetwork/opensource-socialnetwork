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
$pages = range(1, $params['total']);
  unset($_GET['h']);
  unset($_GET['p']);
  unset($_GET['offset']);
   if(count($_GET)) {
     $args_url = '';
      foreach ($_GET as $key => $value) {
          if ($key != 'page') {
             $args_url .= '&'.$key.'='.$value;
          }
       }
    }
if(count($pages) !== 1){	
echo '<div class="ossn-pagination">';
foreach($pages as $page){
  if($page == $params['offset']){
     $slected = 'class="selected"';
     $url = "?offset={$page}{$args_url}";
     echo "<a href='{$url}' class='ossn-pagination-page'><li {$slected}>{$page}</li></a>";	 
  } else {
	 $url = "?offset={$page}{$args_url}";
     echo "<a href='{$url}' class='ossn-pagination-page'><li>{$page}</li></a>";	  
  }
 }
echo '</div>';
}