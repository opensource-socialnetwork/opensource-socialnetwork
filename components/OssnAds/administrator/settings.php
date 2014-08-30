<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
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
