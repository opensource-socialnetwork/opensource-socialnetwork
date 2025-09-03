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
if (!isset($params['title'])) {
    $params['title'] = '';
}
if (!isset($params['contents'])) {
    $params['contents'] = '';
}
?>
<div class="col-lg-11">
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
