<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if (!isset($params['title'])) {
    $params['title'] = '';
}
if (!isset($params['contents'])) {
    $params['contents'] = '';
}
?>
<div class="col-md-11">
	<div class="ossn-site-pages">
		<div class="ossn-site-pages-inner  ossn-page-contents">
			<div class="ossn-site-pages-title">
				<?php echo $params['title']; ?>
			</div>
			<div class="ossn-site-pages-body">
				<?php echo $params['contents']; ?>
			</div>
		</div>
	</div>
</div>
