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
* Register a core css
* @uses bframework_resgiser_core_css(<file>);
*/ 
function bframework_register_core_css($file){
if(isset($file)){bframework_page_handler(array('handler' => 'css', 'file' => $file));}
}
/*
* Register a application  css
* @uses bframework_resgiser_core_css(<file>);
*/ 
function bframework_register_css($file){
if(isset($file)){bframework_page_handler(array('handler' => 'app_css', 'file' => $file));}
}
/*
* Regestring a default css
*/ 
function bframework_register_default_css(){
$default_css = array(
            'errors_app' => bframework_get_approot_path().'views/default/css/errors/errors.php',
			'errors' => bframework_get_base_path().'views/css/errors/errors.php'
			);
if(!is_file($default_css['errors_app'])){
bframework_register_core_css($default_css['errors']);
} else {
bframework_register_core_css($default_css['errors_app']);
  }
}  
/*
* Bframework fetch a all site css
* Merge a application css and core css in one file
*/ 
function bframework_get_css(){
header("Content-type: text/css");
$css = bframework_curl(bframework_get_url().'bframework/buddyexpress.php?bframework=css');
$app_css = bframework_curl(bframework_get_url().'application/start.php?bframework=app_css');
$all = $css.$app_css;
if(!empty($css)&& $_GET['system'] == bframework_site_born_time() && $_GET['view'] == 'all'){ 
 return $all; 
}
if(!empty($css)&& $_GET['system'] == bframework_site_born_time() && $_GET['view'] == 'app'){ 
 return $app_css; 
}
if(!empty($css)&& $_GET['system'] == bframework_site_born_time() && $_GET['view'] == 'core'){ 
 return $css; 
}
if(empty($_GET['system']) && !isset($_GET['system']) || empty($_GET['view']) && !isset($_GET['view'])){ 
   echo 'bad request'; 
    }
}

bframework_register_default_css();
/*
* Bframework html css tag generator
* $path is the css file
*/ 
function bframework_inc_css($path) {
if(isset($path) && !empty($path)){
    $style ='<link rel="stylesheet" href="'.$path.'" type="text/css"/>';
	return $style;
  }
}
/*
* Bframework css link
* $type 'all' for all site css 'core' for only core css
*/ 
function bframework_css_link($type = ''){
if(isset($type) && !empty($type)){ 
   return bframework_get_core_url().'css/bframework.'.bframework_site_born_time().'.css?view='.$type; 
   }
}
