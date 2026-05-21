//<script>
/**
  Usage
  ossn_location({
		container: '#geocoder', //div container name
		input: '#abc', //input id within the container
		placeholder: 'Some Text',
  });
**/
function ossn_location($obj) {
	$(document).ready(function() {
		if ($($obj.container).length && $($obj.input).length) {
			
			const $inputField = $($obj.input);
			const $container = $($obj.container);
			
			// Transform container layout structure
			$container.addClass('ossn-location-container');
			
			// Inject FontAwesome icon inside the wrapper if it doesn't already exist
			if (!$container.find('.ossn-location-icon').length) {
				$container.prepend('<i class="fas fa-map-marker-alt ossn-location-icon"></i>');
			}
			
			// Inject our custom clean autocompletion dropdown menu card
			if (!$container.find('.ossn-location-dropdown').length) {
				$container.append('<ul class="ossn-location-dropdown"></ul>');
			}
			const $dropdown = $container.find('.ossn-location-dropdown');
			
			let typingTimer;
			const doneTypingInterval = 350; // Wait 350ms after user pauses typing before hitting OSM

			$inputField.on('keyup input', function() {
				clearTimeout(typingTimer);
				const query = $(this).val().trim();
				
				if (query.length >= 3) {
					typingTimer = setTimeout(function() {
						fetchLocationSuggestions(query);
					}, doneTypingInterval);
				} else {
					$dropdown.empty().hide();
				}
			});

			// Fetch coordinates directly from OpenStreetMap's free engine
			function fetchLocationSuggestions(searchQuery) {
				const requestUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(searchQuery)}&format=json&addressdetails=1&limit=5&accept-language=${Ossn.Config.lang || 'en'}&email=admin@${window.location.hostname}`;
				
				$.getJSON(requestUrl, function(data) {
					$dropdown.empty();
					
					if (data && data.length > 0) {
						$.each(data, function(index, item) {
							$dropdown.append(`<li class="ossn-location-item" data-name="${item.display_name}">${item.display_name}</li>`);
						});
						$dropdown.show();
					} else {
						$dropdown.hide();
					}
				}).fail(function() {
					console.error("OSM Nominatim API endpoint could not be reached.");
				});
			}

			// Event: Action mapping when suggestion item is selected
			$container.on('click', '.ossn-location-item', function(e) {
				e.preventDefault();
				const selectedName = $(this).attr('data-name');
				
				$inputField.val(selectedName).trigger('change'); 
				$dropdown.empty().hide();
			});

			// Close selection pane if focus shifts anywhere else on screen
			$(document).on('click', function(event) {
				if (!$(event.target).closest($container).length) {
					$dropdown.hide();
				}
			});
		}
	});
}