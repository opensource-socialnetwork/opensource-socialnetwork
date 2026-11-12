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

$game_id    = isset($params['game_id']) ? trim($params['game_id']) : '';
$cache_dir  = ossn_route()->themes . "fbui/vendors/games/";
$cache_file = $cache_dir . "gamepix_cache.json";
$gz_file    = $cache_dir . "gamepix_cache.json.gz";
$game       = null;

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
    $all_games = json_decode(file_get_contents($cache_file), true);
    if (!empty($all_games) && is_array($all_games)) {
        foreach ($all_games as $g) {
            if ((string)$g['id'] === (string)$game_id) {
                $game = $g;
                break;
            }
        }
    }
}

if (!$game) {
    echo '<div class="alert alert-danger my-4">' . ossn_print('games:not_found') . ' <a href="' . ossn_site_url('play/all') . '">' . ossn_print('games:back_to_games') . '</a></div>';
    return;
}
?>

<div class="game-play-container">
    <div class="game-play-header">
        <a href="<?php echo ossn_site_url('play/all'); ?>" class="btn-game-back">
            <i class="fa fa-arrow-left"></i> <?php echo ossn_print('games:back_to_games'); ?>
        </a>
        <h2 class="game-play-title"><?php echo htmlspecialchars($game['title']); ?></h2>
        
        <!-- Mobile-friendly Fullscreen Trigger Button -->
        <button type="button" class="btn-game-fullscreen" id="gameFullscreenBtn" title="Toggle Fullscreen">
            <i class="fa fa-expand" id="fullscreenIcon"></i> <?php echo ossn_print('fbui:games:fulls');?>
        </button>
    </div>

    <div class="game-iframe-stage" id="gameStage">
		<button type="button" class="btn-exit-fullscreen" id="exitFullscreenBtn" title="Exit Fullscreen">
    		<i class="fa fa-compress"></i> <?php echo ossn_print('fbui:games:exitfs');?>
		</button>    
        <div class="game-iframe-wrapper">
            <iframe 
                src="<?php echo $game['embed_url']; ?>" 
                id="game-iframe" 
                allowfullscreen="true" 
                msallowfullscreen="true" 
                mozallowfullscreen="true" 
                webkitallowfullscreen="true" 
                allow="autoplay; payment; fullscreen; microphone; clipboard-read; clipboard-write; accelerometer; gyroscope; magnetometer; gamepad"
                frameborder="0" 
                scrolling="no">
            </iframe>
        </div>
    </div>

    <?php if (!empty($game['description'])): ?>
        <div class="game-details-card">
            <h4>About <?php echo htmlspecialchars($game['title']); ?></h4>
            <p><?php echo nl2br(htmlspecialchars($game['description'])); ?></p>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const fullscreenBtn = document.getElementById('gameFullscreenBtn');
	const gameStage = document.getElementById('gameStage');
	const icon = document.getElementById('fullscreenIcon');
	const exitBtn = document.getElementById('exitFullscreenBtn');
	if (exitBtn) {
		exitBtn.addEventListener('click', function(e) {
			e.stopPropagation();
			if (document.exitFullscreen) {
				document.exitFullscreen();
			} else if (document.webkitExitFullscreen) {
				document.webkitExitFullscreen();
			}
		});
	}
	if (fullscreenBtn && gameStage) {
		fullscreenBtn.addEventListener('click', function() {
			if (!document.fullscreenElement && !document.webkitFullscreenElement) {
				// Enter Fullscreen
				if (gameStage.requestFullscreen) {
					gameStage.requestFullscreen().catch(err => {
						console.error("Error attempting to enable fullscreen:", err.message);
					});
				} else if (gameStage.webkitRequestFullscreen) {
					gameStage.webkitRequestFullscreen();
				}
			} else {
				// Exit Fullscreen
				if (document.exitFullscreen) {
					document.exitFullscreen();
				} else if (document.webkitExitFullscreen) {
					document.webkitExitFullscreen();
				}
			}
		});

		// Update icon state on change
		document.addEventListener('fullscreenchange', updateFullscreenIcon);
		document.addEventListener('webkitfullscreenchange', updateFullscreenIcon);

		function updateFullscreenIcon() {
			if (document.fullscreenElement || document.webkitFullscreenElement) {
				icon.className = 'fa fa-compress';
			} else {
				icon.className = 'fa fa-expand';
			}
		}
	}
});
</script>