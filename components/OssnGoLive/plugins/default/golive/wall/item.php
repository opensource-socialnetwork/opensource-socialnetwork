<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSNS Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)   http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
ossn_trigger_callback('wall', 'load:item', $params);

//if user didn't exists not wall item #1110
if(!$params['user']){
    error_log("Post creator doesn't exist for wallpost with guid : {$params['post']->guid}");
    return;
}
$owner = false;
if ($params['user']->guid != $params['post']->owner_guid) {
    $owner = ossn_user_by_guid($params['post']->owner_guid);
    if (!$owner) {
        error_log("Post receiver doesn't exist for wallpost with guid : {$params['post']->guid}");
        return;
    }
}

// Fetch Cloudflare settings for customer subdomain
$settings = (new OssnComponents())->getSettings('OssnGoLive');
$cf_subdomain = trim($settings->cloudflare_subdomain ?? '');

$status = $params['post']->stream_status ?? 'ended';
$input_id = $params['post']->item_guid ?? '';
$is_live = ($status === 'live' && !empty($input_id));

// Build iframe URL with autoplay and muted parameters
if (!empty($cf_subdomain)) {
    $clean_subdomain = str_replace(array('https://', 'http://', '.cloudflarestream.com', 'customer-'), '', $cf_subdomain);
    $iframe_url = "https://customer-{$clean_subdomain}.cloudflarestream.com/{$input_id}/iframe?autoplay=true&muted=true";
} else {
    $iframe_url = "https://iframe.cloudflarestream.com/{$input_id}/iframe?autoplay=true&muted=true";
}
?>
<!-- wall item -->
<div class="ossn-wall-item ossn-wall-item-<?php echo $params['post']->guid; ?>" id="activity-item-<?php echo $params['post']->guid; ?>">
    <div class="row">
        <div class="meta">
            <img class="user-icon-small user-img" src="<?php echo $params['user']->iconURL()->small; ?>" />
            <div class="post-menu">
                <div class="dropdown">
                <?php
                 if (ossn_is_hook('wall', 'post:menu') && ossn_isLoggedIn()) {
                     $menu['post'] = $params['post'];
                     echo ossn_call_hook('wall', 'post:menu', $menu);
                 }
             ?>    
                </div>
            </div>
            <div class="user">
                <?php
                echo ossn_plugin_view('output/user/url', array(
                        'user' => $params['user'],        
                        'section' => 'wall',
                ));
                ?>
               <span class="ossn-wall-item-type"><?php echo ossn_print('golive:started:livestream');?></span>
            </div>
            <div class="post-meta">
                <span class="time-created ossn-wall-post-time" title="<?php echo date('d/m/Y', $params['post']->time_created);?>" onclick="Ossn.redirect('<?php echo("post/view/{$params['post']->guid}");?>');"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
                <span class="time-created"><?php echo $params['location']; ?></span>
                <?php
                    echo ossn_plugin_view('privacy/icon/view', array(
                            'privacy' => $params['post']->access,
                            'text' => '-',
                            'class' => 'time-created',
                    ));
                ?>
            </div>
        </div>
        <div class="post-contents">
            <?php if (!empty($params['text'])): ?>
                <p><?php echo $params['text']; ?></p>
            <?php endif; ?>

            <!-- Live Stream Player / Ended State Container -->
            <div class="golive-player-container" style="position: relative; width: 100%; aspect-ratio: 16/9; background: #000; border-radius: 8px; overflow: hidden; margin-top: 10px;">
                <?php if ($is_live): ?>
                    <!-- Live iframe Player with Autoplay -->
                    <iframe src="<?php echo $iframe_url; ?>" 
                            style="border: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%;" 
                            allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;" 
                            allowfullscreen="true">
                    </iframe>
                <?php else: ?>
                    <!-- Fallback / Ended Stream State -->
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: #fff; font-family: sans-serif;">
                        <i class="fa fa-video-slash" style="font-size: 32px; margin-bottom: 10px; color: #adb5bd;"></i>
                        <span style="font-weight: 600; font-size: 14px;"><?php echo ossn_print('golive:stream:ended'); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="comments-likes">
            <div class="menu-stats d-flex align-items-center w-100 flex-wrap">
              <?php
                   if(ossn_is_hook('post', 'likes')) {
                   echo ossn_call_hook('post', 'likes', $params['post']);
              }
            ?>    
            </div>
            <div class="menu-likes-comments-share">
                <?php echo ossn_view_menu('postextra', 'wall/menus/postextra');?>
            </div>
            <div class="comments-list">
              <?php
                  if (ossn_is_hook('post', 'comments')){
                      $vars = array();
                      $vars['post'] =  $params['post'];                        
                      echo ossn_call_hook('post', 'comments', $vars);
                     }
            ?>                
            </div>
        </div>
    </div>
</div>
<!-- ./ wall item -->