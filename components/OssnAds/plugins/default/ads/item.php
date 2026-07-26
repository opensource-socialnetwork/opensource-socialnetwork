<?php
$site_url = $params['item']->site_url;
$parsed_host = parse_url($site_url, PHP_URL_HOST);
$display_domain = $parsed_host ? str_replace('www.', '', $parsed_host) : $site_url;
?>

<div class="ossn-ad-item" data-guid="<?php echo $params['item']->guid; ?>">
    <a target="_blank" href="<?php echo $params['item']->goURL(); ?>" class="ad-clickable-card">
        <div class="ad-meta-row">
            <span class="ad-sponsored-tag"><?php echo ossn_print('sponsored'); ?></span>
            <span class="ad-domain-host"><?php echo htmlspecialchars($display_domain); ?></span>
        </div>

        <div class="ad-title"><?php echo htmlspecialchars($params['item']->title); ?></div>
        
        <div class="ad-image-container">
            <img class="ad-image" src="<?php echo $params['item']->getPhotoURL(); ?>" alt="<?php echo htmlspecialchars($params['item']->title); ?>" />
        </div>
        
        <p><?php echo htmlspecialchars($params['item']->description); ?></p>
    </a>
</div>