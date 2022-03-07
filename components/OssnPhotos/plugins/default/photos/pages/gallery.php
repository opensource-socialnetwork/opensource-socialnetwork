<div class="hidden">
	<?php
	if ($params['photos']) {
    	foreach ($params['photos'] as $photo) {	
		$img = $photo->getURL();
	?>
	<a data-fancybox="gallery" class="ossn-gallery" href="<?php echo ossn_site_url("album/getphoto/") . $photo->guid; ?>/<?php echo $img; ?>?size=view"></a>
    <?php
		}
	}
	?>
</div>
