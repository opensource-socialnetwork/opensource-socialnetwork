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
