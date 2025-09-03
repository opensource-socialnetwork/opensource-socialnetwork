<script>
		/**
		 * Get data for last two years
		 * Translation for gender in dashboard users & users online #511		 
		 */
<?php
			$genders = array_combine($params['genders'], $params['total']);
			$types   = array();
			$types_total = array();
			$colors = array();
			foreach($genders as $gender => $total) {
				 	$types[] = ucfirst(ossn_print($gender));
					$colors[] = ossn_print($gender . ':gendercolor');
					$types_total[] = $total;
			}
?>
$(window).on('load', function() {
	var chartjs = $('#users-classified-graph')[0].getContext("2d");
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
			labels: <?php echo json_encode($types); ?> ,
			datasets : [{
				data: <?php echo json_encode($types_total); ?> ,
				backgroundColor : <?php echo json_encode($colors); ?> ,
			}]
		},
	});
});
	</script>
