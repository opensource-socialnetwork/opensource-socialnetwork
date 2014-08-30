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
* BFramework view form
* @uses bframework_view_form(array('attributes' => array(<attr>),'body' => <body>);
*/  
function bframework_form($params = array()){
if(isset($params['body'])){ $body = $params['body']; } else { $body = ''; }
if(isset($params['attributes'])){ $attr = $params['attributes']; } else { $attr = array(); }
$form = '<form '.bframework_args($attr).'>  <fieldset>'.$body.'</fieldset></form>';
return $form; 
}
/*
* BFramework built in core form view
* @uses bframework_view_core_form(form);
*/  
function bframework_view_core_form($form = ''){
if(isset($form) && !empty($form)){
return bframework_view(bframework_get_base_path().'views/forms/'.$form);
  }
} 
/*
* BFramework application form view
* @uses bframework_view_form(form);
*/  
function bframework_view_form($form = ''){
if(isset($form) && !empty($form)){
   return bframework_view(bframework_get_approot_path().'views/forms/'.$form);
  }
}
/*
* BFramework view input form
* @uses bframework_view_input(attr);
*/  
function bframework_view_input($params = ''){
if(isset($params) && is_array($params)){$input = '<input '.bframework_args($params).'/>';
return $input;
   }
}
/*
* BFramework view label
* @uses bframework_view_label(<attr>);
*/  
function bframework_view_label($params = ''){
if(isset($params) && is_array($params)){$label = '<label '.bframework_args($params['attributes']).'>'.$params['name'].'</label>';
return $label;
   }
}
/*
* BFramework view textarea
* @uses bframework_view_textarea(<attr>);
*/  
function bframework_view_textarea($params = '', $body = ''){
if(isset($params) && is_array($params)){$input = '<textarea '.bframework_args($params).'>'.$body.'</textarea>';
return $input;
   }
}
