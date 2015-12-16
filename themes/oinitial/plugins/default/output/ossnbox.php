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
if (!isset($params['button'])) {
    $params['button'] = ossn_print('save');
}
if (!isset($params['control'])) {
    $params['control'] = '';
}
if (!isset($params['callback'])) {
    $params['callback'] = '';
}
?>
    <div class="title">
        <?php echo $params['title']; ?>
        <div class="close-box" onclick="Ossn.MessageBoxClose();">X</div>
    </div>
    <div class="contents">
        <div style="width:446px;">
            <div style="width:100%;margin:auto;">
                <?php echo $params['contents']; ?>
            </div>
        </div>
    </div>
<?php if ($params['control'] !== false) { ?>
    <div class="control">
        <div class="controls">
            <?php if ($params['callback'] !== false) { ?>
                <a href="javascript:void(0);" onclick="Ossn.Clk('<?php echo $params['callback']; ?>');"
                   class='button-blue-light'><?php echo $params['button']; ?></a>
            <?php } ?>
            <a href="javascript:void(0);" onclick="Ossn.MessageBoxClose();" class='button-grey-light'><?php echo ossn_print('cancel'); ?></a>
        </div>
    </div>

<?php } ?>
