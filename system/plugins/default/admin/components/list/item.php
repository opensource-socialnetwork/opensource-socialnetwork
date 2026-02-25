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

 $OssnComs = new OssnComponents();
 $translit = OssnTranslit::urlize($params['com_id']);
 if(empty($params['xml']->name)){
	 $translit = rand();
 }

 $requirements = $OssnComs->checkRequirments($params['com_id']);

 //used code from ossn v1.0
 if (!$OssnComs->isActive($params['com_id'])) {
  	$enable = ossn_site_url("action/component/enable?com={$params['com_id']}", true);
  	$enable = "<a href='{$enable}' class='btn btn-success btn-sm'><i class='fa fa-check'></i>" . ossn_print('admin:button:enable') ."</a>";
	$disable = '';
 } elseif (!in_array($params['com_id'], $OssnComs->requiredComponents())) {
  	$disable = ossn_site_url("action/component/disable?com={$params['com_id']}", true);
  	$disable = "<a href='{$disable}' class='btn btn-warning btn-sm'><i class='fa fa-minus'></i>" . ossn_print('admin:button:disable') ."</a>";
	$enable = '';
 }
 $configure = "";
 $configure_options = ossn_registered_com_panel();
 if ($configure_options && in_array($params['com_id'], $configure_options)) {
	$configure = ossn_site_url("administrator/component/{$params['com_id']}");
  	$configure = "<a href='{$configure}' class='btn btn-success btn-sm'><i class='fa fa-cogs'></i>" . ossn_print('admin:button:configure') ."</a>";
 }
 $delete = '';
 if (!in_array($params['com_id'], $OssnComs->requiredComponents())) {
  	$delete = ossn_site_url("action/component/delete?component={$params['com_id']}", true);
  	$delete = "<a href='{$delete}' class='btn btn-danger btn-sm ossn-component-delete-confirm' data-ossn-msg='ossn:component:delete:exception'><i class='fa fa-close'></i>" . ossn_print('admin:button:delete') ."</a>";
 }
 // find active usage of a required component
 $in_use = false;
 if (in_array($params['com_id'], $OssnComs->requiredComponents())) {
	$enable = '';
	$disable = '';
	if($active_usage = $OssnComs->inUseBy($params['com_id'])) {
		$active_usage_list = implode(", ", $active_usage);
		$in_use = true;
	}
 }
 $check = true;
?>    
<div class="ossn-com-row">
    <div class="com-row-header" data-bs-toggle="collapse" href="#details-<?php echo $translit;?>">
        <div class="com-ui-info">
            <div class="status-dot <?php echo ($OssnComs->isActive($params['com_id'])) ? 'dot-active' : 'dot-inactive'; ?>"></div>
            
            <?php if(isset($params['xml']->icon) && !empty($params['xml']->icon)){ ?>
                <img class="com-ui-preview-thumb" src="<?php echo ossn_site_url("components/{$params['xml']->id}/{$params['xml']->icon}"); ?>" onclick="event.stopPropagation(); showOssnPreview(this.src);" />
            <?php } else { ?>
                 <div class="com-ui-preview-thumb d-flex align-items-center justify-content-center">
                    <i class="fa fa-puzzle-piece text-muted me-0" style="opacity:0.5"></i>
                 </div>
            <?php } ?>

            <div>
                <h4 class="com-ui-name"><?php echo $params['xml']->name;?></h4>
                <span class="com-ui-version"><?php echo $params['xml']->version;?></span>
            </div>
        </div>
        <div class="com-ui-toggle">
            <i class="fa fa-angle-down text-muted"></i>
        </div>
    </div>

    <div id="details-<?php echo $translit;?>" class="collapse">
        <div class="com-row-details">
            
            <div class="com-details-wrapper">
                <?php if(isset($params['xml']->preview) && !empty($params['xml']->preview)){ ?>
                <div class="com-preview-side mt-3">
                    <img src="<?php echo ossn_site_url("components/{$params['xml']->id}/{$params['xml']->preview}"); ?>" onclick="event.stopPropagation(); showOssnPreview(this.src);" class="com-full-preview" />
                </div>
                <?php } ?>

                <div class="com-details-text-side">
                    <p class="com-description-text"><?php echo $params['xml']->description;?></p>

                    <div class="com-meta-tiles">
                        <div class="meta-tile">
                            <label><?php echo ossn_print('admin:com:version');?></label>
                            <span><?php echo $params['xml']->version;?></span>
                        </div>
                        <div class="meta-tile">
                            <label><?php echo ossn_print('admin:com:author');?></label>
                            <span><a target="_blank" href="<?php echo $params['xml']->author_url;?>"><?php echo $params['xml']->author;?></a></span>
                        </div>
                        <div class="meta-tile">
                            <label><?php echo ossn_print('admin:com:license');?></label>
                            <a href="<?php echo $params['xml']->license_url;?>" target="_blank"><?php echo $params['xml']->license;?></a>
                        </div>
                        <?php if($in_use){?>
                        <div class="meta-tile">
                        	<label><?php echo ossn_print('admin:com:used:by');?></label>
                            <span><?php echo $active_usage_list?></span>
                        </div>
                        <?php }?>
                    </div>
                    <label><?php echo ossn_print('admin:com:requirement');?></label>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <?php if($requirements){ 
                            	foreach($requirements as $item){ 
									if($item['availability'] == 0){
										$badge_color = "bg-danger";
										$check = false;
									}
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
			 			echo $configure, $disable, $delete;
                        ?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>