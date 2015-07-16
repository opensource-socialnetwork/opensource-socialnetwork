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
 $OssnComs = new OssnComponents;
 $translit = OssnTranslit::urlize($params['component']->id);
 if(empty($params['component']->name)){
	 $translit = rand();
 } 
 $requirements = $OssnComs->checkRequirments($params['component']);

 //used code from ossn v1.0
 if (!$params['OssnCom']->isActive($params['name'])) {
  	$enable = ossn_site_url("action/component/enable?com={$params['name']}", true);
  	$enable = "<a href='{$enable}' class='btn btn-success'><i class='fa fa-check'></i>" . ossn_print('admin:button:enable') ."</a>";
 } elseif (!in_array($params['name'], $params['OssnCom']->requiredComponents())) {
  	$disable = ossn_site_url("action/component/disable?com={$params['name']}", true);
  	$disable = "<a href='{$disable}' class='btn btn-warning'><i class='fa fa-minus'></i>" . ossn_print('admin:button:disable') ."</a>";
 }
 if (in_array($params['name'], ossn_registered_com_panel())) {
  	$configure = ossn_site_url("administrator/component/{$params['name']}");
  	$configure = "<a href='{$configure}' class='btn btn-primary'><i class='fa fa-cogs'></i>" . ossn_print('admin:button:configure') ."</a>";
 }
 if (!in_array($params['name'], $params['OssnCom']->requiredComponents())) {
  	$delete = ossn_site_url("action/component/delete?component={$params['name']}", true);
  	$delete = "<a href='{$delete}' class='btn btn-danger ossn-com-delete-button'><i class='fa fa-close'></i>" . ossn_print('admin:button:delete') ."</a>";
 }		 
?>    
    
    <div class="panel panel-default margin-top-10">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-parent="#accordion" href="#collapse-<?php echo $translit;?>" data-toggle="collapse">
		  	<?php echo $params['component']->name;?> <?php echo $params['component']->version;?> <i class="fa fa-sort-desc"></i>
          </a>
          <div class="right">
          <?php if (!$params['OssnCom']->isActive($params['name'])){ ?>
           	<i title="<?php echo ossn_print('admin:button:disabled');?>" class="component-title-icon component-title-delete fa fa-times-circle-o"></i>         
          <?php } else {?>
           	<i title="<?php echo ossn_print('admin:button:enabled');?>" class="component-title-icon component-title-check fa fa-check-circle"></i>           
		  <?php } ?>
          </div>
        </h4>
      </div>
      <div id="collapse-<?php echo $translit;?>" class="panel-collapse collapse">
        <div class="panel-body">
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
                            	<th><?php echo ossn_print('admin:com:version');?></th>
                                <th><?php echo ossn_print('admin:com:availability');?></th>
                            </tr>
                            <?php
							if($requirements){ 
								$check = true;
								foreach($requirements  as $item){ 
									if($item['availability'] == 0){
										$check = false;
									}
									$icon = 'component-title-delete fa fa-times-circle-o';
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
			</table>
            <div class="margin-top-10 components-list-buttons">
            	<?php
					if($check){
						echo $enable;
					}
			 		echo $disable, $delete;
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