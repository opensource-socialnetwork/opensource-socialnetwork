<script>
		/**
		 * Get data for last two years
		 * Translation for gender in dashboard users & users online #511
		 */
		var OnlineUsersPieData = [
<?php
			$genders = array_combine($params['genders'], $params['total']);
			foreach($genders as $gender => $total) {
				if($total > 0) {
					echo	"{\n";
					echo	"value: $total,\n";
					echo	"color: '" . ossn_print($gender . ':gendercolor') . "',\n";
					echo	"highlight: '" . ossn_print($gender . ':gendercolor') . "',\n";
					echo    "label: '" . ucfirst(ossn_print($gender)) . "'\n";
					echo	"},\n";
				}
			}
?>
			];
			$(window).on('load', function(){
				var online_users_graph = $('#onlineusers-classified-graph')[0].getContext("2d");
				this.OnlinemyPie = new Chart(online_users_graph).Pie(OnlineUsersPieData);
			    //don't you want lagends ? $arsalanshah
				//comment line below if you want to hide legends
				chart_js_legend($('#onlineuserclassified-lineLegend')[0], OnlineUsersPieData);				
			});			
	</script>
