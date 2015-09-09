<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 ossn_load_external_js('chart.js', 'admin');
 ossn_load_external_js('chart.legend.js', 'admin');
 
 $users = new OssnUser;
 $total = array(
				$users->countByGender(),
				$users->countByGender('female')
				);
 $online = array(
				 $users->onlineByGender('male', true),
				 $users->onlineByGender('female', true)
				 );
 
 $unvalidated = $users->getUnvalidatedUSERS('', true);
 $flush_cache = ossn_site_url("action/admin/cache/flush", true);
?>
<div class="ossn-admin-dsahboard">
	<div class="row">
    
    	<div class="col-md-12 admin-dashboard-item">
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
            <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("users");?> (<?php echo array_sum($total); ?>)</div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
               			<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>         			
           	 	</div>
            </div>
        </div>

        <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("admin:users:unvalidated");?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center">
                        	<?php echo $unvalidated;?>
                        </div>
						<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>                         
           	 	</div>
            </div>
        </div>
        
        
        <div class="col-md-4 admin-dashboard-item">
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
 
         <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print('components'); ?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center">
                        	<?php echo ossn_total_components(); ?>
                        </div>
						<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>                         
           	 	</div>
            </div>
        </div>   
 
         <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print('themes'); ?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center">
                            <?php echo ossn_site_total_themes(); ?>
                        </div>
						<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>                         
           	 	</div>
            </div>
        </div>   
 
          <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print('my:files:version'); ?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center">
                            <?php echo ossn_package_information()->version; ?>
                        </div>
						<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>                         
           	 	</div>
            </div>
        </div>   
            
    </div>
    
    <div class="row">
          <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print('available:updates'); ?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center avaiable-updates">
                           <div class="loading-version"></div>
                        </div>
						<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>                         
           	 	</div>
            </div>
        </div>       
    
          <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print('my:version'); ?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center">
                            <?php echo ossn_site_settings('site_version'); ?>
                        </div>
						<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>                         
           	 	</div>
            </div>
        </div>     
          <div class="col-md-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print('admin:cache'); ?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="text center">
                           	<a href="<?php echo $flush_cache;?>" class="btn btn-primary"><?php echo ossn_print('admin:flush:cache'); ?></a>
                        </div>
						<canvas id="users-classified-graph"></canvas>
                        <div id="userclassified-lineLegend"></div>                         
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
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/classfied', array('total' => $total)); ?>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/online/classfied', array('total' => $online)); ?>
