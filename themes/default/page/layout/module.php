<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
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
        <a class="title" href="#"><?php echo $params['title']; ?></a>

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
