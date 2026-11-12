<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network
 * @author     Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license    Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link       https://www.opensource-socialnetwork.org/
 */

if (!ossn_isLoggedin()) {
    return;
}

$user = ossn_loggedin_user();

// 1. Get total friend count
$count = (int) $user->getFriends($user->guid, array('count' => true));

// 2. Fetch initial page 1 friends batch
$friends = $user->getFriends($user->guid);

// Helper function for activity status
if (!function_exists('fbui_get_friend_status')) {
    function fbui_get_friend_status($friend) {
        $time = time();
        $last_activity = isset($friend->last_activity) ? (int)$friend->last_activity : 0;
        $diff = $time - $last_activity;

        if ($diff <= 180) { // Active within 3 minutes = Online Green Dot
            return array('status' => 'online', 'badge' => '');
        } elseif ($diff <= 3600) { // Active within 60 minutes = Minutes badge
            $mins = max(1, floor($diff / 60));
            return array('status' => 'recent', 'badge' => "{$mins}m");
        }

        return array('status' => 'offline', 'badge' => '');
    }
}
?>
<div class="fbui-newsfeed-contacts-widget">
    <div class="fbui-contacts-header">
        <span class="fbui-contacts-title"><?php echo ossn_print('fbui:chat:contacts'); ?></span>
        <div class="fbui-contacts-actions">
            <button class="fbui-contact-icon-btn me-0" id="fbui-toggle-search" title="Search" type="button">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Toggleable Search Input Box -->
    <div class="fbui-contacts-search" id="fbui-contacts-search-box" style="display:none;">
        <input type="text" id="fbui-contact-search-input" placeholder="Search contacts..." />
    </div>

    <!-- Scrollable Contacts List Container -->
    <ul class="fbui-contacts-list" id="fbui-newsfeed-contacts-list" data-current-offset="1">
        <?php 
        if ($friends) {
            foreach ($friends as $friend) {
                $status_info = fbui_get_friend_status($friend);
                $status = $status_info['status'];
                $badge = $status_info['badge'];
                ?>
                <li class="fbui-contact-item" data-guid="<?php echo $friend->guid; ?>" onclick="Ossn.ChatnewTab(<?php echo $friend->guid; ?>);">
                    <div class="fbui-contact-avatar-wrapper">
                        <img src="<?php echo $friend->iconURL()->small; ?>" alt="<?php echo $friend->fullname; ?>" />
                        
                        <?php if ($status === 'online'): ?>
                            <span class="fbui-status-badge fbui-status-online"></span>
                        <?php elseif ($status === 'recent'): ?>
                            <span class="fbui-status-badge fbui-status-recent"><?php echo $badge; ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <span class="fbui-contact-name"><?php echo $friend->fullname; ?></span>
                </li>
                <?php
            }
        }
        ?>

        <!-- Scroll Loading Sentinel -->
        <li id="fbui-contacts-scroll-sentinel" style="display:none;">
            <div class="ossn-loading"></div>
        </li>
    </ul>

    <!-- Native OSSN Pagination Container -->
    <div class="fbui-contacts-pagination-container" id="fbui-contacts-pagination-wrapper">
        <?php echo ossn_view_pagination($count); ?>
    </div>
</div>

