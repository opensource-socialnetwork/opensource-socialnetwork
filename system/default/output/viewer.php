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
