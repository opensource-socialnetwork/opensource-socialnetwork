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
 ossn_load_external_js('chart.js', 'admin');
 ossn_load_external_js('chart.legend.js', 'admin');
 
 $users = new OssnUser;
 $genders = $users->getGenders();

 $total = array();
 $online = array();
 foreach($genders as $gender) {
		$total[]	= $users->countByGender($gender);
		$online[]	= $users->onlineByGender($gender, true);
 }
 foreach($total as $k => $t){
		if($t === false){
			$total[$k] = 0;	
		}
 }
 foreach($online as $k => $o){
		if($o === false){
			$online[$k] = 0;	
		}
 }
 $unvalidated = $users->getUnvalidatedUSERS('', true);
 if(!$unvalidated){
		$unvalidated = 0; 
 }
 $flush_cache = ossn_site_url("action/admin/cache/flush", true);
?>
<div class="ossn-admin-dsahboard">
	<div class="row">
    
    	<div class="col-lg-12 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("users");?></div>
            	<div class="admin-dashboard-contents">
            			<canvas id="users-count-graph"></canvas>
                        <div id="usercount-lineLegend"></div>
           	 	</div>
            </div>
        </div>

    </div>
    
    <div class="row margin-top-10">
            <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("users");?> (<?php echo array_sum($total); ?>)</div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
               			<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>         			
           	 	</div>
            </div>
        </div>

        <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("admin:users:unvalidated");?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center">
                        	<?php echo $unvalidated;?>
                        </div>                     
           	 	</div>
            </div>
        </div>
        
        
        <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("online:users");?> (<?php echo array_sum($online);?>)</div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        	<canvas id="onlineusers-classified-graph"></canvas>
                            <div id="onlineuserclassified-lineLegend"></div>     
           	 	</div>
            </div>
        </div>
                
    </div>
	
    <div class="row">
 
         <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box admin-dashboard-box-small">
        		<div class="admin-dashboard-title"><?php echo ossn_print('components'); ?></div>
            	<div class="admin-dashboard-contents admin-dashboard-contents-small center admin-dashboard-fixed-height">
                        <div class="text center">
                        	<?php echo ossn_total_components(); ?>
                        </div>                 
           	 	</div>
            </div>
        </div>   
 
         <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box admin-dashboard-box-small">
        		<div class="admin-dashboard-title"><?php echo ossn_print('themes'); ?></div>
            	<div class="admin-dashboard-contents admin-dashboard-contents-small center admin-dashboard-fixed-height">
                        <div class="text center">
                            <?php echo ossn_site_total_themes(); ?>
                        </div>               
           	 	</div>
            </div>
        </div>   
 
          <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box admin-dashboard-box-small">
        		<div class="admin-dashboard-title"><?php echo ossn_print('my:files:version'); ?></div>
            	<div class="admin-dashboard-contents admin-dashboard-contents-small center admin-dashboard-fixed-height">
                        <div class="text center">
                            <?php echo ossn_package_information()->version; ?>
                        </div>                     
           	 	</div>
            </div>
        </div>   
            
    </div>
    
    <div class="row">
          <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box admin-dashboard-box-small">
        		<div class="admin-dashboard-title"><?php echo ossn_print('available:updates'); ?></div>
            	<div class="admin-dashboard-contents admin-dashboard-contents-small center admin-dashboard-fixed-height">
                        <div class="text center avaiable-updates">
                           <div class="loading-version"></div>
                        </div>                       
           	 	</div>
            </div>
        </div>       
    
          <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box admin-dashboard-box-small">
        		<div class="admin-dashboard-title"><?php echo ossn_print('my:version'); ?></div>
            	<div class="admin-dashboard-contents admin-dashboard-contents-small center admin-dashboard-fixed-height">
                        <div class="text center">
                            <?php echo ossn_site_settings('site_version'); ?>
                        </div>                     
           	 	</div>
            </div>
        </div>     
          <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box admin-dashboard-box-small">
        		<div class="admin-dashboard-title"><?php echo ossn_print('admin:cache'); ?></div>
            	<div class="admin-dashboard-contents admin-dashboard-contents-small center admin-dashboard-fixed-height">
                        <div class="text center">
                           	<a href="<?php echo $flush_cache;?>" class="btn btn-success btn-sm"><?php echo ossn_print('admin:flush:cache'); ?></a>
                        </div>                    
           	 	</div>
            </div>
        </div>   
                    
    </div>
</div>

<!-- <div class="ossn-message-developers">
  <h2> News from Developers</h2>
  Hi this is mesage from our site
</div> -->


<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/users'); ?>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/classfied', array('genders' => $genders, 'total' => $total)); ?>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/online/classfied', array('genders' => $genders, 'total' => $online)); ?>
