<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$params['controls'] = (isset($params['controls'])) ? $params['controls'] : '';

?>
	<div class="col-md-11">
		<div class="ossn-layout-module">
			<div class="module-title">
				<div class="title"><?php echo $params['title']; ?></div>
				<div class="controls">
					<?php echo $params['controls']; ?>
				</div>
			</div>
			<div class="module-contents">
				<?php echo $params['content']; ?>
			</div>
		</div>
	</div>