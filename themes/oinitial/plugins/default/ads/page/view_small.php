<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$ads = new OssnAds;
$ads = $ads->getAds();
?>
<div class="ossn-ads ossn-ads-small">
    <div class="sponsered"><?php echo ossn_print('sponsored'); ?></div>
    <?php
    if ($ads) {
        foreach ($ads as $ads) {
            ?>
            <div class="ossn-ad-tiem-small">
                <div class="ad-heading">
                    <a href="<?php echo $ads->site_url; ?>"><?php echo $ads->title; ?></a>
                </div>
                <div class="ossn-ads-link"> <?php echo $ads->site_url; ?> </div>
                <img src="<?php echo ossn_ads_image_url($ads->guid); ?>"/>

                <div class="descript">
                    <?php echo $ads->description; ?>
                </div>
            </div>
        <?php
        }
    }
    ?>

</div>