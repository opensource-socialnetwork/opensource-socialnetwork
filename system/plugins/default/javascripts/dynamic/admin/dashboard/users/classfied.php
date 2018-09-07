<?php
	$male = (empty($params['total'][0])) ? '0' : $params['total'][0];
	$female = (empty($params['total'][1])) ? '0' : $params['total'][1];
?>
<script>
		/**
		 * Get data for last two years
		 * Translation for gender in dashboard users & users online #511		 
		 */
		var gdata = [
				{
					value: <?php echo $params['total'][0]; ?>,
					color:"#01ADEF",
					highlight: "#01ADEF",
					label: "<?php echo ossn_print('male'); ?>"
				},
				{
					value: <?php echo $female; ?>,
					color: "#ED008C",
					highlight: "#ED008C",
					label: "<?php echo ossn_print('female'); ?>"
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