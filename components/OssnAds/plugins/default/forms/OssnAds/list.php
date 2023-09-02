<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$ads = new OssnAds;
$items 		= $ads->getAds(array(), false);
$count      = $ads->getAds(array(
				'count' => true,								 
));
?>
<div class="right margin-bottom-10">
	<div class="inline-block">
    	<a href="<?php echo ossn_site_url("administrator/component/OssnAds?settings=add"); ?>" class="btn btn-success btn-sm"><?php echo ossn_print('add'); ?></a>
    </div>
    <div class="inline-block">
      <input type="submit" class="btn btn-danger btn-sm" value="<?php echo ossn_print('delete'); ?>"/>
   </div>   
</div>
<div>
<table class="table">
    <tbody>
    <tr class="table-titles">
        <td></td>
        <td><?php echo ossn_print('ad:title'); ?></td>
        <td><?php echo ossn_print('ad:site:url'); ?></td>
        <!-- <td><?php echo ossn_print('ad:clicks'); ?></td> -->
        <td><?php echo ossn_print('ad:browse'); ?></td>
        <td><?php echo ossn_print('edit'); ?></td>
    </tr>
    <?php
    if ($items) {
        foreach ($items as $ads) {
            ?>
            <tr>
                <td><input type="checkbox" name="entites[]" value="<?php echo $ads->guid; ?>"/></td>
                <td><?php echo $ads->title; ?></td>
                <td><?php echo $ads->description; ?></td>
                <!-- <td> 32</td> -->
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
</div>
<div class="row">
	<?php echo ossn_view_pagination($count); ?>
</div>
