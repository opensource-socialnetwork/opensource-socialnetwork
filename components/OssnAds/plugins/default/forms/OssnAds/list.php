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

$ads   = new OssnAds;
$items = $ads->getAds(array(), false);
$count = $ads->getAds(array(
	'count' => true,                                 
));

$component = new OssnComponents();
$settings  = $component->getSettings('OssnAds');

if (!isset($settings->last_time)) {
    $last_run_text = ossn_print('ossn:adscron:never');
    $status_color = "#ef4444"; // Red
} else {
    $last_run_text = date("M j, Y - g:i A", $last_time);
    $status_color = "#10b981"; // Green
}

$expired_badge = '<span style="color: #ef4444; font-weight: 600;">' . ossn_print('ossn:adscron:expired') . '</span>';
$cannot_edit_bold = '<strong>' . ossn_print('ossn:adscron:cannot:edit') . '</strong>';
?>
<details class="ossn-admin-ad-cron">
    <summary>
        <div class="header-left">
            <div class="arrow-icon">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="clock-icon-wrapper">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="title-text">
                <h4><?php echo ossn_print('ossn:adscron:title'); ?></h4>
                <div class="last-run-status">
                    <?php echo ossn_print('ossn:adscron:last:run'); ?> 
                    <span style="font-weight: 600; color: <?php echo $status_color; ?>;">
                        <?php echo $last_run_text; ?>
                    </span>
                </div>
            </div>
        </div>
        <span class="badge-toggle"><?php echo ossn_print('ossn:adscron:configure'); ?></span>
    </summary>

    <div class="cron-body">
        <p>
            <?php echo ossn_print('ossn:adscron:description', array($expired_badge)); ?>
        </p>

        <div class="command-box">
            <span class="command-label">
                <i class="fa-solid fa-terminal" style="margin-right: 4px;"></i> 
                <?php echo ossn_print('ossn:adscron:command:label'); ?>
            </span>
            <code>
                0 12 * * * <span class="path-placeholder"><?php echo ossn_print('ossn:adscron:path:placeholder'); ?></span> <?php echo ossn_route()->www;?>system/handlers/cli --handler=AdsCron
            </code>
        </div>

        <div class="warning-alert">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <strong><?php echo ossn_print('ossn:adscron:warning:title'); ?></strong> 
                <?php echo ossn_print('ossn:adscron:warning:text', array($cannot_edit_bold)); ?>
            </div>
        </div>
    </div>
</details>

<div class="ossn-ads-list-container">
    
	<div class="ossn-ads-admin-buttons-top">
    	<a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=add"); ?>" class="ossn-ad-btn ossn-ad-btn-success">
        	<i class="fa fa-plus"></i> <?php echo ossn_print('add'); ?>
    	</a>
   	 	<input type="submit" class="ossn-ad-btn ossn-ad-btn-danger ossn-ad-btn-right" value="<?php echo ossn_print('delete'); ?>"/>
	</div>
    <div class="table-responsive">
        <table class="table ossn-ads-management-table">
            <thead>
                <tr class="table-titles">
                    <th width="40"></th>
                    <th><?php echo ossn_print('ad:title'); ?></th>
                    <th><?php echo ossn_print('ad:site:url'); ?></th>
                    <th><?php echo ossn_print('ad:placement'); ?></th>
                    <th><?php echo ossn_print('ad:gender:target'); ?></th>
                    <th class="text-center"><?php echo ossn_print('ad:end:date'); ?></th>
                    <th class="text-center"><?php echo ossn_print('ad:views'); ?></th>
                    <th class="text-center"><?php echo ossn_print('ad:clicks'); ?></th>
                    <th class="text-center"><?php echo ossn_print('ad:status'); ?></th>
                    <th class="text-center"><?php echo ossn_print('edit'); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($items) {
                foreach ($items as $ad_item) {
                    // Decode structural configuration JSON maps safely
                    $placements = json_decode($ad_item->placement, true);
                    $genders    = json_decode($ad_item->gender_target, true);

                    if (!is_array($placements)) { $placements = array(); }
                    if (!is_array($genders)) { $genders = array(); }

                    // Pull stored raw date timeline metrics purely for text rendering
                    $raw_expiry = 0;
                    if (isset($ad_item->expire_time) && !empty($ad_item->expire_time)) {
                        $raw_expiry = $ad_item->expire_time;
                    }

                    // Strict dynamic flag fallback evaluation logic mapping
                    $is_expired = false;
                    if (isset($ad_item->expired) && ($ad_item->expired == true || $ad_item->expired == 1)) {
                        $is_expired = true;
                    }

                    // Numeric Sanitization Fallbacks
                    $views  = isset($ad_item->views_count) ? (int)$ad_item->views_count : 0;
                    $clicks = isset($ad_item->clicks_count) ? (int)$ad_item->clicks_count : 0;
                    ?>
                    <tr>
                        <td>
                            <div class="checkbox-block mt-0 mb-0">
                                <input class="ossn-checkbox-input mt-0" type="checkbox" name="guid[]" value="<?php echo (int)$ad_item->guid; ?>"/>
                            </div>
                        </td>
                        
                        <td class="ad-title-cell">
                            <strong><?php echo $ad_item->title; ?></strong>
                        </td>
                        
                        <td class="ad-url-cell">
                            <a href="<?php echo $ad_item->site_url; ?>" target="_blank" class="ad-table-external-link">
                                <i class="fa fa-external-link"></i>
                            </a>
                        </td>
                        
                        <td>
                            <div class="ad-badge-flex-wrap">
                                <?php if (!empty($placements)): ?>
                                    <?php foreach ($placements as $place): ?>
                                        <span class="ad-list-badge-info"><?php echo ossn_print("ad:placement:{$place}"); ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="ad-list-badge-none">-</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        
                        <td>
                            <div class="ad-badge-flex-wrap">
                                <?php if (!empty($genders)): ?>
                                    <?php foreach ($genders as $gender): ?>
                                        <?php $langKey = ($gender === 'male' || $gender === 'female') ? $gender : 'gender:other'; ?>
                                        <span class="ad-list-badge-neutral"><?php echo ossn_print($langKey); ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="ad-list-badge-none">-</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        
                        <td class="text-center ad-expiry-cell">
                            <?php if ($raw_expiry > 0): ?>
                                <span class="ad-date-string-text"><?php echo date('F j, Y', $raw_expiry); ?></span>
                            <?php else: ?>
                                <span class="ad-list-badge-none"><?php echo ossn_print('ad:end:date:infinity'); ?></span>
                            <?php endif; ?>
                        </td>
                        
                        <td class="text-center ad-counter-cell">
                            <span class="ad-metric-badge views"><?php echo $views; ?></span>
                        </td>

                        <td class="text-center ad-counter-cell">
                            <span class="ad-metric-badge clicks"><?php echo $clicks; ?></span>
                        </td>
                        
                        <td class="text-center">
                            <?php if ($is_expired): ?>
                                <span class="ad-status-badge expired">
                                    <i class="fa fa-clock"></i> <?php echo ossn_print('ad:status:expired'); ?>
                                </span>
                            <?php else: ?>
                                <span class="ad-status-badge active">
                                    <i class="fa fa-circle"></i> <?php echo ossn_print('ad:status:active'); ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        
                        <td class="text-center">
                            <a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=edit&id={$ad_item->guid}"); ?>" class="btn btn-flat-edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="10" class="text-center no-ads-placeholder-row">
                        <i class="fa fa-folder-open-o"></i> <?php echo ossn_print('ad:list:empty'); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
	<?php echo ossn_view_pagination($count); ?>
</div>