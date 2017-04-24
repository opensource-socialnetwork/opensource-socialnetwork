<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if(!empty($params['menu'])){ 
	foreach($params['menu'] as $item){
		$name = OssnTranslit::urlize($item[0]['name']);
?><li class="<?php echo $item[0]['class'];?> ossn-wall-container-control-menu-<?php echo $name;?>"><?php echo $item[0]['text'];?></li>  
<?php
	}
}