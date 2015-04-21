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
<a href="<?php echo ossn_site_url('resetlogin'); ?>"> <?php echo ossn_print('reset:login'); ?> </a>
