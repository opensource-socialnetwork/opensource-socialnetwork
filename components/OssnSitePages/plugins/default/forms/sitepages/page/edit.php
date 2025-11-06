<?php
$pages = array(
		''        => '',
);
foreach(ossn_site_pages_valid_pages_prefixes() as $prefix){
	$locale = str_replace('-', ':', $prefix);
	$locale = 'site:'.$locale;
	$pages[$prefix] = ossn_print($locale);	
}
$page = input('page');
if(!empty($page) && !in_array($page, ossn_site_pages_valid_pages_prefixes())) {
		$page = '';
}
$lang = input('language');

$langcodes = ossn_standard_language_codes();
$langs[]   = '';
foreach ($langcodes as $code) {
		$langs[$code] = ossn_print($code);
}

?>
<div>
	<label><?php echo ossn_print('sitepages:page');?></label>
    <?php 
		echo ossn_plugin_view('input/dropdown', array(
			'name' => 'page',
			'options' => $pages,
			'value' => $page,
			'id' => 'sitepages-page',
		)); 
	?>
</div>
<?php  if(!empty($page)){ ?>
<div>
	<label><?php echo ossn_print('language');?></label>
    <?php 
		echo ossn_plugin_view('input/dropdown', array(
			'name' => 'language',
			'options' => $langs,
			'value' => $lang,
			'id' => 'sitepages-language',
		)); 
	?>
</div>
<?php } ?>
<?php
	if(!empty($page) && !empty($lang)){ 
		$sitepage = new OssnSitePages();
		$sitepage = $sitepage->getPrefix($page, $lang);
		
		$text = "";
		if($sitepage && isset($sitepage->description)){
			$text = html_entity_decode($sitepage->description);
		}	
		?>
		<textarea id="sitepage-textarea" name="description"><?php echo $text; ?></textarea>
        <input type="submit" class="mt-2 btn btn-success btn-sm" value="<?php echo ossn_print('save'); ?>"/>
	<?php 
	}
?>
<div id="sitepage-loading" class="ossn-loading d-none"></div>
<script>
	$(document).ready(function(){
			$('body').on('change', '#sitepages-page', function(){
					var val = $(this).val();
					$('#sitepage-loading').removeClass('d-none');
					window.location = Ossn.site_url + 'administrator/component/OssnSitePages?page='+val;	
			});	
			$('body').on('change', '#sitepages-language', function(){
					var val = $(this).val();
					$('#sitepage-loading').removeClass('d-none');
					$('#sitepage-textarea').fadeOut();
					window.location = Ossn.site_url + 'administrator/component/OssnSitePages?page=<?php echo $page;?>&language='+val;	
			});									   
	});
</script>