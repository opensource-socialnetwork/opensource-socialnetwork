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
	if ($($obj.container).length && $($obj.input).length) {
		if(!Ossn.isset($obj.placeholder)){
				$obj.placeholder = Ossn.Print('enter:location');
		}
		//hide input field 
		$($obj.input).hide();
		mapboxgl.accessToken = '<?php echo ossn_location_api_key(); ?>';
		const geocoder = new MapboxGeocoder({
			accessToken: mapboxgl.accessToken,
			language: '<?php echo ossn_site_settings("language"); ?>',
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