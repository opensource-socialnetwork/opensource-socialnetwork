//<script>
$(document).ready(function() {
    // Listen for all successful AJAX requests globally
    $(document).ajaxSuccess(function(event, xhr, settings) {
        
        // Define the specific endpoint URLs we want to intercept
        var targetEndpoints = [
            'action/wall/post/a',
            'action/wall/post/b',
            'action/wall/post/g'
        ];

        // Check if the URL of the current AJAX request matches any of our targets
        var isMatch = targetEndpoints.some(function(endpoint) {
            return settings.url.indexOf(endpoint) !== -1;
        });

        // If it matches one of those actions, hide the modal
        if (isMatch) {
            // Hide the modal overlay
            $('#fbui-modal-close-btn').trigger('click');
        }
    });
});
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip({
		placement:'left',										  
	}); 
	//hide the comment-like-menu,  can't add code in comment or like as both needs
	if (Ossn.Config.isLoggedin === false) {
    	$('<style>').prop('type', 'text/css').html('.menu-likes-comments-share { display: none !important; }').appendTo('head');
	}
	
	var $chatsidebar = $('.ossn-chat-windows-long .inner');
	if($chatsidebar.length){
		$chatsidebar.css('height', $(window).height() - 45);
	}
	$(document).on("scroll", function() {
		$document_height = $(document).height();						
		//$(".sidebar").height($document_height);
		
		if($chatsidebar.length){
			if ($(document).scrollTop() >= 50) {
				$chatsidebar.addClass('ossnchat-scroll-top');
				$chatsidebar.css('height', $(window).height());
			} else if ($(document).scrollTop() == 0) {
				$chatsidebar.removeClass('ossnchat-scroll-top');
				$chatsidebar.css('height', $(window).height() - 45);
			}
		}
	});
	if($(document).innerWidth() >= 1300){
		$('#sidebar-toggle').trigger('click');
	}
});
//https://www.opensource-socialnetwork.org/component/view/3657/optimize-pre-loader
$(document).ready(function() {
	   $(".ossn-page-loading-annimation").fadeOut("slow");
});

$(window).on('load resize', function () {
	if (document.querySelector("#draggable")) {
		var current_cover_height = 0;
		var current_cover_width = 0;
		if($('.profile-cover').length) {
			current_cover_height = ~~($('.profile-cover').height() + 0.5);
			current_cover_width = ~~($('.profile-cover').width() + 0.5);
		} else if($('.ossn-group-cover').length) {
			current_cover_height = ~~($('.ossn-group-cover').height() + 0.5);
			current_cover_width = ~~($('.ossn-group-cover').width() + 0.5);
		}
		if (current_cover_width < 1024) {
			var theme_config = $('#ossn-theme-config');
			var default_cover_height = theme_config.attr('data-desktop-cover-height');
			var default_cover_width = theme_config.attr('data-minimum-cover-image-width');
					
			// we're on mobile
			const desktop_cover_width  = default_cover_width;
			const desktop_cover_height = default_cover_height;
			
			var real_image_width  = document.querySelector("#draggable").naturalWidth;
			var real_image_height = document.querySelector("#draggable").naturalHeight;
			// 1. how many mobile heights would we need to hold the image?
			var mobile_height_factor = real_image_height / current_cover_height;
			// 2. how many pixels wide would be the scaled mobile image in comparison to fix desktop_cover_width?
			var mobile_pixel_width = desktop_cover_width / mobile_height_factor;
			// 3. how often would these pixels fit into the current coverwidth?
			var mobile_width_factor = current_cover_width / mobile_pixel_width;
			// 4. how many pixels do we get with the current mobile cover height?
			var mobile_pixel_height = mobile_width_factor * current_cover_height;
			// setting the new height already here allows us to retrieve the new scaled image width calculated by the browser
			$('#draggable').css('height', mobile_pixel_height);
			mobile_pixel_width = parseInt($('#draggable').css('width'));
			
			// 5. calculate the height-scaling factor for dragging - get maximum possible scroll top position
			var desktop_scroll_top_max = real_image_height - desktop_cover_height;
			var mobile_scroll_top_max  = mobile_pixel_height - current_cover_height;
			var height_scaling_factor  = desktop_scroll_top_max / mobile_scroll_top_max;
			// 6. calculate the width-scaling factor for dragging - get maximum possible scroll left position
			var desktop_scroll_left_max = real_image_width - desktop_cover_width;
			var mobile_scroll_left_max  = mobile_pixel_width - current_cover_width;
			var width_scaling_factor  = desktop_scroll_left_max / mobile_scroll_left_max;
			// 7. retrieve the saved dragging positions and scale accordingly
			var cover_top    = parseInt($('#draggable').data('top'));
			var cover_left   = parseInt($('#draggable').data('left'));
			var mobile_pixel_top  = cover_top / height_scaling_factor;
			var mobile_pixel_left = cover_left / width_scaling_factor;
			$('#draggable').css('top', mobile_pixel_top);
			$('#draggable').css('left', mobile_pixel_left);
		}
	// don't display cover images before final scale and position is known
	$('#draggable').fadeIn();
	}
});

