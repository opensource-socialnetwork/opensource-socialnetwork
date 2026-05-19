//<script>
Ossn.register_callback('ossn', 'init', 'ossn_ads_init');
function ossn_ads_init() {
	(function ($) {
		var trackerViewedAds = [];
		try {
			var storedAds = sessionStorage.getItem('ossn_tracked_ad_views');
			if (storedAds) {
				trackerViewedAds = JSON.parse(storedAds);
			}
		} catch (e) {
			// Fallback if browser security controls block storage access
			trackerViewedAds = [];
		}

		var observerOptions = {
			root: null,
			rootMargin: '0px',
			threshold: 0.3
		};

		// This will make sure if user sees ads on same page many times (like injected) it send request at once
		var adObserver = new IntersectionObserver(function (entries, observer) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					var $adElement = $(entry.target);
					var adGuid = $adElement.data('guid');

					if (adGuid) {
						// Force clean data comparison rules (cast type value to string)
						var guidStr = adGuid.toString();

						// If it hasn't been tracked yet in this tab session, fire the request
						if (trackerViewedAds.indexOf(guidStr) === -1) {

							// Push into memory array instantly
							trackerViewedAds.push(guidStr);

							// Commit updated array string to browser storage to survive page reloads
							try {
								sessionStorage.setItem('ossn_tracked_ad_views', JSON.stringify(trackerViewedAds));
							} catch (e) {}

							// Send the XHR request to the server
							Ossn.PostRequest({
								url: Ossn.site_url + 'action/ad/viewinc?guid='+adGuid,
								callback: function(){},
							});
						}

						// Unobserve this specific container element node instance right away
						observer.unobserve(entry.target);
					}
				}
			});
		}, observerOptions);

		Ossn.watchNewAds = function () {
			$('.ossn-ad-item').each(function () {
				adObserver.observe(this);
			});
		};

		$(document).ready(function () {
			Ossn.watchNewAds();
		});

	})(jQuery);
}