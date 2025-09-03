<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
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
var lineChartData = {
	labels: <?php echo json_encode($lables); ?> ,
	datasets : [ <?php
		if (isset($years[0])) {
			?>
			{
				label: "<?php echo $years[0];?>",
				fill: true,
				backgroundColor: 'rgb(94,156,220,0.1)',
				borderColor: 'rgba(151,187,205,1)',
				data: <?php echo json_encode($datas[$years[0]]); ?>
			} <?php
		} ?>
		<?php
		if (isset($years[1])) {
			?>
			, {
				label: "<?php echo $years[1];?>",
				fill: true,
				backgroundColor: 'rgba(220,220,220,0.2)',
				borderColor: 'rgba(220,220,220,1)',
				data: <?php echo json_encode($datas[$years[1]]); ?>
			} <?php
		} ?>
	]
}
/**
 * Generate a graph on page load
 */
$(document).ready(function() {
	var ctx = document.getElementById("users-count-graph").getContext("2d");
	var myLine = new Chart(ctx, {
		type: 'line',
		data: lineChartData,
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: true,
					labels: {
						usePointStyle: true,
						boxWidth: 10,
					}
				}
			},
			scale: {
				ticks: {
					precision: 0
				}
			}
		},
	});
});
	</script>