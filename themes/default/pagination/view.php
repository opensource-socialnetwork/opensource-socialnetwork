<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$pages = range(1, $params['total']);

//unset non-required vars
unset($_GET['h']);
unset($_GET['p']);
unset($_GET['offset']);

$args_url = OssnPagination::constructUrlArgs();

//if there is only one page don't show pagination
if (count($pages) !== 1) {
	
	$spilt = array_chunk($pages, 4);
	$spilt = arraySerialize($spilt);

	foreach($spilt as $page){
		$serialized_pages[] = arraySerialize($page);
	}	
	$serialized_pages = arraySerialize($serialized_pages);
	
	//get key by offset
	$key = ossn_recursive_array_search($params['offset'], $serialized_pages);
	$new_total = count($serialized_pages);
	
	//get last page
	$last = array_reverse($serialized_pages[$new_total]);
	$last = $last[0];
	
	//get first page
	$first = $serialized_pages[1][1];
	
	if(isset($serialized_pages[$key])){
		if(isset($serialized_pages[$key + 1]) && isset($serialized_pages[$key - 1])){
			$pages = array_merge($serialized_pages[$key - 1], $serialized_pages[$key], $serialized_pages[$key + 1]);
		}
		if(!isset($serialized_pages[$key + 1]) && $key > 1){
			$pages = array_merge($serialized_pages[$key - 1], $serialized_pages[$key]);			
		}
		if($key == 1 && $new_total > 1){
			$pages = array_merge($serialized_pages[$key], $serialized_pages[$key + 1]);			
		}
		if(!isset($pages) && !empty($key)){
			$pages = $serialized_pages[$key];
		}
	}
	
	echo '<ul class="pagination ossn-pagination">';
  	//disaply first if first page is exist
	if(isset($first) && !empty($first)){
        $url = "?offset={$first}{$args_url}";
     	echo "<li><a href='{$url}' class='ossn-pagination-page'>".ossn_print('ossn:pagination:first')."</a></li>";	
	} 
   foreach ($pages as $page) {
        if ($page == $params['offset']) {
            $selected = 'class="active"';
            $url = "?offset={$page}{$args_url}";
            echo "<li {$selected}><a href='{$url}'>{$page}</a></li>";
        } else {
            $url = "?offset={$page}{$args_url}";
            echo "<li><a href='{$url}'>{$page}</a></li>";
        }
    }
	//disply last page if it exist
	if(isset($last) && !empty($last)){
        $url = "?offset={$last}{$args_url}";
     	echo "<li><a href='{$url}'>".ossn_print('ossn:pagination:last')."</a></li>";	
	}
echo '</ul>';
}
