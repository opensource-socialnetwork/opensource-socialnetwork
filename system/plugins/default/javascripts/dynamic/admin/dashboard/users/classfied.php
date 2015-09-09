<?php
	$male = (empty($params['total'][0])) ? '0' : $params['total'][0];
	$female = (empty($params['total'][1])) ? '0' : $params['total'][1];
?>
<script>
		/**
		 * Get data for last two years
		 */
		var gdata = [
				{
					value: <?php echo $params['total'][0]; ?>,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Male"
				},
				{
					value: <?php echo $female; ?>,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Female"
				},
			];
			$(window).on('load', function(){
				var chartjs = $('#users-classified-graph')[0].getContext("2d");
				this.myPie = new Chart(chartjs).Pie(gdata);
			    //don't you want lagends ? $arsalanshah
				//comment line below if you want to hide legends
				chart_js_legend($('#userclassified-lineLegend')[0],gdata);				
			});
	</script>