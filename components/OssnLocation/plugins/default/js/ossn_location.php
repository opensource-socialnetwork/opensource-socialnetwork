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
		if (Ossn.LocationAPIKey && Ossn.LocationAPIKey != '') {
			if ($($obj.container).length && $($obj.input).length) {
				if (!Ossn.isset($obj.placeholder)) {
					$obj.placeholder = Ossn.Print('enter:location');
				}
				//hide input field 
				if (!Ossn.isset($obj.hide_input)) {
					$obj.hide_input = true;
				}
				if ($obj.hide_input === true) {
					$($obj.input).hide();
				}
				mapboxgl.accessToken = Ossn.LocationAPIKey;
				const geocoder = new MapboxGeocoder({
					accessToken: mapboxgl.accessToken,
					language: Ossn.Config.lang,
					types: 'country,region,place,postcode,locality,neighborhood',
					placeholder: $obj.placeholder,
				});

				geocoder.addTo($obj.container);
				const results = $($obj.input);

				//insert data into input
				geocoder.on('result', (e) => {
					results.val(e.result.place_name);
				});

				// Clear results container when search is cleared.
				geocoder.on('clear', () => {
					results.val("");
				});
			}
		}
	});
}