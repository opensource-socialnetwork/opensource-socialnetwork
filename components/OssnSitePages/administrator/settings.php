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
 ?>
<div class="top-controls">
<a href="<?php echo ossn_site_url("administrator/component/OssnSitePages?settings=terms");?>" class="ossn-admin-button button-blue">
<?php echo ossn_print('site:terms');?></a>
<a href="<?php echo ossn_site_url("administrator/component/OssnSitePages?settings=about");?>" class="ossn-admin-button button-blue">
<?php echo ossn_print('site:about');?></a>
<a href="<?php echo ossn_site_url("administrator/component/OssnSitePages?settings=privacy");?>" class="ossn-admin-button button-blue">
<?php echo ossn_print('site:privacy');?></a>
</div>
<?php
    $settings = input('settings');
	if(empty($settings)){
	  $settings = 'terms';	
	}
	switch($settings){		
    case 'terms':
    $params = array(
					 'action' => ossn_site_url().'action/sitepage/edit/terms',
					 'component' => 'OssnSitePages',
					 'class' => 'ossn-admin-form'
						);
    echo ossn_view_form('terms', $params , false);	
	break;
	case 'about': 
    $params = array(
					 'action' => ossn_site_url().'action/sitepage/edit/about',
					 'component' => 'OssnSitePages',
					 'class' => 'ossn-admin-form'
						);
    echo ossn_view_form('about', $params , false);		
	break;
	default:
	case 'privacy': 
    $params = array(
					 'action' => ossn_site_url().'action/sitepage/edit/privacy',
					 'component' => 'OssnSitePages',
					 'class' => 'ossn-admin-form'
						);
    echo ossn_view_form('privacy', $params , false);		
	break;
	default:
    break;

	}	
?>
