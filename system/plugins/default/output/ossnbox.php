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
        <div class="ossn-box-inner">
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
                   class='btn btn-primary btn-sm'><?php echo $params['button']; ?></a>
            <?php } ?>
            <a href="javascript:void(0);" onclick="Ossn.MessageBoxClose();" class='btn btn-default btn-sm'><?php echo ossn_print('cancel'); ?></a>
        </div>
    </div>

<?php } ?>
