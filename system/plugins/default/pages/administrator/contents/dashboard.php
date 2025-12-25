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
 $genders = $users->genderTypes();

 $total = array();
 $online = array();
 foreach($genders as $gender) {
		$total[]	= false;
		$online[]	= false;
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
        		<div class="admin-dashboard-title"><?php echo ossn_print("users");?> (<span id="users-classified-graph-total"> --- </span>)</div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                        <div class="ossn-loading mx-auto mt-5 users-classified-graph-loader"></div>
               			<canvas id="users-classified-graph" class="d-none"></canvas>
                        <div id="userclassified-lineLegend"></div>         			
           	 	</div>
            </div>
        </div>

        <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("admin:users:unvalidated");?></div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height" id="admin-dashboard-unvalidated-text">
                         <div class="ossn-loading mx-auto mt-5"></div>
           	 	</div>
            </div>
        </div>
        
        
        <div class="col-lg-4 admin-dashboard-item">
        	<div class="admin-dashboard-box">
        		<div class="admin-dashboard-title"><?php echo ossn_print("online:users");?> (<span id="onlineusers-classified-graph-total"> --- </span>)</div>
            	<div class="admin-dashboard-contents center admin-dashboard-fixed-height">
                			<div class="ossn-loading mx-auto mt-5 onlineusers-classified-graph-loader"></div>
                        	<canvas id="onlineusers-classified-graph" class="d-none"></canvas>
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

<script>
$(window).on('load', function () {
	Ossn.PostRequest({
		'url': Ossn.site_url + 'administrator/xhr/unvalidated',
		'callback': function (result) {
				$('#admin-dashboard-unvalidated-text').html("<div class='text center'>"+parseInt(result.total)+'</div>');
		}
	});
});
</script>

<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/users'); ?>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/classfied', array('genders' => $genders)); ?>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/online/classfied', array('genders' => $genders)); ?>
