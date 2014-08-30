<?php
/**
 * Buddyexpress Avatar
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2013 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://www.buddyexpress.net/bavatar/
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */
function buddyexpress_bavatar($email = '', $size =''){
if(!isset($size) && empty($size)){
$size = 'full';
} if(isset($email) && !empty($email)){
$user = file_get_contents("http://www.buddyexpress.net/bavatar/api_token.b?user={$email}");
   } 
   if($user){
   $link = "http://www.buddyexpress.net/bavatar/{$size}/{$user}.jpg";
   return $link;
  }
}  
?>