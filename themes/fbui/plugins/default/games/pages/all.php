<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OPENTEKNIK LLC, COMMERCIAL LICENSE
 * @license   OPENTEKNIK LLC, COMMERCIAL LICENSE https://www.openteknik.com/license/commercial-license-v1
 * @link      http://www.opensource-socialnetwork.org/licence
 */

if (!ossn_isLoggedin()) {
    return;
}

$cache_dir  = ossn_route()->themes . "fbui/vendors/games/";
$cache_file = $cache_dir . "gamepix_cache.json";
$gz_file    = $cache_dir . "gamepix_cache.json.gz";
$all_games  = array();

// AUTO-UNPACK GZIP: If raw JSON is missing but .gz exists, unpack it on the fly
if (!file_exists($cache_file) && file_exists($gz_file)) {
    if (extension_loaded('zlib')) {
        $compressed_data = file_get_contents($gz_file);
        $json_data = false;

        if (function_exists('gzdecode')) {
            $json_data = gzdecode($compressed_data);
        } elseif (function_exists('gzinflate')) {
            $json_data = @gzinflate(substr($compressed_data, 10, -8));
        }

        if ($json_data !== false && !empty($json_data)) {
            file_put_contents($cache_file, $json_data);
        }
    }
}

// Load and decode the cache file safely
if (file_exists($cache_file)) {
    $cache_data = file_get_contents($cache_file);
    $all_games = json_decode($cache_data, true);
    if (!is_array($all_games)) {
        $all_games = array();
    }
}

$categories = array('All');
if (!empty($all_games) && is_array($all_games)) {
    foreach ($all_games as $g) {
        if (!empty($g['category']) && !in_array($g['category'], $categories)) {
            $categories[] = $g['category'];
        }
    }
}
sort($categories);

// 3. Read parameters safely using OSSN input()
$selected_category = input('category', '', 'All');
$search_query      = input('q', '');

// New flag to detect if the AJAX request came specifically from the games filter
$is_games_ajax     = input('ossn_ajax_games', ''); 

if (empty($selected_category)) {
    $selected_category = 'All';
}

$display_games = $all_games;

// Filter by category
if ($selected_category !== 'All') {
    $display_games = array_filter($display_games, function($g) use ($selected_category) {
        return isset($g['category']) && strcasecmp($g['category'], $selected_category) === 0;
    });
}

// Filter by search query
if (!empty($search_query)) {
    $display_games = array_filter($display_games, function($g) use ($search_query) {
        $title_match = isset($g['title']) && stripos($g['title'], $search_query) !== false;
        $cat_match   = isset($g['category']) && stripos($g['category'], $search_query) !== false;
        return $title_match || $cat_match;
    });
}

$display_games = array_slice($display_games, 0, 150);

// -------------------------------------------------------------
// IF AJAX REQUEST: Check for 'ossn_ajax_games' flag so it doesn't conflict with Topbar PJAX
// -------------------------------------------------------------
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest' && $is_games_ajax == '1') {
    if (!empty($display_games)) {
        foreach ($display_games as $game) {
            ?>
            <div class="game-card">
                <a href="<?php echo ossn_site_url("play/game/{$game['id']}"); ?>">
                    <div class="game-thumbnail-wrapper">
                        <img src="<?php echo $game['thumbnail']; ?>" 
                             alt="<?php echo htmlspecialchars($game['title']); ?>" 
                             loading="lazy" />
                        <div class="game-play-overlay">
                            <i class="fa fa-play-circle"></i>
                        </div>
                    </div>
                    <div class="game-info">
                        <div class="game-title" title="<?php echo htmlspecialchars($game['title']); ?>">
                            <?php echo htmlspecialchars($game['title']); ?>
                        </div>
                        <span class="game-category"><?php echo htmlspecialchars($game['category']); ?></span>
                    </div>
                </a>
            </div>
            <?php
        }
    } else {
        echo '<div class="alert alert-info text-center w-100 my-3">' . ossn_print('games:no_results') . '</div>';
    }
    exit;
}
?>

<!-- -------------------------------------------------------------
     MAIN FULL PAGE VIEW
