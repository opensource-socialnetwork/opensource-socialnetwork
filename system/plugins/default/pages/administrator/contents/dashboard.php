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
<div class="ossn-admin-dashboard">
        <div class="row main-analytics-row">
            <div class="col-lg-8">
                <div class="graph-card-main">
                    <div class="admin-dashboard-title"><?php echo ossn_print("users");?></div>
                    <hr class="my-3 opacity-25">
                    <div class="admin-dashboard-contents">
                        <canvas id="users-count-graph" height="300"></canvas>
                        <div id="usercount-lineLegend"></div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 d-flex flex-column">
                <div class="pie-mini-card">
                    <div class="admin-dashboard-title"><?php echo ossn_print("users");?>  (<span id="users-classified-graph-total">---</span>)</div>
                    <div class="admin-dashboard-contents mt-2" style="flex-grow:1;">
                        <div class="ossn-loading users-classified-graph-loader mx-auto mt-5"></div>
                        <canvas id="users-classified-graph" class="d-none" height="150"></canvas>
                    </div>
                </div>
                <div class="pie-mini-card" style="margin-bottom:0;">
                    <div class="admin-dashboard-title"><?php echo ossn_print("online:users");?> (<span id="onlineusers-classified-graph-total">---</span>)</div>
                    <div class="admin-dashboard-contents mt-2" style="flex-grow:1;">
                        <div class="ossn-loading onlineusers-classified-graph-loader mx-auto mt-5"></div>
                        <canvas id="onlineusers-classified-graph" class="d-none" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="metric-card">
                    <div class="icon-wrap bg-blue"><i class="fa-solid fa-cubes"></i></div>
                    <div>
                        <div class="admin-dashboard-title"><?php echo ossn_print('components'); ?></div>
                        <div class="card-value"><?php echo ossn_total_components(); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="metric-card">
                    <div class="icon-wrap bg-purple"><i class="fa-solid fa-palette"></i></div>
                    <div>
                        <div class="admin-dashboard-title"><?php echo ossn_print('themes'); ?></div>
                        <div class="card-value"><?php echo ossn_site_total_themes(); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="metric-card">
                    <div class="icon-wrap bg-red"><i class="fa-solid fa-user-shield"></i></div>
                    <div>
                        <div class="admin-dashboard-title"><?php echo ossn_print("admin:users:unvalidated");?></div>
                        <div id="admin-dashboard-unvalidated-text" class="card-value"><div class="ossn-loading"></div></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="metric-card">
                    <div class="icon-wrap bg-orange"><i class="fa-solid fa-cloud-arrow-down"></i></div>
                    <div>
                        <div class="admin-dashboard-title"><?php echo ossn_print('available:updates'); ?></div>
                        <div class="avaiable-updates"><div class="loading-version ossn-loading"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="metric-card">
                    <div class="icon-wrap bg-indigo"><i class="fa-solid fa-code"></i></div>
                    <div>
                        <div class="admin-dashboard-title"><?php echo ossn_print('my:version'); ?></div>
                        <div class="card-value"><?php echo ossn_site_settings('site_version'); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="metric-card">
                    <div class="icon-wrap bg-cyan"><i class="fa-solid fa-file-code"></i></div>
                    <div>
                        <div class="admin-dashboard-title"><?php echo ossn_print('my:files:version'); ?></div>
                        <div class="card-value"><?php echo ossn_package_information()->version; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="cache-action-card">
                    <div class="admin-dashboard-title"><?php echo ossn_print('admin:cache'); ?></div>
                    <a href="<?php echo $flush_cache;?>" class="btn-flush-dark"><?php echo ossn_print('admin:flush:cache'); ?></a>
                </div>
            </div>
        </div>
</div>
<script>
$(window).on('load', function () {
	Ossn.PostRequest({
		'url': Ossn.site_url + 'administrator/xhr/unvalidated',
		'callback': function (result) {
				$('#admin-dashboard-unvalidated-text').html(parseInt(result.total));
		}
	});
});
</script>
<style>
body {background:#fdfdfd;}
</style>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/users'); ?>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/classfied', array('genders' => $genders)); ?>
<?php echo ossn_plugin_view('javascripts/dynamic/admin/dashboard/users/online/classfied', array('genders' => $genders)); ?>
