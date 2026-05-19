<div class="ossn-ad-item" data-guid="<?php echo $params['item']->guid;?>">
	<div class="row">
		<a target="_blank" href="<?php echo $params['item']->goURL();?>">
			<div class="col-lg-12">
				<div class="ad-title"><?php echo $params['item']->title;?></div>
				<div class="ad-image-container">
					<img class="ad-image" src="<?php echo $params['item']->getPhotoURL() ?>" />
				</div>
				<p><?php echo $params['item']->description;?></p>
			</div>
		</a>
	</div>
</div>