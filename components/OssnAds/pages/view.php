<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
<h4><?php echo $params['entity']->title;?></h4>
<a href="<?php echo $params['entity']->site_url;?>"><?php echo $params['entity']->site_url;?></a>
<p><?php echo $params['entity']->description;?></p>
<div class="ossn-ad-image" style="background:url('<?php echo ossn_ads_image_url($params['entity']->guid);?>') no-repeat;background-size: contain;"></div>
