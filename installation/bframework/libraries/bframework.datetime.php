<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */
/*
 * Get time at diffrent formats
 *
 * @type type of time to display
 * @string date ( string $format [, int $timestamp = time() ] )
 * @php 5.4  getdate ([ int $timestamp = time() ] )
 * @param $params non array()
 * @access system
 */	 
function bframework_date_time($params = ''){
if(empty($params)){ 
   $timedate = date('d/m/Y - H:ia'); 
} elseif($params == 1){ 
   $timedate =  date('l dS F Y'); 
     } else { $timedate = date($params); 
   }
return $timedate;
}
/*
* Fetch a site born time
* @uses bframework_site_born_time();
*/ 
function bframework_site_born_time(){
global $Bframework;
if(!empty($Bframework->sitebron)){
    return $Bframework->sitebron;
   }
}
