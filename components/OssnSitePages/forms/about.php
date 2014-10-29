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
$OssnSitePages = new OssnSitePages;
$OssnSitePages->pagename = 'about';
$OssnSitePages = $OssnSitePages->getPage();
?>
<label> <?php echo ossn_print('site:about'); ?> </label>
<textarea name="pagebody" class="ossn-editor"><?php echo html_entity_decode($OssnSitePages->description); ?></textarea>
<br/>
<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('save'); ?>"/>