------------------------------------------------------------- -->
<div class="games-container">
    
    <!-- Top Header Bar with Live Search -->
    <div class="games-header-bar mb-3">
        <h3 class="m-0"><?php echo ossn_print('games:title'); ?></h3>
        
        <div class="games-search-box">
            <i class="fa fa-search search-icon"></i>
            <input type="text" 
                   id="ossn-game-search-input" 
                   class="form-control" 
                   placeholder="<?php echo ossn_print('games:search_placeholder'); ?>" 
                   value="<?php echo htmlspecialchars($search_query); ?>" />
        </div>
    </div>

    <!-- Category Filter Pills Bar -->
    <?php if (!empty($categories)): ?>
        <div class="games-filter-bar mb-4">
            <?php foreach ($categories as $cat): ?>
                <?php 
                    $active_class = (strcasecmp($selected_category, $cat) === 0) ? 'active' : '';
                    
                    // Dynamic translation key logic
                    $cat_key = 'games:category:' . strtolower($cat);
                    $translated_cat = ossn_print($cat_key);
                    
                    if ($translated_cat === $cat_key) {
                        $translated_cat = htmlspecialchars($cat);
                    }

                    if ($cat === 'All') {
                        $translated_cat = ossn_print('games:all_categories');
                    }
                ?>
                <button type="button" 
                        class="game-filter-pill <?php echo $active_class; ?>" 
                        data-category="<?php echo htmlspecialchars($cat); ?>">
                    <?php echo $translated_cat; ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Dynamic AJAX Grid Container -->
    <div class="games-grid-wrapper">
        <div class="games-loading-overlay d-none" id="games-loader">
            <div class="spinner-border text-primary" role="status"></div>
        </div>

        <div class="games-grid" id="ossn-games-grid">
            <?php if (!empty($display_games)): ?>
                <?php foreach ($display_games as $game): ?>
                    <div class="game-card">
                        <a href="<?php echo ossn_site_url("play/game/{$game['id']}"); ?>">
                            <div class="game-thumbnail-wrapper">
                                <img src="<?php echo $game['thumbnail']; ?>" 
                                     alt="<?php echo htmlspecialchars($game['title']); ?>" 
                                     loading="lazy" />
                                <div class="game-play-overlay">
                                    <i class="fa fa-play-circle"></i>
                                </div>
                            </div>
                            <div class="game-info">
                                <div class="game-title" title="<?php echo htmlspecialchars($game['title']); ?>">
                                    <?php echo htmlspecialchars($game['title']); ?>
                                </div>
                                <span class="game-category"><?php echo htmlspecialchars($game['category']); ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info text-center w-100 my-3">
                    <?php echo ossn_print('games:no_results'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- AJAX JavaScript Reload Script -->
<script>
$(document).ready(function() {
    let currentCategory = '<?php echo addslashes($selected_category); ?>';
    let searchTimeout = null;

    function reloadGamesGrid(category, query) {
        $('#games-loader').removeClass('d-none');
        
        let baseUrl = Ossn.site_url + 'play/all';
        let params = [];
        
        // Pass the flag to bypass PJAX topbar conflict
        params.push('ossn_ajax_games=1');
        
        if (category && category !== 'All') {
            params.push('category=' + encodeURIComponent(category));
        }
        if (query && query.trim() !== '') {
            params.push('q=' + encodeURIComponent(query.trim()));
        }
        
        let ajaxUrl = baseUrl;
        if (params.length > 0) {
            ajaxUrl += '?' + params.join('&');
        }

        // Silent AJAX Request (No pushState)
        $.ajax({
            url: ajaxUrl,
            type: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(htmlResponse) {
                $('#ossn-games-grid').html(htmlResponse);
                $('#games-loader').addClass('d-none');
            },
            error: function() {
                $('#games-loader').addClass('d-none');
            }
        });
    }

    // Category Pill Click Handler
    $(document).on('click', '.game-filter-pill', function(e) {
        e.preventDefault();
        $('.game-filter-pill').removeClass('active');
        $(this).addClass('active');

        currentCategory = $(this).attr('data-category');
        let searchQuery = $('#ossn-game-search-input').val();

        reloadGamesGrid(currentCategory, searchQuery);
    });

    // Real-time Search Input Handler
    $(document).on('input', '#ossn-game-search-input', function() {
        clearTimeout(searchTimeout);
        let searchQuery = $(this).val();

        searchTimeout = setTimeout(function() {
            reloadGamesGrid(currentCategory, searchQuery);
        }, 300);
    });
});
</script>