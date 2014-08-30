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
* Setting up a system locale
*/  
function bframework_locale(){
global $bframework_locale;
global $lang_code;
if(isset($_GET['lang']) && is_file(bframework_get_languages_path().'bframework.'.$_GET['lang'].'.php')){
    $lang_code = $_GET['lang'];
    include(bframework_get_languages_path().'bframework.'.$lang_code.'.php');
} else {
    $lang_code = 'en';
    include(bframework_get_languages_path().'bframework.en.php');
   }
}
/*
* Regestring a app locale
*/ 
function bframework_app_locale(){
global $bframework_app_locale;
global $lang_app_code;
if(isset($_GET['lang']) && is_file(bframework_get_app_languages_path().'bframework.'.$_GET['lang'].'.php')){
    $lang_app_code = $_GET['lang'];
    include(bframework_get_app_languages_path().'bframework.'.$lang_app_code.'.php');
} else {
    $lang_app_code = 'en';
    include(bframework_get_app_languages_path().'bframework.en.php');
   }
}
/*
* calling a locale
*/ 
bframework_locale();
bframework_app_locale();

/*
* Regestring a core locale
* @uses bframework_register_core_languages(<lang>);
*/ 
function bframework_register_core_languages($params = array()){
global $lang_code;
global $bframework_locale;
if(isset($params) && !empty($params)){
$bframework_locale[$lang_code] = $params;
   }
}
/*
* Regestring a locale
* @uses bframework_register_languages(<lang>);
*/ 
function bframework_register_languages($params = array()){
global $lang_app_code;
global $bframework_app_locale;
if(isset($params) && !empty($params)){
$bframework_app_locale[$lang_app_code] = $params;
   }
}
/*
* Regestring a core print locale
* @uses bframework_core_print('id');
*/ 
function bframework_core_print($id = ''){
global $lang_code;
global $bframework_locale;
if(isset($bframework_locale[$lang_code][$id]) && !empty($bframework_locale[$lang_code][$id])){
    return $bframework_locale[$lang_code][$id];
  } if(!isset($bframework_locale[$lang_code][$id])){
return $id;  
   }
}
/*
* Regestring a print application locale
* @uses bframework_print('id');
*/ 
function bframework_print($id = ''){
global $lang_app_code;
global $bframework_app_locale;
if(isset($bframework_app_locale[$lang_app_code][$id]) && !empty($bframework_app_locale[$lang_app_code][$id])){
    return $bframework_app_locale[$lang_app_code][$id];
  } if(!isset($bframework_app_locale[$lang_app_code][$id])){
return $id;  
   }
}