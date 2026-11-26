<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$items = input('items');
$price = input('price');
$date  = input('expnesedate');

$datee  = explode('/', $date);
$day    = $datee[0];
$month  = $datee[1];
$year   = $datee[2];

if(empty($items)){
	ossn_trigger_message(ossn_print('em:itemsadderror'), 'error');
	redirect(REF);	
}
foreach($items as $item){
		if(empty($item)){
			ossn_trigger_message(ossn_print('em:itemsadderror'), 'error');
			redirect(REF);					 
		}
}
if(empty($date) || empty($items) || empty($price) || empty($day) || empty($month) || empty($year)){
		ossn_trigger_message(ossn_print('em:itemsadderror'), 'error');
		redirect(REF);
}
foreach($items as $key => $i){
	$lists[] = array(
			 'name' => $i,
			 'price' => $price[$key],
	);
}
if($items){
		$em = new OssnExpenses();
		foreach($lists as $item){
				$em->addItem($day, $month, $year, $item['name'], $item['price']);	
		}
		ossn_trigger_message(ossn_print('em:itemsadded'));
		redirect(REF);
}
ossn_trigger_message(ossn_print('em:itemsadderror'), 'error');
redirect(REF);