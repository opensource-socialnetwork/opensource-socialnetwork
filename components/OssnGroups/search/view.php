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
foreach($params['groups'] as $group){ ?>

<div class="ossn-view-users">
  <img src="<?php echo ossn_site_url("components/OssnGroups/images/search_group.png");?>" width='100' height="100"/>
 <div class="uinfo">
    <a class="userlink" href="<?php echo ossn_site_url();?>group/<?php echo $group->guid;?>"><?php echo $group->title;?></a>
 </div>
     	              
           
</div>


<?php } ?>