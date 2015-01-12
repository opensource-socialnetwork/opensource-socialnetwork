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
<div>
    <input type="text" name="username" placeholder="<?php echo ossn_print('username'); ?>" class="long-input">
</div>

<div>
    <input type="password" name="password" placeholder="<?php echo ossn_print('password'); ?>" class="long-input">
</div>
<div>
    <input type="submit" value="<?php echo ossn_print('site:login');?>" class="ossn-button ossn-button-submit"/>
</div>
<a href="<?php echo ossn_site_url('resetlogin'); ?>"> Reset password </a>
