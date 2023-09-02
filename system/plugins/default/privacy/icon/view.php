<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
   
  $class = '';
  if(isset($params['class']) && !empty($params['class'])){
	 $class = "class='{$params['class']}'"; 
  }
   $text = ossn_print("title:access:{$params['privacy']}");  
   if(isset($params['text']) && !empty($params['text'])){
	   $inner_text = $params['text'].' ';
   }
  if($params['privacy'] == OSSN_PUBLIC){
	echo "<span {$class} title='{$text}'>{$inner_text}<i class='fa fa-globe-americas'></i></span>";  
  } elseif($params['privacy'] == OSSN_FRIENDS){
	echo "<span {$class} title='{$text}'>{$inner_text}<i class='fa fa-users'></i></span>";  	  
  } elseif($params['privacy'] == OSSN_PRIVATE){
	echo "<span {$class} title='{$text}'>{$inner_text}<i class='fa fa-lock'></i></span>";  	  	  
  }