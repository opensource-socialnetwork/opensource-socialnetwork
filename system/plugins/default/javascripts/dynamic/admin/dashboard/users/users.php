<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
	$user = new OssnUser;
	//get users
	$by_year = $user->countByYearMonth();
	if(!$by_year){
		return;
	}
	//sort out data
	foreach($by_year as $item){
		$years[] = $item->year;
		if((int)$item->month !== 10){
			$item->month = str_replace(0, '', $item->month);
		}
		$data[$item->year][$item->month] = $item->total;
	}	
	//get unqiue years
	$years = array_unique($years);
	$years = array_reverse($years);

	for($i=1; $i <=12; $i++){
		foreach($years as $year){
			if(!isset($data[$year][$i])){
				$datas[$year][] = 0;
			} else {
				$datas[$year][] = $data[$year][$i];
			}
		}
		$lables[] = date("F", mktime(0, 0, 0, $i, 10));
	}
?>
<script>
		/**
		 * Get data for last two years
		 */
		var lineChartData = {
			labels : <?php echo json_encode($lables);?>,
			datasets : [
				<?php if(isset($years[0])){ ?>
					{
					label: "<?php echo $years[0];?>",
					fillColor : "rgba(151,187,205,0.2)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",					
					data : <?php echo json_encode($datas[$years[0]]);?>
				}	
				<?php } ?>
				<?php if(isset($years[1])){ ?>
				, {
					label: "<?php echo $years[1];?>",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : <?php echo json_encode($datas[$years[1]]);?>
				}	
				<?php } ?>
			]
		}
		/**
		 * Generate a graph on page load
		 */		
		$(document).ready(function(){
			var ctx = document.getElementById("users-count-graph").getContext("2d");
			var myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true,
				maintainAspectRatio: false,
			});
			//don't you want lagends ? $arsalanshah
			//comment line below if you want to hide legends
			chart_js_legend(document.getElementById("usercount-lineLegend"),lineChartData);

		});
	</script>