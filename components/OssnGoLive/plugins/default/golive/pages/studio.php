<?php
/**
 * Open Source Social Network
 *
 * @package   OssnGoLive
 */
?>
<div class="golive-immersive-studio">
    <!-- Main Immersive Video Stage -->
    <div class="golive-stage-container">
		<div id="golive-status-badge" class="golive-badge offline">
            <span class="badge-dot"></span> <?php echo ossn_print('golive:status:offline'); ?>
        </div>
        
        <!-- Live Viewer Count Badge (Reserved for RTMP / future integration) -->
		<div id="golive-viewer-badge" class="golive-viewer-count-badge" style="display: none;">
            <i class="fa fa-eye"></i> <span id="studio-live-counter">0</span>
        </div>
        
        <video id="golive-preview" autoplay muted playsinline></video>
        
        <!-- Flying Reactions Container (Facebook-style floating likes/emojis) -->
        <div class="golive-flying-reactions-container"></div>

        <!-- Studio Live Comments Overlay (Visible only when LIVE) -->
        <div id="golive-studio-interactions" class="golive-studio-interactions" style="display:none;">
            <div id="golive-studio-chat-stream" class="golive-studio-chat-stream">
                <!-- Incoming comments append here dynamically -->
            </div>
        </div>
        
        <div id="golive-camera-error" class="golive-error-overlay" style="display:none;">
            <i class="fa fa-video-slash fa-2x"></i>
            <p><?php echo ossn_print('golive:error:camera'); ?></p>
        </div>

        <!-- Floating Top Header Bar -->
        <div class="golive-top-bar">
            <a href="<?php echo ossn_site_url(); ?>" class="golive-icon-btn" title="<?php echo ossn_print('golive:exit'); ?>">
                <i class="fa fa-arrow-left"></i>
            </a>
            <div class="golive-top-title"><?php echo ossn_print('golive:top:title'); ?></div>
            <button id="golive-settings-toggle" class="golive-icon-btn" title="<?php echo ossn_print('golive:settings:title'); ?>">
                <i class="fa fa-cog"></i>
            </button>
        </div>

        <!-- Floating Bottom Action Bar -->
        <div class="golive-bottom-bar">
            <button id="golive-start-btn" class="golive-action-pill golive-btn-live">
                <i class="fa fa-broadcast-tower"></i> <?php echo ossn_print('golive:go:live'); ?>
            </button>
            <button id="golive-stop-btn" class="golive-action-pill golive-btn-end" style="display:none;">
                <i class="fa fa-stop-circle"></i> <?php echo ossn_print('golive:end:stream'); ?>
            </button>
        </div>
    </div>

    <!-- Settings Popup Modal -->
    <div id="golive-settings-modal" class="golive-modal-backdrop" style="display:none;">
        <div class="golive-modal-card">
            <div class="golive-modal-header">
                <h3><i class="fa fa-cog"></i> <?php echo ossn_print('golive:settings:modal:title'); ?></h3>
                <button id="golive-modal-close" class="golive-close-btn">&times;</button>
            </div>
            <div class="golive-modal-body">
                <div class="golive-form-group">
                    <label><i class="fa fa-video"></i> <?php echo ossn_print('golive:select:camera'); ?></label>
                    <select id="golive-video-source" class="golive-select"></select>
                </div>
                <div class="golive-form-group">
                    <label><i class="fa fa-microphone"></i> <?php echo ossn_print('golive:select:mic'); ?></label>
                    <select id="golive-audio-source" class="golive-select"></select>
                </div>
            </div>
        </div>
    </div>

    <!-- Pro Extension Hook -->
    <div id="golive-pro-extension-area">
        <?php echo ossn_plugin_view('golive/pro/interactions'); ?>
    </div>
</div>
<script>
let studioCommentId = 0;
let studioLikeId = 0;
let studioPollInterval = null;
let isPollingAjax = false; // <--- Prevents concurrent overlapping requests