$(document).ready(function() {
    // Open Modal when Dummy Box is clicked
    $(document).on('click', '#fbui-wall-dummy', function() {
        $('#fbui-wall-modal-overlay').fadeIn(150, function() {
            $(this).find('.ossn-wall-textarea').focus();
        });
        $('body').css('overflow', 'hidden');
    });

    // Close Modal via 'X' button
    $(document).on('click', '#fbui-modal-close-btn', function() {
        closeFBWallModal();
    });

    // Close Modal when clicking dark backdrop
    $(document).on('click', '#fbui-wall-modal-overlay', function(e) {
        if ($(e.target).hasClass('fbui-wall-modal-overlay')) {
            closeFBWallModal();
        }
    });

    function closeFBWallModal() {
        $('#fbui-wall-modal-overlay').fadeOut(150);
        $('body').css('overflow', 'auto');
    }
});
$(document).ready(function() {
    
    // --- 1. WALL TABS SCROLLER & ARROW CHECK ---
    function initWallTabScroller() {
        $('.wall-tabs').each(function() {
            var $tabs = $(this);
            
            // Wrap if not wrapped
            if (!$tabs.parent().hasClass('wall-tabs-wrapper')) {
                $tabs.wrap('<div class="wall-tabs-wrapper" style="position: relative; width: 100%; display: flex; align-items: center;"></div>');
            }
            var $wrapper = $tabs.parent();

            // Inject arrows if missing
            if ($wrapper.find('.wall-tab-arrow').length === 0) {
                $wrapper.append('<button type="button" class="wall-tab-arrow wall-tab-arrow-left" style="position:absolute; top:50%; transform:translateY(-50%); left:4px; width:28px; height:28px; border-radius:50%; background:#fff; border:none; box-shadow:0 2px 8px rgba(0,0,0,0.18); display:none; align-items:center; justify-content:center; cursor:pointer; z-index:10;"><i class="fa fa-chevron-left" style="font-size:12px; color:#65676b;"></i></button>');
                $wrapper.append('<button type="button" class="wall-tab-arrow wall-tab-arrow-right" style="position:absolute; top:50%; transform:translateY(-50%); right:4px; width:28px; height:28px; border-radius:50%; background:#fff; border:none; box-shadow:0 2px 8px rgba(0,0,0,0.18); display:none; align-items:center; justify-content:center; cursor:pointer; z-index:10;"><i class="fa fa-chevron-right" style="font-size:12px; color:#65676b;"></i></button>');
            }

            var $btnLeft = $wrapper.find('.wall-tab-arrow-left');
            var $btnRight = $wrapper.find('.wall-tab-arrow-right');

            function updateArrows() {
                var el = $tabs[0];
                if (!el) return;

                // Calculate total width of all tabs combined
                var totalTabsWidth = 0;
                $tabs.find('.item').each(function() {
                    totalTabsWidth += $(this).outerWidth(true);
                });

                // Get visible wrapper container width
                var wrapperWidth = $wrapper.width();
                
                // True if combined tabs width exceeds the wrapper box width
                var hasOverflow = totalTabsWidth > wrapperWidth;
                var scrollLeft = el.scrollLeft;

                // Show left arrow if scrolled to the right
                if (hasOverflow && scrollLeft > 2) {
                    $btnLeft.css('display', 'flex');
                } else {
                    $btnLeft.hide();
                }

                // Show right arrow if there is content hidden to the right
                if (hasOverflow && (scrollLeft + wrapperWidth < totalTabsWidth - 2)) {
                    $btnRight.css('display', 'flex');
                } else {
                    $btnRight.hide();
                }
            }

            // Run check on load, resize, and scroll
            updateArrows();
            setTimeout(updateArrows, 50);
            setTimeout(updateArrows, 200);
            
            $tabs.off('scroll.tabNav').on('scroll.tabNav', updateArrows);
            $(window).off('resize.tabNav').on('resize.tabNav', updateArrows);

            // Arrow click handlers
            $btnLeft.off('click').on('click', function(e) {
                e.preventDefault();
                $tabs.animate({ scrollLeft: '-=160' }, 200, updateArrows);
            });

            $btnRight.off('click').on('click', function(e) {
                e.preventDefault();
                $tabs.animate({ scrollLeft: '+=160' }, 200, updateArrows);
            });
        });
    }

    // Run on initial load and when modals/forms are interacted with
    initWallTabScroller();
    $(document).on('click', '.fbui-wall-dummy-box, [data-bs-toggle="modal"], .ossn-wall-container', function() {
        setTimeout(initWallTabScroller, 100);
    });

    // --- 2. CLOSE WALL MODAL WHEN CLICKING ON A TAB ---
    $(document).on('click', '.wall-tabs .item', function() {
        $('.fbui-wall-modal-overlay').fadeOut(200, function() {
            $(this).remove();
        });
    });

    // --- 3. TOP NAV TAB & SEARCH ANIMATIONS ---
    if ($('#fbui-ajax-loader').length === 0) {
        $('body').append('<div id="fbui-ajax-loader"></div>');
    }

    let isNavigating = false;

    window.addEventListener('beforeunload', function() {
        if (!isNavigating) {
            isNavigating = true;
            $('#fbui-ajax-loader').show().css('width', '15%').animate({width: '90%'}, 300);
        }
    });

    $(document).on('click', '.fbui-nav-tabs li:not(.nav-tab-profile) a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let $clickedTab = $(this).parent('li');

        if ($clickedTab.hasClass('active')) return;

        $('.fbui-nav-tabs li').removeClass('active');
        $clickedTab.addClass('active');

        isNavigating = true;
        $('#fbui-ajax-loader').show().css('width', '10%').animate({width: '75%'}, 300);

        setTimeout(function() {
            window.location.href = url;
        }, 50);
    });

    $(document).on('submit', '#fbui-search-form', function(e) {
        e.preventDefault();
        let formAction = $(this).attr('action');
        let queryVal = $('#fbui-search-input').val();
        
        isNavigating = true;
        $('#fbui-ajax-loader').show().css('width', '15%').animate({width: '85%'}, 300);

        setTimeout(() => {
            window.location.href = formAction + '?q=' + encodeURIComponent(queryVal);
        }, 100);
    });

    $('#fbui-search-input').on('keyup', function() {
        let query = $(this).val().trim();
        let $dropdown = $('#fbui-search-dropdown');
        
        $('#fbui-search-query-text').text(query);
        if (query.length > 0) {
            $dropdown.show();
        } else {
            $dropdown.hide();
        }
    });

    $('#fbui-search-redirect-btn').on('click', function(e) {
        e.preventDefault();
        $('#fbui-search-form').submit();
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.fbui-search-box').length) {
            $('#fbui-search-dropdown').hide();
        }
    });

});
//topbar
$(document).ready(function() {
    
    // Ensure the loader exists
    if ($('#fbui-ajax-loader').length === 0) {
        $('body').append('<div id="fbui-ajax-loader"></div>');
    }

    let isNavigating = false;

    // --- 0. UNIVERSAL LOADER FOR REAL PAGE UNLOADS ---
    window.addEventListener('beforeunload', function(e) {
        if (!isNavigating) {
            isNavigating = true;
            $('#fbui-ajax-loader').show().css('width', '15%').animate({width: '90%'}, 300);
        }
    });

    // --- 1. SHOW LOADER ON NAV TAB CLICKS ---
    $(document).on('click', '.fbui-nav-tabs li:not(.nav-tab-profile) a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let $clickedTab = $(this).parent('li');

        if ($clickedTab.hasClass('active')) return;

        $('.fbui-nav-tabs li').removeClass('active');
        $clickedTab.addClass('active');

        isNavigating = true;
        $('#fbui-ajax-loader').show().css('width', '10%').animate({width: '75%'}, 300);

        setTimeout(function() {
            window.location.href = url;
        }, 50);
    });

    // --- 2. SHOW LOADER ON SEARCH FORM SUBMISSION ---
    $(document).on('submit', '#fbui-search-form', function(e) {
        e.preventDefault();
        let formAction = $(this).attr('action');
        let queryVal = $('#fbui-search-input').val();
        
        isNavigating = true;
        // Trigger top loading bar animation
        $('#fbui-ajax-loader').show().css('width', '15%').animate({width: '85%'}, 300);

        // Submit the form manually after animation starts
        setTimeout(() => {
            window.location.href = formAction + '?q=' + encodeURIComponent(queryVal);
        }, 100);
    });

    // Show dropdown when user types
    $('#fbui-search-input').on('keyup', function() {
        let query = $(this).val().trim();
        let $dropdown = $('#fbui-search-dropdown');
        
        $('#fbui-search-query-text').text(query);

        if (query.length > 0) {
            $dropdown.show();
        } else {
            $dropdown.hide();
        }
    });

    // Clicking the dropdown option triggers the form submission (and therefore the animation)
    $('#fbui-search-redirect-btn').on('click', function(e) {
        e.preventDefault();
        $('#fbui-search-form').submit();
    });

    // Hide dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.fbui-search-box').length) {
            $('#fbui-search-dropdown').hide();
        }
    });

});
$(document).ready(function() {
    // --- 2. SWIPE GESTURE SUPPORT (MOBILE) ---
    // Swiping will also trigger a real page load to keep everything clean
    let touchstartX = 0;
    let touchstartY = 0;
    let touchendX = 0;
    let touchendY = 0;

    const swipeArea = document.querySelector('body'); 

    function handleGesture() {
        let diffX = touchendX - touchstartX;
        let diffY = touchendY - touchstartY;
        
        // Ensure this is a horizontal swipe, NOT a vertical scroll
        if (Math.abs(diffX) > Math.abs(diffY)) {
            
            // If horizontal swipe distance is significant (threshold: 75px)
            if (Math.abs(diffX) > 75) {
                let $tabs = $('.fbui-nav-tabs li:not(.nav-tab-profile)');
                let currentIndex = $tabs.index($('.fbui-nav-tabs li.active'));
                let nextIndex = -1;

                if (diffX < 0) {
                    // Swiped Left -> Move to next tab
                    nextIndex = currentIndex + 1;
                } else {
                    // Swiped Right -> Move to previous tab
                    nextIndex = currentIndex - 1;
                }

                // If the next tab exists, trigger the click logic we built above
                if (nextIndex >= 0 && nextIndex < $tabs.length) {
                    let $nextTabAnchor = $tabs.eq(nextIndex).find('a');
                    $nextTabAnchor.trigger('click');
                }
            }
        }
    }

    // Attach touch listeners
    swipeArea.addEventListener('touchstart', e => {
        touchstartX = e.changedTouches[0].screenX;
        touchstartY = e.changedTouches[0].screenY;
    }, { passive: true });

    swipeArea.addEventListener('touchend', e => {
        touchendX = e.changedTouches[0].screenX;
        touchendY = e.changedTouches[0].screenY;
        handleGesture();
    }, { passive: true });

});
$(document).ready(function() {
    // Show dropdown when user types
    $('#fbui-search-input').on('keyup', function() {
        let query = $(this).val().trim();
        let $dropdown = $('#fbui-search-dropdown');
        
        $('#fbui-search-query-text').text(query);

        if (query.length > 0) {
            $dropdown.show();
        } else {
            $dropdown.hide();
        }
    });

    // Clicking the dropdown option submits the form to the actual search page
    $('#fbui-search-redirect-btn').on('click', function(e) {
        e.preventDefault();
        $('#fbui-search-form').submit();
    });

    // Hide dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.fbui-search-box').length) {
            $('#fbui-search-dropdown').hide();
        }
    });
});
//sidebar right col fixed<br />
$(document).ready(function() {    
    var themeAwesome = $('#navbarNavDropdown').length > 0;
    
    function handleSidebarScroll(event) {
        var newsColumn, adsColumn, focusColumn;
        const CONTENT_TOP_MARGIN = 10;
        const FLOATING_BOTTOM_MARGIN = 20;

        var feed_columns = ['.newsfeed-middle', '.ossn-profile-wall', '.group-wall', '.user-activity'];
        var side_columns = ['.newsfeed-right-sticky-wrapper', '.ossn-profile-sidebar', '.page-sidebar', '.business-page-right-bottom'];
        
        for(var i = 0; i < feed_columns.length; i++) {
            if($(feed_columns[i]).length) {
                newsColumn = $(feed_columns[i]).closest("[class*='col-md-'], [class*='col-lg-'], [class*='col-xl-']");
                adsColumn = $(side_columns[i]).closest("[class*='col-md-'], [class*='col-lg-'], [class*='col-xl-']");
                focusColumn = $(adsColumn).children().first();
                break;
            }
        }

        if(!focusColumn || !focusColumn.length || !newsColumn || !newsColumn.length) {
            return;
        }

        var isSideBySide = Math.abs(adsColumn.offset().top - newsColumn.offset().top) < 5;
        if(!isSideBySide && !themeAwesome) {
            focusColumn.css({ 'position': 'relative', 'top': '0px', 'width': 'auto' });
            return;
        }

        var topbarHeight = ($('.topbar').css('position') === 'fixed') ? $('.topbar').outerHeight() + CONTENT_TOP_MARGIN : CONTENT_TOP_MARGIN;
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();
        var adsWidth = focusColumn.outerWidth();
        
        var parentTop = adsColumn.offset().top;
        var sidebarHeight = focusColumn.outerHeight();
        var newsHeight = newsColumn.innerHeight();

        // Only apply if the feed column is taller than the sidebar
        if (sidebarHeight < newsHeight) {
            // Calculate when the bottom of the sidebar aligns with the bottom of the viewport window
            var triggerFixedScroll = parentTop - topbarHeight;
            var bottomFixedScroll = triggerFixedScroll + (sidebarHeight - windowHeight + topbarHeight + FLOATING_BOTTOM_MARGIN);

            if (scrollTop >= triggerFixedScroll) {
                if (sidebarHeight > windowHeight - topbarHeight) {
                    // Tall sidebar: scrolls naturally first, then pins its bottom to the bottom of the screen while reading the rest
                    if (scrollTop >= bottomFixedScroll) {
                        var maxBottomTop = windowHeight - sidebarHeight - FLOATING_BOTTOM_MARGIN;
                        focusColumn.css({
                            "position": "fixed",
                            "top": maxBottomTop + "px",
                            "bottom": "auto",
                            "width": adsWidth
                        });
                    } else {
                        // Scrolling through the tall sidebar content
                        var currentNaturalTop = parentTop - scrollTop;
                        focusColumn.css({
                            "position": "fixed",
                            "top": currentNaturalTop + "px",
                            "bottom": "auto",
                            "width": adsWidth
                        });
                    }
                } else {
                    // Short sidebar: stays fixed nicely from the top
                    focusColumn.css({
                        "position": "fixed",
                        "top": topbarHeight + "px",
                        "bottom": "auto",
                        "width": adsWidth
                    });
                }
            } else {
                // At the very top of the page
                focusColumn.css({
                    "position": "relative",
                    "top": "0px",
                    "width": "auto"
                });
            }
        } else {
            focusColumn.css({
                "position": "relative",
                "top": "0px",
                "width": "auto"
            });
        }
    }

    // Attach listeners
    $(window).on('load resize scroll', handleSidebarScroll);

    // Re-run safely on AJAX completion (ignoring chat polls)
    $(document).ajaxComplete(function(event, xhr, settings) {
        if (settings && settings.url && settings.url.indexOf('chat') > -1) {
            return;
        }
        handleSidebarScroll();
    });
});
//theme sidebar dynamic items
document.addEventListener("DOMContentLoaded", function() {
    function syncSidebarWidth() {
        const col = document.querySelector('.newsfeed-col-left');
        const sidebar = document.querySelector('.fbui-sidebar-wrapper');
        if (col && sidebar) {
            sidebar.style.width = col.getBoundingClientRect().width + 'px';
        }
    }

    syncSidebarWidth();
    window.addEventListener('resize', syncSidebarWidth);

    // 1. Independent Toggle for Main Links
    const linksBtn = document.getElementById('fbui-links-see-more-btn');
    const linksWrapper = document.getElementById('fbui-links-collapse-wrapper');
    const linksText = document.getElementById('links-see-more-text');
    const linksIcon = document.getElementById('links-see-more-icon');

    if (linksBtn && linksWrapper) {
        linksBtn.onclick = function(e) {
            e.preventDefault();
            const isExpanded = linksWrapper.classList.toggle('expanded');
            if (isExpanded) {
                linksText.innerText = Ossn.Print('fbui:see_less');
                linksIcon.className = 'fa fa-chevron-up me-0';
            } else {
                linksText.innerText = Ossn.Print('fbui:see_more');
                linksIcon.className = 'fa fa-chevron-down me-0';
            }
        };
    }

    // Dynamic Screen-Height Calculation subtracting exactly 2 shortcuts height at the bottom
function autoExpandLinksToFitScreen() {
        if (!linksWrapper) return;

        const screenHeight = window.innerHeight;
        
        // Adjusted base buffer slightly up (~425px) so it stops right above the taskbar edge
        let occupiedHeight = 425; 

        const shortcutsItems = document.querySelectorAll('.fbui-shortcut-item');
        if (shortcutsItems.length > 0) {
            let shortcutsReservedHeight = 60 + (Math.min(shortcutsItems.length, 2) * 52);
            
            if (shortcutsItems.length > 2) {
                shortcutsReservedHeight += 45; 
            }
            occupiedHeight += shortcutsReservedHeight;
        }

        const availableHeightForHidden = screenHeight - occupiedHeight;
        const itemHeight = 48; 
        const extraItemsThatCanFit = Math.floor(availableHeightForHidden / itemHeight);

        if (extraItemsThatCanFit > 0) {
            const collapsibleItems = Array.from(linksWrapper.children);
            const itemsToReveal = collapsibleItems.slice(0, Math.max(0, extraItemsThatCanFit));
            
            const mainList = document.getElementById('fbui-sidebar-main-list');
            
            itemsToReveal.forEach(item => {
                mainList.insertBefore(item, linksWrapper);
            });

            if (linksWrapper.children.length === 0) {
                if (linksBtn) linksBtn.style.display = 'none';
            }
        }
    }

    autoExpandLinksToFitScreen();

    // 2. Independent Toggle for Shortcuts (> 2 items)
    const shortcutsBtn = document.getElementById('fbui-shortcuts-see-more-btn');
    const shortcutsWrapper = document.getElementById('fbui-shortcuts-collapse-wrapper');
    const shortcutsText = document.getElementById('shortcuts-see-more-text');
    const shortcutsIcon = document.getElementById('shortcuts-see-more-icon');

    if (shortcutsBtn && shortcutsWrapper) {
        shortcutsBtn.onclick = function(e) {
            e.preventDefault();
            const isExpanded = shortcutsWrapper.classList.toggle('expanded');
            if (isExpanded) {
                shortcutsText.innerText = Ossn.Print('fbui:see_less');
                shortcutsIcon.className = 'fa fa-chevron-up me-0';
            } else {
                shortcutsText.innerText = Ossn.Print('fbui:see_more');
                shortcutsIcon.className = 'fa fa-chevron-down me-0';
            }
        };
    }

    // Handle Shortcut Deletion via OSSN.PostRequest
    document.querySelectorAll('.fbui-shortcut-delete').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const type = this.getAttribute('data-type');
            const guid = this.getAttribute('data-guid');
            const itemRow = this.closest('.fbui-shortcut-item');

            Ossn.PostRequest({
                url: Ossn.site_url + 'action/fbui/shortcut/delete',
                params: "&type=" + type + "&guid=" + guid,
                callback: function(callback) {
                    if (itemRow) {
                        itemRow.style.opacity = '0';
                        setTimeout(function() {
                            itemRow.remove();
                        }, 200);
                    }
                }
            });
        });
    });
});