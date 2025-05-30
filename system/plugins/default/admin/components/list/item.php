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
 $OssnComs = new OssnComponents;
 $translit = OssnTranslit::urlize($params['component']->id);
 if(empty($params['component']->name)){
	 $translit = rand();
 } 
 $requirements = $OssnComs->checkRequirments($params['component']);

 //used code from ossn v1.0
 if (!$params['OssnCom']->isActive($params['name'])) {
  	$enable = ossn_site_url("action/component/enable?com={$params['name']}", true);
  	$enable = "<a href='{$enable}' class='btn btn-success btn-sm'><i class='fa fa-check'></i>" . ossn_print('admin:button:enable') ."</a>";
	$disable = '';
 } elseif (!in_array($params['name'], $params['OssnCom']->requiredComponents())) {
  	$disable = ossn_site_url("action/component/disable?com={$params['name']}", true);
  	$disable = "<a href='{$disable}' class='btn btn-warning btn-sm'><i class='fa fa-minus'></i>" . ossn_print('admin:button:disable') ."</a>";
	$enable = '';
 }
 $configure = "";
 $configure_options = ossn_registered_com_panel();
 if ($configure_options && in_array($params['name'], $configure_options)) {
	$configure = ossn_site_url("administrator/component/{$params['name']}");
  	$configure = "<a href='{$configure}' class='btn btn-success btn-sm'><i class='fa fa-cogs'></i>" . ossn_print('admin:button:configure') ."</a>";
 }
 $delete = '';
 if (!in_array($params['name'], $params['OssnCom']->requiredComponents())) {
  	$delete = ossn_site_url("action/component/delete?component={$params['name']}", true);
  	$delete = "<a href='{$delete}' class='btn btn-danger btn-sm ossn-component-delete-confirm' data-ossn-msg='ossn:component:delete:exception'><i class='fa fa-close'></i>" . ossn_print('admin:button:delete') ."</a>";
 }
 // find active usage of a required component
 $in_use = false;
 if (in_array($params['name'], $params['OssnCom']->requiredComponents())) {
	$enable = '';
	$disable = '';
	if($active_usage = $OssnComs->inUseBy($params['name'])) {
		$active_usage_list = implode(", ", $active_usage);
		$in_use = true;
	}
 }
?>    
    
    <div class="card card-spacing">
      <div class="card-header">
          <a data-parent="#accordion" href="#collapse-<?php echo $translit;?>" data-bs-toggle="collapse">
		  	<?php echo $params['component']->name;?> <?php echo $params['component']->version;?> <i class="fa fa-sort-down"></i>
          </a>
          <div class="right">
          <?php if (!$params['OssnCom']->isActive($params['name'])){ ?>
           	<i title="<?php echo ossn_print('admin:button:disabled');?>" class="component-title-icon component-title-delete fa fa-times-circle"></i>         
          <?php } else {?>
           	<i title="<?php echo ossn_print('admin:button:enabled');?>" class="component-title-icon component-title-check fa fa-check-circle"></i>           
		  <?php } ?>
          </div>
      </div>
      <div id="collapse-<?php echo $translit;?>" class="collapse">
        <div class="card-body">
			<p><?php echo $params['component']->description;?></p>
            <?php 
			if(!$OssnComs->isOld($params['component'])){
			?>
			<table class="table margin-top-10">
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:version');?></th>
    				<td><?php echo $params['component']->version;?></td>
 			 	</tr>
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:author');?></th>
    				<td><?php echo $params['component']->author;?></td>
 			 	</tr>
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:author:url');?></th>
    				<td><a target="_blank" href="<?php echo $params['component']->author_url;?>"><?php echo $params['component']->author_url;?></a></td>
 			 	</tr>  
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:license');?></th>
    				<td><a target="_blank" href="<?php echo $params['component']->license_url;?>"><?php echo $params['component']->license;?></a></td>
 			 	</tr>
      			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:requirements');?></th>
    				<td>
                    	<table class="table">
                        	<tr class="table-titles">
                            	<th><?php echo ossn_print('name');?></th>
                            	<th><?php echo ossn_print('admin:com:requirement');?></th>
                                <th><?php echo ossn_print('admin:com:fulfilled');?></th>
                            </tr>
                            <?php
							if($requirements){ 
								$check = true;
								foreach($requirements  as $item){ 
									if($item['availability'] == 0){
										$check = false;
									}
									$icon = 'component-title-delete fa fa-times-circle';
									if($item['availability'] == 1){
											$icon = 'component-title-check fa fa-check-circle';
									}
							?>                            
                            	<tr>
                            		<td><?php echo $item['type'];?></td>
                                	<td><?php echo $item['value'];?></td>
                               	 	<td><i class="component-title-icon <?php echo $icon;?>"></i></td>
                            	</tr>
                        	<?php
								} 
							}
							?>
                        </table>
                    
                    </td>
 			 	</tr>                                                      
				<?php
				if($in_use) {
				?>
					<tr>
						<th scope="row"><?php echo ossn_print('admin:com:used:by');?></th>
						<td><?php echo $active_usage_list?></td>
					</tr>
				<?php
				}
				?>
		</table>
            <div class="margin-top-10 components-list-buttons">
            	<?php
					if($check){
						echo $enable;
					}
			 		echo $configure, $disable, $delete;
			 ?>
            </div>
			
			<?php
            } else {
			?>
            <div class="alert alert-danger">
            	<?php echo ossn_print('admin:old:com', array($params['name'])); ?>
            </div>
            <div class="margin-top-10 components-list-buttons">
                      <?php echo $delete;?>
             </div>
            <?php } ?>
            
        </div>
      </div>
    </div>
