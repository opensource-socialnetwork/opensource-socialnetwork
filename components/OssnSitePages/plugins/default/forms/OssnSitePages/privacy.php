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
$OssnSitePages = new OssnSitePages;
$OssnSitePages->pagename = 'privacy';
$OssnSitePages = $OssnSitePages->getPage();
?>
<div>
	<label><?php echo ossn_print('site:privacy'); ?></label>
	<textarea name="pagebody" class="ossn-editor"><?php echo html_entity_decode($OssnSitePages->description); ?></textarea>
</div>
<div>
	<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
</div>