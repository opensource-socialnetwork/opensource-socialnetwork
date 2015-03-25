<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$pages = range(1, $params['total']);

//unset non-required vars
unset($_GET['h']);
unset($_GET['p']);
unset($_GET['offset']);
if (count($_GET)) {
    $args_url = '';
    foreach ($_GET as $key => $value) {
        if ($key != 'page') {
            $args_url .= '&' . $key . '=' . $value;
        }
    }
}

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
	
	echo '<div class="ossn-pagination">';
  	//disaply first if first page is exist
	if(isset($first) && !empty($first)){
        $url = "?offset={$first}{$args_url}";
     	echo "<a href='{$url}' class='ossn-pagination-page'><li>".ossn_print('ossn:pagination:first')."</li></a>";	
	} 
   foreach ($pages as $page) {
        if ($page == $params['offset']) {
            $selected = 'class="selected"';
            $url = "?offset={$page}{$args_url}";
            echo "<a href='{$url}' class='ossn-pagination-page'><li {$selected}>{$page}</li></a>";
        } else {
            $url = "?offset={$page}{$args_url}";
            echo "<a href='{$url}' class='ossn-pagination-page'><li>{$page}</li></a>";
        }
    }
	//disply last page if it exist
	if(isset($last) && !empty($last)){
        $url = "?offset={$last}{$args_url}";
     	echo "<a href='{$url}' class='ossn-pagination-page'><li>".ossn_print('ossn:pagination:last')."</li></a>";	
	}
echo '</div>';
}