<script>
(function() {
    function initContactsWidget() {
        var listEl = document.getElementById('fbui-newsfeed-contacts-list');
        var sentinelEl = document.getElementById('fbui-contacts-scroll-sentinel');
        var pagWrapper = document.getElementById('fbui-contacts-pagination-wrapper');
        var searchInput = document.getElementById('fbui-contact-search-input');
        var toggleBtn = document.getElementById('fbui-toggle-search');
        var searchBox = document.getElementById('fbui-contacts-search-box');
        
        var loading = false;
        var searchTimeout = null;

        if (!listEl) return;

        // Check if current active page has a next page
        function hasMorePages() {
            if (!pagWrapper) return false;
            var activeLi = pagWrapper.querySelector('li.active');
            if (!activeLi) return false;

            var nextLi = activeLi.nextElementSibling;
            if (nextLi) {
                var link = nextLi.querySelector('a');
                if (link && link.getAttribute('href')) {
                    var match = link.getAttribute('href').match(/offset=(\d+)/);
                    var currentOffset = parseInt(listEl.getAttribute('data-current-offset')) || 1;
                    if (match && parseInt(match[1]) > currentOffset) {
                        return true;
                    }
                }
            }
            return false;
        }

        function loadNextChunk(isSearchReset) {
            if (loading) return;

            var currentOffset = parseInt(listEl.getAttribute('data-current-offset')) || 1;
            var nextOffset = isSearchReset ? 1 : (currentOffset + 1);

            if (!isSearchReset && !hasMorePages()) {
                return; // Reached last page
            }

            loading = true;
            sentinelEl.style.display = 'flex';

            var searchTerm = searchInput ? encodeURIComponent(searchInput.value.trim()) : '';
            var actionUrl = Ossn.site_url + 'action/fbuichat/friends?offset=' + nextOffset + '&search_term=' + searchTerm;

            if (typeof Ossn !== 'undefined' && Ossn.AddTokenToUrl) {
                actionUrl = Ossn.AddTokenToUrl(actionUrl);
            }

            var xhr = new XMLHttpRequest();
            xhr.open('GET', actionUrl, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.onload = function() {
                sentinelEl.style.display = 'none';

                if (xhr.status >= 200 && xhr.status < 400) {
                    try {
                        var response = JSON.parse(xhr.responseText);

                        if (response.pagination && pagWrapper) {
                            pagWrapper.innerHTML = response.pagination;
                        }

                        if (isSearchReset) {
                            var items = listEl.querySelectorAll('.fbui-contact-item');
                            for (var i = 0; i < items.length; i++) {
                                items[i].remove();
                            }
                            sentinelEl.insertAdjacentHTML('beforebegin', response.html);
                            listEl.setAttribute('data-current-offset', 1);
                        } else if (response.html && response.html.trim() !== '') {
                            sentinelEl.insertAdjacentHTML('beforebegin', response.html);
                            listEl.setAttribute('data-current-offset', nextOffset);
                        }
                    } catch (e) {
                        console.error('JSON Parse Error:', e);
                    }
                }
                loading = false;
            };

            xhr.onerror = function() {
                sentinelEl.style.display = 'none';
                loading = false;
            };

            xhr.send();
        }

        // ==========================================================
        // DYNAMIC ONLINE STATUS POLLING (using data-guid)
        // ==========================================================
        function updateVisibleContactsStatus() {
            var contactItems = listEl.querySelectorAll('.fbui-contact-item[data-guid]');
            var guids = [];

            contactItems.forEach(function(item) {
                var guid = item.getAttribute('data-guid');
                if (guid) {
                    guids.push(guid);
                }
            });

            if (guids.length === 0) return;

            var actionUrl = Ossn.site_url + 'action/fbuichat/contacts_status';
            if (typeof Ossn !== 'undefined' && Ossn.AddTokenToUrl) {
                actionUrl = Ossn.AddTokenToUrl(actionUrl);
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', actionUrl, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 400) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        if (response && response.statuses) {
                            for (var guid in response.statuses) {
                                var info = response.statuses[guid];
                                var item = listEl.querySelector('.fbui-contact-item[data-guid="' + guid + '"]');
                                
                                if (item) {
                                    var avatarWrapper = item.querySelector('.fbui-contact-avatar-wrapper');
                                    var badge = avatarWrapper.querySelector('.fbui-status-badge');

                                    if (info.status === 'online') {
                                        if (badge) {
                                            badge.className = 'fbui-status-badge fbui-status-online';
                                            badge.textContent = '';
                                        } else {
                                            avatarWrapper.insertAdjacentHTML('beforeend', '<span class="fbui-status-badge fbui-status-online"></span>');
                                        }
                                    } else if (info.status === 'recent') {
                                        if (badge) {
                                            badge.className = 'fbui-status-badge fbui-status-recent';
                                            badge.textContent = info.badge;
                                        } else {
                                            avatarWrapper.insertAdjacentHTML('beforeend', '<span class="fbui-status-badge fbui-status-recent">' + info.badge + '</span>');
                                        }
                                    } else {
                                        if (badge) {
                                            badge.remove();
                                        }
                                    }
                                }
                            }
                        }
                    } catch (e) {
                        console.error('Status Update Error:', e);
                    }
                }
            };

            var params = 'guids=' + encodeURIComponent(guids.join(','));
            xhr.send(params);
        }

        // Direct Native Scroll Listener
        listEl.addEventListener('scroll', function() {
            if (listEl.scrollTop + listEl.clientHeight >= listEl.scrollHeight - 50) {
                loadNextChunk(false);
            }
        });

        // Search Toggle Handler
        if (toggleBtn && searchBox) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (searchBox.style.display === 'none' || !searchBox.style.display) {
                    searchBox.style.display = 'block';
                    if (searchInput) searchInput.focus();
                } else {
                    searchBox.style.display = 'none';
                }
            });
        }

        // Search Input Handler
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    loadNextChunk(true);
                }, 300);
            });
        }

        // Start status polling interval (every 10 seconds)
        setInterval(updateVisibleContactsStatus, 10000);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initContactsWidget);
    } else {
        initContactsWidget();
    }
})();
</script>