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
$sitename = ossn_site_settings('site_name');
$sitelanguage = ossn_site_settings('language');
if (isset($params['title'])) {
    $title = $params['title'] . ' : ' . $sitename;
} else {
    $title = $sitename;
}
if (isset($params['contents'])) {
    $contents = $params['contents'];
} else {
    $contents = '';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $sitelanguage; ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	
    <?php echo ossn_fetch_extend_views('ossn/endpoint'); ?>
    <?php echo ossn_fetch_extend_views('ossn/site/head'); ?>
    <script>
        <?php echo ossn_fetch_extend_views('ossn/js/head'); ?>
    </script>
</head>

<body>
<div class="fbui-top-progress" id="fbui-top-progress-bar" style="display: block; opacity: 1; width: 30%;"></div>

<script>
(function() {
    var bar = document.getElementById('fbui-top-progress-bar');
    
    if (bar) {
        // Immediately kick it forward so F5 shows movement
        setTimeout(function() {
            bar.style.width = '65%';
        }, 50);
    }

    // When page finishes loading completely
    window.addEventListener('load', function() {
        if (bar) {
            bar.style.width = '100%';
            setTimeout(function() {
                bar.style.opacity = '0';
                setTimeout(function() {
                    bar.style.width = '0%';
                    bar.style.display = 'none';
                }, 300);
            }, 250);
        }
    });

    // When clicking any menu or link to navigate away
    document.addEventListener('click', function(e) {
        var link = e.target.closest('a');
        if (!link) return;

        // CRITICAL FIX: If any custom JS or framework called e.preventDefault(), ignore it
        if (e.defaultPrevented) {
            return;
        }

        var url = link.getAttribute('href');
        
        // Skip dummy links, anchors, or external URLs
        if (!url || url.startsWith('#') || url.startsWith('javascript') || link.getAttribute('target') === '_blank') {
            return;
        }

        // Trigger the loading animation on legitimate navigation clicks
        if (bar) {
            bar.style.display = 'block';
            bar.style.opacity = '1';
            bar.style.width = '15%';
            setTimeout(function() {
                bar.style.width = '75%';
            }, 50);
        }
    });
})();
</script>

<style>
/* Facebook-style Top Loading Progress Bar */
.fbui-top-progress {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    background: #1877f2; /* FB Blue */
    z-index: 999999;
    width: 0%;
    display: block;
    transition: width 0.3s ease, opacity 0.3s ease;
}
</style>
	<div class="ossn-halt ossn-light"></div>
	<div class="ossn-message-box"></div>
	<div class="ossn-viewer" style="display:none"></div>
    <?php echo ossn_plugin_view('theme/page/elements/system_messages'); ?>    
   
    <div class="opensource-socalnetwork">
		<?php echo ossn_plugin_view('theme/page/elements/topbar');?>
    	 <div class="ossn-page-container">
          <div class="ossn-inner-page">    
  	  		  <?php echo $contents; ?>
          </div>    
		</div>
    </div>
    <div id="ossn-theme-config" class="hidden" data-desktop-cover-height="300" data-minimum-cover-image-width="1200"></div>	
    <?php echo ossn_fetch_extend_views('ossn/page/footer'); ?>           
</body>
</html>
