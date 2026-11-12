<?php
$promo            = array();
$promo_endpoint   = 'https://www.opensource-socialnetwork.org/api/v1.0/promo';
$promo_cache_file = rtrim(ossn_get_userdata('promo.cached'), '/\\');
$promo_cache_ttl  = 43200; // 12 hours
$promo_user_agent = 'OpenTeknik-OSSN-CoreClient/1.0 (AdminDashboard; +https://www.opensource-socialnetwork.org)';

if (file_exists($promo_cache_file) && (time() - filemtime($promo_cache_file)) < $promo_cache_ttl) {
    $cached_raw = @file_get_contents($promo_cache_file);
    if ($cached_raw !== false) {
        $decoded = json_decode($cached_raw, true);
        if (is_array($decoded)) {
            $promo = (isset($decoded['promo']) && is_array($decoded['promo'])) ? $decoded['promo'] : $decoded;
        }
    }
} elseif (stripos($promo_endpoint, 'https://') === 0 && function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL             => $promo_endpoint,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_FOLLOWLOCATION  => true,
        CURLOPT_MAXREDIRS       => 3,
        CURLOPT_CONNECTTIMEOUT  => 5,
        CURLOPT_TIMEOUT         => 10,
        CURLOPT_PROTOCOLS       => CURLPROTO_HTTPS,
        CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
        CURLOPT_SSL_VERIFYPEER  => true,
        CURLOPT_SSL_VERIFYHOST  => 2,
        CURLOPT_USERAGENT       => $promo_user_agent,
        CURLOPT_HTTPHEADER      => array('Accept: application/json'),
    ));
    $response  = curl_exec($ch);
    $http_code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $cache_dir = dirname($promo_cache_file);
    if ($response !== false && $http_code === 200) {
        $decoded = json_decode($response, true);
        if (is_array($decoded)) {
            if (is_dir($cache_dir)) {
                @file_put_contents($promo_cache_file, $response);
            }
            $promo = (isset($decoded['promo']) && is_array($decoded['promo'])) ? $decoded['promo'] : $decoded;
        }
    } else {
        if (is_dir($cache_dir)) {
            @file_put_contents($promo_cache_file, '{}');
        }
    }
}

// Hide completely if API returned nothing, disabled, or expired
$is_expired = (!empty($promo['expires_at']) && strtotime((string)$promo['expires_at']) < time());

if (!empty($promo['enabled']) && !$is_expired) {
    $allowed_themes = array('normal', 'halloween', 'christmas', 'blackfriday');
    $promo_theme    = (isset($promo['theme']) && in_array($promo['theme'], $allowed_themes, true)) ? $promo['theme'] : 'normal';
    $promo_bullets  = (isset($promo['bullets']) && is_array($promo['bullets'])) ? $promo['bullets'] : array();

    $watermark_icons = array(
        'normal'      => 'fa-rocket',
        'halloween'   => 'fa-ghost',
        'christmas'   => 'fa-gifts',
        'blackfriday' => 'fa-bolt',
    );
    $badge_icons = array(
        'normal'      => 'fa-crown',
        'halloween'   => 'fa-spider',
        'christmas'   => 'fa-snowflake',
        'blackfriday' => 'fa-fire',
    );
?>
<link rel="stylesheet" href="<?php echo ossn_site_url(); ?>vendors/ossn/css/promo.css" />
<div class="ossn-premium-upgrade-card theme-<?php echo $promo_theme; ?>">
    <i class="fa-solid <?php echo $watermark_icons[$promo_theme]; ?> promo-watermark"></i>
    <div class="row align-items-center g-4 position-relative">
        <div class="col-lg-8">
            <?php
            if (!empty($promo['badge'])) {
            ?>
                <div class="promo-badge">
                    <i class="fa-solid <?php echo $badge_icons[$promo_theme]; ?>"></i>
                    <span><?php echo htmlspecialchars((string)$promo['badge'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                </div>
            <?php
            }
            if (!empty($promo['headline'])) {
            ?>
                <div class="promo-title"><?php echo htmlspecialchars((string)$promo['headline'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
            <?php
            }
            if (!empty($promo['body'])) {
            ?>
                <div class="promo-desc"><?php echo htmlspecialchars((string)$promo['body'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
            <?php
            }
            if (!empty($promo_bullets)) {
            ?>
                <div class="promo-pills">
                    <?php
                    foreach ($promo_bullets as $bullet) {
                        if (trim((string)$bullet) === '') {
                            continue;
                        }
                    ?>
                        <span class="promo-pill"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars((string)$bullet, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="col-lg-4">
            <div class="promo-pricing-box">
                <?php
                if (!empty($promo['price_label'])) {
                ?>
                    <div class="promo-price-label"><?php echo htmlspecialchars((string)$promo['price_label'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
                <?php
                }
                ?>
                <div class="promo-price-row">
                    <?php
                    if (!empty($promo['original_price'])) {
                    ?>
                        <span class="promo-old-price"><?php echo htmlspecialchars((string)$promo['original_price'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                    <?php
                    }
                    if (!empty($promo['price'])) {
                    ?>
                        <span class="promo-price"><?php echo htmlspecialchars((string)$promo['price'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                    <?php
                    }
                    ?>
                </div>

                <?php
                if (!empty($promo['coupon']) || !empty($promo['promo_text'])) {
                ?>
                    <div class="promo-coupon-wrap" title="Select to copy coupon code">
                        <?php
                        if (!empty($promo['coupon'])) {
                        ?>
                            <i class="fa-solid fa-ticket text-warning"></i>
                            <span class="promo-coupon-code"><?php echo htmlspecialchars((string)$promo['coupon'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                        <?php
                        }
                        if (!empty($promo['coupon']) && !empty($promo['promo_text'])) {
                        ?>
                            <span class="promo-coupon-sep">|</span>
                        <?php
                        }
                        if (!empty($promo['promo_text'])) {
                        ?>
                            <span class="opacity-85"><?php echo htmlspecialchars((string)$promo['promo_text'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                if (!empty($promo['cta_url']) && !empty($promo['cta_text'])) {
                ?>
                    <a href="<?php echo htmlspecialchars((string)$promo['cta_url'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" target="_blank" rel="noopener" class="promo-cta">
                        <span><?php echo htmlspecialchars((string)$promo['cta_text'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
}
?>