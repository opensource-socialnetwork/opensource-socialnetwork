<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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