function startStudioInteractions() {
    const liveInputId = $('.golive-immersive-studio').data('live-input-id');
    if (!liveInputId) return;

    // Keep comments hidden initially until a comment actually arrives
    $('#golive-studio-interactions').hide();
    $('#golive-viewer-badge').fadeIn(300);

    if (studioPollInterval) clearInterval(studioPollInterval);

    studioPollInterval = setInterval(function() {
        if (isPollingAjax) return;
        isPollingAjax = true;

        $.ajax({
            url: Ossn.AddTokenToUrl(Ossn.site_url + 'action/golive/comments_likes'),
            type: 'GET',
            data: {
                live_input_id: liveInputId,
                last_id_comment: studioCommentId,
                last_id_like: studioLikeId
            },
            dataType: 'json',
            success: function(response) {
                if (response && response.success) {

                    // Update Live Viewer Count (only show if > 0)
                    if (response.viewers_count !== undefined) {
                        const count = parseInt(response.viewers_count, 10) || 0;
                        if (count > 0) {
                            $('#studio-live-counter').text(count);
                            $('#golive-viewer-badge').fadeIn(200);
                        } else {
                            $('#studio-live-counter').text('0');
                            $('#golive-viewer-badge').fadeOut(200);
                        }
                    }

                    // Append New Comments and only show container if comments exist
                    if (response.comments && response.comments.length > 0) {
                        let addedNewComment = false;

                        response.comments.forEach(function(comment) {
                            studioCommentId = Math.max(studioCommentId, comment.id);

                            if ($(`#golive-comment-${comment.id}`).length === 0) {
                                const commentHtml = `
                                    <div id="golive-comment-${comment.id}" class="golive-chat-item">
                                        <img src="${comment.user.icon}" class="golive-chat-avatar" />
                                        <div class="golive-chat-content">
                                            <span class="golive-chat-name">${comment.user.fullname}</span>
                                            <span class="golive-chat-text">${comment.text}</span>
                                        </div>
                                    </div>`;
                                $('#golive-studio-chat-stream').append(commentHtml);
                                addedNewComment = true;
                            }
                        });

                        if (addedNewComment || $('#golive-studio-chat-stream .golive-chat-item').length > 0) {
                            $('#golive-studio-interactions').fadeIn(300);
                        }

                        const chatStream = document.getElementById('golive-studio-chat-stream');
                        if (chatStream) {
                            chatStream.scrollTop = chatStream.scrollHeight;
                        }
                    }

                    // Spawn Floating Reactions
                    if (response.reactions && response.reactions.length > 0) {
                        response.reactions.forEach(function(reaction) {
                            studioLikeId = Math.max(studioLikeId, reaction.id);
                            spawnStudioReactionBubble(reaction.type);
                        });
                    }
                }
            },
            complete: function() {
                isPollingAjax = false;
            }
        });
    }, 3000);
}

function stopStudioInteractions() {
    if (studioPollInterval) {
        clearInterval(studioPollInterval);
        studioPollInterval = null;
    }
    studioCommentId = 0;
    studioLikeId = 0;
    isPollingAjax = false;
    $('#golive-studio-interactions').hide();
    $('#golive-studio-chat-stream').empty();
}

function getReactionIcon(type) {
    switch(type) {
        case 'love': return '<i class="fa fa-heart" style="color: #e0245e;"></i>';
        case 'haha': return '<i class="fa fa-laugh" style="color: #f6c343;"></i>';
        case 'wow': return '<i class="fa fa-surprise" style="color: #f6c343;"></i>';
        case 'sad': return '<i class="fa fa-sad-tear" style="color: #f6c343;"></i>';
        case 'angry': return '<i class="fa fa-angry" style="color: #e0245e;"></i>';
        default: return '<i class="fa fa-thumbs-up" style="color: #1877f2;"></i>';
    }
}

function spawnStudioReactionBubble(type) {
    const $container = $('.golive-flying-reactions-container');
    if ($container.length === 0) return;

    const iconHtml = getReactionIcon(type);
    const $bubble = $(`<div class="golive-flying-reaction">${iconHtml}</div>`);
    
    const randomX = Math.floor(Math.random() * 30) - 15;
    $bubble.css('right', (15 + randomX) + 'px');
    
    $container.append($bubble);
    
    setTimeout(function() {
        $bubble.remove();
    }, 2000);
}

// Automatically trigger/stop interaction polling when stream badge status changes
$(document).ready(function() {
    const observer = new MutationObserver(function(mutations) {
        if ($('#golive-status-badge').hasClass('live')) {
            $('#golive-viewer-badge').fadeIn(200);
            startStudioInteractions();
        } else {
            $('#golive-viewer-badge').fadeOut(200);
            $('#studio-live-counter').text('0');
            stopStudioInteractions();
        }
    });
    
    if ($('#golive-status-badge').length) {
        observer.observe(document.getElementById('golive-status-badge'), { attributes: true, attributeFilter: ['class'] });
    }
});
</script>