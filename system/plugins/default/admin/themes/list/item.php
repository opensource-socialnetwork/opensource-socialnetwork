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
 <div class="ossn-com-row">
    <div class="com-row-header" data-bs-toggle="collapse" href="#details-<?php echo $translit;?>">
        <div class="com-ui-info">
            <div class="status-dot <?php echo (ossn_site_settings('theme') == $id) ? 'dot-active' : 'dot-inactive'; ?>"></div>
            <?php if(isset($params['theme']->icon) && !empty($params['theme']->icon)){ ?>
               		 <img class="com-ui-preview-thumb" src="<?php echo ossn_site_url("themes/{$id}/{$params['theme']->icon}"); ?>" onclick="event.stopPropagation(); showOssnPreview(this.src);" />
            <?php } else { ?>
                 <div class="com-ui-preview-thumb d-flex align-items-center justify-content-center">
                    <i class="fa fa-paint-brush text-muted" style="opacity:0.5"></i>
                 </div>
            <?php } ?>

            <div>
                <h4 class="com-ui-name"><?php echo $params['theme']->name;?></h4>
                <span class="com-ui-version"><?php echo $params['theme']->version;?></span>
            </div>
        </div>
        <div class="com-ui-toggle">
            <i class="fa fa-angle-down text-muted"></i>
        </div>
    </div>

    <div id="details-<?php echo $translit;?>" class="collapse">
        <div class="com-row-details">
            
            <div class="com-details-wrapper">
                
                <?php if(isset($params['theme']->preview) && !empty($params['theme']->preview)){ ?>
                <div class="com-preview-side">
                    <img src="<?php echo ossn_site_url("themes/{$id}/{$params['theme']->preview}"); ?>" onclick="event.stopPropagation(); showOssnPreview(this.src);" class="com-full-preview" />
                </div>
                <?php } ?>

                <div class="com-details-text-side">
                    <p class="com-description-text"><?php echo $params['theme']->description;?></p>

                    <div class="com-meta-tiles">
                        <div class="meta-tile">
                            <label><?php echo ossn_print('admin:com:version');?></label>
                            <span><?php echo $params['theme']->version;?></span>
                        </div>
                        <div class="meta-tile">
                            <label><?php echo ossn_print('admin:com:author');?></label>
                            <span><a target="_blank" href="<?php echo $params['theme']->author_url;?>"><?php echo $params['theme']->author;?></a></span>
                        </div>
                        <div class="meta-tile">
                            <label><?php echo ossn_print('admin:com:license');?></label>
                            <a href="<?php echo $params['theme']->license_url;?>" target="_blank"><?php echo $params['theme']->license;?></a>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <?php if($requirements){ 
								$check = true;
                            	foreach($requirements as $item){ 
									if($item['availability'] == 0){
										$badge_color = "bg-danger";
										$check = false;
									}
									$icon = 'component-title-delete fa fa-times-circle';
									if($item['availability'] == 1){
											$badge_color = 'bg-success';
									}
                       		 ?>
                            	<span class="badge com-badge-req <?php echo $badge_color; ?>">
                               	 <?php echo $item['type'];?>: <?php echo $item['value'];?>
                           		</span>
                        <?php } 
                        } ?>
                    </div>

                    <div class="com-action-area">
                        <?php 
						if($check){
								echo $enable;
						}
			 			echo $delete;
                        ?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>