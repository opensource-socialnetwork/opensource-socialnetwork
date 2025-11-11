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
$langcodes = ossn_standard_language_codes();
$langs[''] = '';
foreach($langcodes as $code){
	$langs[$code] =	ossn_print($code);
}
$lang = '';
$fall = ossn_site_pages_fallback_language();
if($fall){
	$lang = $fall;	
}
?>
<div>
	<div class="alert alert-warning"><?php echo ossn_print('sitepages:defaultlang');?></div>
    <?php 
		echo ossn_plugin_view('input/dropdown', array(
			'name' => 'language',
			'options' => $langs,
			'value' => $lang,
		)); 
	?>
<div>
<div class="margin-top-10">
	<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save'); ?>"/>
</div>
