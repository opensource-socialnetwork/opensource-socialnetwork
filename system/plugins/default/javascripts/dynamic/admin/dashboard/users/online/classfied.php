<script>
		/**
		 * Get data for last two years
		 * Translation for gender in dashboard users & users online #511
		 */
		var OnlineUsersPieData = [
				{
					value: <?php echo $params['total'][0]; ?>,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "<?php echo ossn_print('male'); ?>"
				},
				{
					value: <?php echo $params['total'][1]; ?>,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "<?php echo ossn_print('female'); ?>"
				},
			];
			$(window).on('load', function(){
				var online_users_graph = $('#onlineusers-classified-graph')[0].getContext("2d");
				this.OnlinemyPie = new Chart(online_users_graph).Pie(OnlineUsersPieData);
			    //don't you want lagends ? $arsalanshah
				//comment line below if you want to hide legends
				chart_js_legend($('#onlineuserclassified-lineLegend')[0], OnlineUsersPieData);				
			});			
	</script>