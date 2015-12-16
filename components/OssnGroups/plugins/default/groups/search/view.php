<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
if ($params['groups']) {
	echo "<div class='group-search-items'>";
    foreach ($params['groups'] as $group) {
		$owner = ossn_user_by_guid($group->owner_guid);
        ?>
		
        <div class="row">
        	<div class="col-md-2 col-sm-2 col-xs-4">
	            <img src="<?php echo ossn_site_url("components/OssnGroups/images/search_group.png"); ?>" width="100" height="100"/>
            </div>
			<div class="col-md-10 col-sm-10 col-xs-8">
	            <div class="group-search-details">
    	            <a class="group-name" href="<?php echo ossn_site_url(); ?>group/<?php echo $group->guid; ?>"><?php echo $group->title; ?></a>
        	        <p class="ossn-group-search-by"><?php echo ossn_print('ossn:group:by');?><a href="<?php echo $owner->profileURL();?>"><?php echo $owner->fullname;?></a></p>
           	 	</div>
			</div>

        </div>


    <?php
    }
	echo "</div>";
}
?>
