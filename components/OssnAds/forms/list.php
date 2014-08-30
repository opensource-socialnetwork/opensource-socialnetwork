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

$ads = new OssnAds;
$pagination = new OssnPagination;
$pagination->setItem($ads->getAds());
?>
<div class="top-controls">
<a href="<?php echo ossn_site_url("administrator/adduser");?>" class="ossn-admin-button button-green"><?php echo ossn_print('add'); ?></a>
<input type="submit" class="ossn-admin-button button-red" value="Delete" />
</div>
<table class="table">  
<tbody>
  <tr class="table-titles">
    <td> </td>
    <td><?php echo ossn_print('ad:title'); ?></td>
    <td><?php echo ossn_print('ad:site:url'); ?></td>
    <td><?php echo ossn_print('ad:clicks'); ?></td>
    <td><?php echo ossn_print('ad:browse'); ?></td>
    <td><?php echo ossn_print('edit'); ?></td>
  </tr>
  <?php foreach($pagination->getItem() as $ads){
	  ?>
  <tr>
    <td><input type="checkbox" /></td>
    <td><?php echo $ads->title;?></td>
    <td><?php echo $ads->description;?></td>
    <td> 32</td>
    <td><a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=view&id={$ads->guid}");?>">
	<?php echo ossn_print('ad:browse'); ?></a></td>
    <td><a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=edit&id={$ads->guid}");?>">
	<?php echo ossn_print('edit'); ?></a></td>

  </tr>
  <?php } ?>
  </tbody>
</table>
<?php echo $pagination->pagination();?>
