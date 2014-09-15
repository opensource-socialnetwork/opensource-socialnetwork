<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
    $settings = input('settings');
	if(empty($settings)){
	  $settings = 'list';	
	}
	switch($settings){		
    case 'list':
      echo ossn_view('components/OssnAds/pages/list');
	break;
	case 'add': 
       echo ossn_view('components/OssnAds/pages/add');	
	break;
	default:
    break;

	}	
?>
