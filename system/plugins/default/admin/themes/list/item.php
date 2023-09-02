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
 $themes =  new OssnThemes; 
 $translit = OssnTranslit::urlize($params['theme']->name);
 if(empty($params['theme']->name)){
	 $translit = rand();
 }
 $id = $params['id'];
 $requirements = $themes->checkRequirments($params['theme']);
 
 $enable = '';
 $delete = '';
 if(ossn_site_settings('theme') !== $id) {
	 $enable = ossn_site_url("action/theme/enable?theme={$id}", true);
	 $enable = "<a href='{$enable}' class='btn btn-success btn-sm'><i class='fa fa-check'></i>".ossn_print('admin:button:enable')."</a>";

	 $delete = ossn_site_url("action/theme/delete?theme={$id}", true);
	 $delete = "<a href='{$delete}' class='btn btn-danger btn-sm ossn-make-sure'><i class='fa fa-close'></i>".ossn_print('admin:button:delete')."</a>";	  
 } 
?> 	
    <div class="card card-spacing">
      <div class="card-header">
          <a data-parent="#accordion" href="#collapse-<?php echo $translit;?>" data-bs-toggle="collapse">
		  	<?php echo $params['theme']->name;?> <?php echo $params['theme']->version;?> <i class="fa fa-sort-down"></i>
          </a>
          <div class="right">
          
          <?php if (ossn_site_settings('theme') == $id){ ?>
           		<i title="<?php echo ossn_print('admin:button:enabled');?>" class="component-title-icon component-title-check fa fa-check-circle"></i>           
          <?php } else {?>
           		<i title="<?php echo ossn_print('admin:button:disabled');?>" class="component-title-icon component-title-delete fa fa-times-circle"></i>         
		  <?php } ?>
          </div>
      </div>
      <div id="collapse-<?php echo $translit;?>" class="collapse">
        <div class="card-body">
			<p><?php echo $params['theme']->description;?></p>
            <?php 
			if(!$themes->isOld($params['theme'])){
			?>
			<table class="table margin-top-10">
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:version');?></th>
    				<td><?php echo $params['theme']->version;?></td>
 			 	</tr>
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:author');?></th>
    				<td><?php echo $params['theme']->author;?></td>
 			 	</tr>
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:author:url');?></th>
    				<td><a target="_blank" href="<?php echo $params['theme']->author_url;?>"><?php echo $params['theme']->author_url;?></a></td>
 			 	</tr>  
 			 	<tr>
    				<th scope="row"><?php echo ossn_print('admin:com:license');?></th>
    				<td><a target="_blank" href="<?php echo $params['theme']->license_url;?>"><?php echo $params['theme']->license;?></a></td>
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
			</table>
            <div class="margin-top-10 components-list-buttons">
            	<?php
					if($check){
						echo $enable;
					}
			 		echo $delete;
			 ?>
            </div>
			
			<?php
            } else {
			?>
            <div class="alert alert-danger">
            	<?php echo ossn_print('admin:old:theme', array($id)); ?>
            </div>
            <div class="margin-top-10 components-list-buttons">
                      <?php echo $delete;?>
             </div>
            <?php } ?>
            
        </div>
      </div>
    </div>
