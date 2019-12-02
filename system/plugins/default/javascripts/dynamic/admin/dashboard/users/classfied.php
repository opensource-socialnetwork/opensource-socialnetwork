<script>
		/**
		 * Get data for last two years
		 * Translation for gender in dashboard users & users online #511		 
		 */
		var gdata = [
<?php
			$genders = array_combine($params['genders'], $params['total']);
			foreach($genders as $gender => $total) {
					echo	"{\n";
					echo	"value: $total,\n";
					echo	"color: '" . ossn_print($gender . ':gendercolor') . "',\n";
					echo	"highlight: '" . ossn_print($gender . ':gendercolor') . "',\n";
					echo	"label: '" . ucfirst(ossn_print($gender)) . "'\n";
					echo	"},\n";
			}
?>
			];
			$(window).on('load', function(){
				var chartjs = $('#users-classified-graph')[0].getContext("2d");
				this.myPie = new Chart(chartjs).Pie(gdata);
			    //don't you want lagends ? $arsalanshah
				//comment line below if you want to hide legends
				chart_js_legend($('#userclassified-lineLegend')[0],gdata);				
			});
	</script>
