<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<strong><?php echo $params['entity']->title;?></strong>
<a href="<?php echo $params['entity']->site_url;?>">
	<p class="text-black"><?php echo $params['entity']->description;?></p>
	<div class="ossn-ad-image" style="background:url('<?php echo $params['entity']->getPhotoURL();?>') no-repeat;background-size: contain;"></div>
</a>
