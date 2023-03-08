<div class="ossn-ad-item">
	<div class="row">
		<a target="_blank" href="<?php echo $params['item']->site_url;?>">
			<div class="col-md-12">
				<div class="ad-title"><?php echo $params['item']->title;?></div>
				<div class="ad-image-container">
					<img class="ad-image" src="<?php echo $params['item']->getPhotoURL() ?>" />
				</div>
				<p><?php echo $params['item']->description;?></p>
			</div>
		</a>
	</div>
</div>
