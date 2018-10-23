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
?>
<table class="ossn-container">
    <tr>
        <td class="image-block" style="text-align: center;width:100%;">
            <?php echo $params['media']; ?>
        </td>
        <td class="info-block">
            <div class="close-viewer" onclick="Ossn.ViewerClose();">X</div>
            <?php echo $params['sidebar']; ?>
        </td>
    </tr>
</table>
