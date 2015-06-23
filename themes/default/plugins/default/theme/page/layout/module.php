<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$params['controls'] = (isset($params['controls'])) ? $params['controls'] : '';
if (isset($params['module_width'])) {
    $style = 'style="width:' . $params["module_width"] . '"';
} else {
    $style = '';
}
?><br/>
<br/>
<div class="ossn-layout-module" <?php echo $style; ?>>
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

<br/>
<br/>
<br/>
<br/>
