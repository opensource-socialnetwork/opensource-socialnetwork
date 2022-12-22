<script>

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
	var online_users_graph = $('#onlineusers-classified-graph')[0].getContext("2d");

	this.OnlinemyPie = new Chart(online_users_graph, {
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
