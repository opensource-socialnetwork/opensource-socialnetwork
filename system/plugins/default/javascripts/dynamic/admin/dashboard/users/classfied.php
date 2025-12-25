<script>
/**
 * Get data for last two years
 * Translation for gender in dashboard users & users online #511		 
 */
<?php
$genders = implode(',', $params['genders']); 
?>
$(window).on('load', function () {
	Ossn.PostRequest({
		'url': Ossn.site_url + 'administrator/xhr/count_by_gender',
		'params': 'gender=<?php echo $genders;?>',
		'callback': function (result) {

			const genders = Object.keys(result.total); // ['male', 'female', 'other']
			const totals = Object.values(result.total); // [26, 0, 0]
			const totalSum = totals.reduce((accumulator, currentValue) => accumulator + currentValue, 0);
			
			// Initialize arrays to store the final data
			let types = [];
			let typesTotal = [];
			let colors = [];

			// Iterate over the genders and map the values
			genders.forEach((gender, index) => {
				// Capitalize the gender (similar to PHP's ucfirst function)
				const genderCapitalized = gender.charAt(0).toUpperCase() + gender.slice(1);

				types.push(genderCapitalized);
				colors.push(Ossn.Print(gender + ':gendercolor'));
				typesTotal.push(totals[index]);
			});

			var chartjs = $('#users-classified-graph')[0].getContext("2d");
			$('#users-classified-graph-total').text(totalSum);
			
			this.myPie = new Chart(chartjs, {
				type: 'pie',
				options: {
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: {
							display: true,
							labels: {
								usePointStyle: true,
								boxWidth: 10
							}
						}
					},
				},
				data: {
					labels: types,
					datasets: [{
						data: typesTotal,
						backgroundColor: colors,
					}]
				},
			});
			
			$('.users-classified-graph-loader').remove();
			$('#users-classified-graph').removeClass('d-none');
		},
	});
});
</script>
