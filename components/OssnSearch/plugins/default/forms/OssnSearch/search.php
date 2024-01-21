<?php
$q = input('q');
if(!$q || empty($q)){
	$q = "";	
}
//[E] Show current search query inside search box on search page #2328
?>
<input type="text" name="q" placeholder="<?php echo ossn_print('ossn:search');?>" value="<?php echo $q;?>"/>
