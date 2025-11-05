<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ossn_site_url('administrator/component/OssnSitePages');?>"><i class="fa-solid fa-file-lines"></i><?php echo ossn_print('sitepages:edit');?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ossn_site_url('administrator/component/OssnSitePages?settings=list');?>"><i class="fas fa-list"></i><?php echo ossn_print('ossnsitepages');?></a>
        </li>        
        <li class="nav-item">
          <a class="nav-link" href="<?php echo ossn_site_url('administrator/component/OssnSitePages?settings=setting');?>"><i class="fas fa-cogs"></i><?php echo ossn_print('settings');?></a>
        </li>        
        
      </ul>
    </div>
</nav>
<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$settings = input('settings');
if (empty($settings)) {
    $settings = 'edit';
}
switch ($settings) {
    case 'list':
			echo ossn_plugin_view('sitepages/list');
        break;
    case 'edit':
		echo ossn_view_form('sitepages/page/edit', array(
        	    'action' => ossn_site_url() . 'action/sitepage/edit',
		));	
	break;
    case 'setting':
		echo ossn_view_form('sitepages/setting', array(
        	    'action' => ossn_site_url() . 'action/sitepage/setting',
		));	
	break;	
}
