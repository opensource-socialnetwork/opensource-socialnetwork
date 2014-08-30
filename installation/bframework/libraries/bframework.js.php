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
* Load a javascripts from core
* @uses see doc's
*/ 
function bframework_view_core_js(){
if(isset($_GET['bframework_corejs']) && !empty($_GET['bframework_corejs'])){
    header('Content-type: text/javascript');        
return bframework_view(bframework_get_vendors_path().$_GET['bframework_corejs']);
    }
}
/*
* Load a javascripts from application
* @uses see doc's
*/ 
function bframework_view_js(){
if(isset($_GET['bframework_js']) && !empty($_GET['bframework_js'])){
    header('Content-type: text/javascript');        
return bframework_view(bframework_get_approot_path().'vendors/'.$_GET['bframework_js']);
    }
}