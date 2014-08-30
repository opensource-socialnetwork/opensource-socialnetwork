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
* Return a div
* @uses: for start  bframework_div(array('attr' => array(<attributes>)));
* @uses: for close bframework_div(array('close' => 'close'));
*/ 
function bframework_div($params = array()){
$attr = $params;
if(!empty($attr['attr']) && isset($attr['attr'])){
   $attributes = bframework_args($attr['attr']);
   $result = '<div '.$attributes.'>';
   return $result;
} if($attr['close'] == 'close'){
  $result = '</div>';
  return $result;
  }
}
/*
* Return a span
* @uses: for start  bframework_span(array('attr' => array(<attributes>)));
*/ 
function bframework_span($params = array()){
$attr = $params;
if(!isset($attr['body'])){ $body = ''; } else { $body = $attr['body']; }
if(!empty($attr['attr']) && isset($attr['attr'])){
   $attributes = bframework_args($attr['attr']);
   $result = '<span '.$attributes.'>'.$body.'</span>';
    return $result;
}
}
/*
* Return a meta
* @uses: for start  bframework_meta(array('attr' => array(<attributes>)));
*/ 
function bframework_meta($params = array()){
$attr = $params;
if(!empty($attr['attr']) && isset($attr['attr'])){
   $attributes = bframework_args($attr['attr']);
   $result = '<meta '.$attributes.'/>';
   return $result;
   }
}
