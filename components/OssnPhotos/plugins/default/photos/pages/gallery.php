<div class="hidden">
	<?php
	if ($params['photos']) {
    	foreach ($params['photos'] as $photo) {	
		$img = $photo->getURL('view');
	?>
	<a data-fancybox="gallery" class="ossn-gallery" href="<?php echo $img; ?>"></a>
    <?php
		}
	}
	?>
</div>
