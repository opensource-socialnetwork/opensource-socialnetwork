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
* Fetch a base url directory
* @uses bframework_get_url();
*/ 
function bframework_get_url(){
global $Bframework;
if(!empty($Bframework->baseurl)){
    return $Bframework->baseurl;
   }
}
/*
* Fetch a core url directory
* @uses bframework_get_core_url();
*/ 
function bframework_get_core_url(){
global $Bframework;
if(!empty($Bframework->baseurl)){
    return $Bframework->baseurl.'bframework/';
   }
}
/*
* Fetch a app url directory
* @uses bframework_get_appurl();
*/ 
function bframework_get_appurl(){
global $Bframework;
if(!empty($Bframework->baseurl)){
    return $Bframework->baseurl.'application/';
   }
}
