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
 if(!ossn_loggedin_user()){
	 return;
 }
?>
<div class="newseed-uinfo">
    <img src="<?php echo ossn_loggedin_user()->iconURL()->small; ?>"/>

    <div class="name">
        <a href="<?php echo ossn_loggedin_user()->profileURL(); ?>"><?php echo ossn_loggedin_user()->fullname; ?></a>
        <a class="edit-profile" href="<?php echo ossn_loggedin_user()->profileURL('/edit'); ?>">
            <?php echo ossn_print('edit:profile'); ?></a>
    </div>
</div>
