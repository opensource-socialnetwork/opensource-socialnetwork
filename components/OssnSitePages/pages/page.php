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
if (!isset($params['title'])) {
    $params['title'] = '';
}
if (!isset($params['contents'])) {
    $params['contents'] = '';
}
?>
<div class="row ossn-site-pages">
    <div class="col-md-12 ossn-site-pages-inner  ossn-page-contents">
        <div class="ossn-site-pages-title">
            <?php echo $params['title']; ?>
        </div>
        <div class="ossn-site-pages-body">
            <?php echo $params['contents']; ?>
        </div>
    </div>
</div>
