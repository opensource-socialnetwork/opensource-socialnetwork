<div class="ossn-ad-item">
<div class="row">
	<a target="_blank" href="<?php echo $params['item']->site_url;?>">
		<div class="col-md-12">
			<div class="ad-title"><?php echo $params['item']->title;?></div>
			<div class="ad-link"><?php echo $params['item']->site_url;?></div>
			<img class="ad-image" src="<?php echo ossn_ads_image_url($params['item']->guid); ?>" />
			<p><?php echo $params['item']->description;?></p>
		</div>
	</a>
</div>
</div>
