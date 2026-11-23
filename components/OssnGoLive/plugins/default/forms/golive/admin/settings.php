<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */

$component = new OssnComponents();
$settings  = $component->getSettings('OssnGoLive');

$account_id   = isset($settings->cloudflare_account_id) ? $settings->cloudflare_account_id : '';
$api_token    = isset($settings->cloudflare_api_token) ? $settings->cloudflare_api_token : '';
$cf_subdomain = isset($settings->cloudflare_subdomain) ? $settings->cloudflare_subdomain : '';
?>
    <legend><?php echo ossn_print('golive:admin:legend'); ?></legend>
    
    <div class="item">
        <label><?php echo ossn_print('golive:admin:account:id'); ?></label>
        <input type="text" name="cloudflare_account_id" value="<?php echo $account_id; ?>" placeholder="<?php echo ossn_print('golive:admin:account:id:placeholder'); ?>" />
    </div>

    <div class="item">
        <label><?php echo ossn_print('golive:admin:api:token'); ?></label>
        <input type="password" name="cloudflare_api_token" value="<?php echo $api_token; ?>" placeholder="<?php echo ossn_print('golive:admin:api:token:placeholder'); ?>" />
        <small style="display:block; color:#656d76; margin-top:5px;"><?php echo ossn_print('golive:admin:api:token:note'); ?></small>
    </div>

    <div class="item">
        <label><?php echo ossn_print('golive:admin:cloudflare:subdomain'); ?></label>
        <input type="text" name="cloudflare_subdomain" value="<?php echo $cf_subdomain; ?>" placeholder="<?php echo ossn_print('golive:admin:cloudflare:subdomain:placeholder'); ?>" />
        <small style="display:block; color:#656d76; margin-top:5px;"><?php echo ossn_print('golive:admin:cloudflare:subdomain:note'); ?></small>
        
        <div class="golive-admin-notice">
            <i class="fa fa-info-circle"></i>
            <span><?php echo ossn_print('golive:admin:notice:webrtc_views'); ?></span>
        </div>
    </div>

    <div class="submit" style="margin-top: 20px;">
        <input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>" />
    </div>

    <div class="golive-admin-guide">
        <h4><i class="fa fa-book-open"></i> <?php echo ossn_print('golive:admin:guide:title'); ?></h4>
        <ol>
            <li><?php echo ossn_print('golive:admin:guide:step1'); ?></li>
            <li><?php echo ossn_print('golive:admin:guide:step2'); ?></li>
            <li><?php echo ossn_print('golive:admin:guide:step3'); ?></li>
        </ol>
    </div>