<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
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
 
 if(ossn_site_settings('theme') !== $id) {
      $enable = ossn_site_url("action/theme/enable?theme={$id}", true);
	  $enable = "<a href='{$enable}' class='btn btn-success'><i class='fa fa-check'></i>".ossn_print('admin:button:enable')."</a>";

	  $delete = ossn_site_url("action/theme/delete?theme={$id}", true);
	  $delete = "<a href='{$delete}' class='btn btn-danger'><i class='fa fa-close'></i>".ossn_print('admin:button:delete')."</a>";	  
 } 
?> 	
    <div class="panel panel-default margin-top-10">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-parent="#accordion" href="#collapse-<?php echo $translit;?>" data-toggle="collapse">
		  	<?php echo $params['theme']->name;?> <?php echo $params['theme']->version;?> <i class="fa fa-sort-desc"></i>
          </a>
          <div class="right">
          
          <?php if (ossn_site_settings('theme') == $id){ ?>
           		<i title="<?php echo ossn_print('admin:button:enabled');?>" class="component-title-icon component-title-check fa fa-check-circle"></i>           
          <?php } else {?>
           		<i title="<?php echo ossn_print('admin:button:disabled');?>" class="component-title-icon component-title-delete fa fa-times-circle-o"></i>         
		  <?php } ?>
          </div>
        </h4>
      </div>
      <div id="collapse-<?php echo $translit;?>" class="panel-collapse collapse">
        <div class="panel-body">
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