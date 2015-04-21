<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.Open Source Social Network.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */

$ads = new OssnAds;
$pagination = new OssnPagination;
$pagination->setItem($ads->getAds());
?>
<div class="top-controls">
    <a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=add"); ?>"
       class="ossn-admin-button button-green"><?php echo ossn_print('add'); ?></a>
       <input type="submit" class="ossn-admin-button button-red" value="<?php echo ossn_print('delete'); ?>"/>
</div>
<table class="table">
    <tbody>
    <tr class="table-titles">
        <td></td>
        <td><?php echo ossn_print('ad:title'); ?></td>
        <td><?php echo ossn_print('ad:site:url'); ?></td>
        <td><?php echo ossn_print('ad:clicks'); ?></td>
        <td><?php echo ossn_print('ad:browse'); ?></td>
        <td><?php echo ossn_print('edit'); ?></td>
    </tr>
    <?php
    $items = $pagination->getItem();
    if ($items) {
        foreach ($items as $ads) {
            ?>
            <tr>
                <td><input type="checkbox" name="entites[]" value="<?php echo $ads->guid; ?>"/></td>
                <td><?php echo $ads->title; ?></td>
                <td><?php echo $ads->description; ?></td>
                <td> 32</td>
                <td>
                    <a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=view&id={$ads->guid}"); ?>">
                        <?php echo ossn_print('ad:browse'); ?></a></td>
                <td>
                    <a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=edit&id={$ads->guid}"); ?>">
                        <?php echo ossn_print('edit'); ?></a></td>

            </tr>
        <?php
        }

    }?>
    </tbody>
</table>
<?php echo $pagination->pagination(); ?>
