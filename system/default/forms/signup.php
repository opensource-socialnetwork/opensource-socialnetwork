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
?>
<div>
    <input type="text" name="firstname" placeholder="<?php echo ossn_print('first:name'); ?>"/>
    <input type="text" name="lastname" placeholder="<?php echo ossn_print('last:name'); ?>"/>
</div>

<div>
    <input type="text" name="email" placeholder="<?php echo ossn_print('email'); ?>"/>
    <input name="email_re" type="text" placeholder="<?php echo ossn_print('email:again'); ?>"/>
</div>

<div>
    <input type="text" name="username" placeholder="<?php echo ossn_print('username'); ?>" class="long-input"/>
</div>

<div>
    <input type="password" name="password" placeholder="<?php echo ossn_print('password'); ?>" class="long-input"/>
</div>

<div>
    <h2><?php echo ossn_print('birthdate'); ?> </h2>
    <select name="birthday">
        <?php if (!empty($birthdate)) { ?>
            <option value="<?php echo $birthdate[0]; ?>"> <?php echo $birthdate[0]; ?> </option>
        <?php } ?>
        <option value=""><?php echo ossn_print('day'); ?></option>
        <?php for ($day = 1; $day <= 31; $day++) { ?>
            <option
                value="<?php echo strlen($day) == 1 ? '0' . $day : $day; ?>"><?php echo strlen($day) == 1 ? '0' . $day : $day; ?></option>
        <?php } ?>
    </select>

    <select name="birthm">
        <?php if (!empty($birthdate)) { ?>
            <option value="<?php echo $birthdate[1]; ?>"> <?php echo $birthdate[1]; ?> </option>
        <?php } ?>
        <option value=""><?php echo ossn_print('month'); ?></option>
        <?php for ($month = 1; $month <= 12; $month++) { ?>
            <option
                value="<?php echo strlen($month) == 1 ? '0' . $month : $month; ?>"><?php echo strlen($month) == 1 ? '0' . $month : $month; ?></option>
        <?php } ?>
    </select>

    <select name="birthy">
        <?php if (!empty($birthdate)) { ?>
            <option value="<?php echo $birthdate[2]; ?>"> <?php echo $birthdate[2]; ?> </option>
        <?php } ?>
        <option value=""><?php echo ossn_print('year'); ?></option>
        <?php for ($year = date('Y'); $year > date('Y') - 100; $year--) { ?>
            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
        <?php } ?>
    </select>
</div>

<div>
    <span><h3><input type="radio" name="gender" value="male"/> <?php echo ossn_print('male'); ?></h3></span>
    <span><h3><input type="radio" name="gender" value="female"/> <?php echo ossn_print('female'); ?></h3></span>
</div>

<div id="ossn-signup-errors" class="ossn-error-container"></div>

<p>
    <?php echo ossn_print('account:create:notice'); ?>
    <a href="<?php echo ossn_site_url('site/terms'); ?>"><?php echo ossn_print('site:terms'); ?></a>
</p>
<div class="ossn-loading ossn-hidden"></div>
<input type="submit" id="ossn-submit-button" value="<?php echo ossn_print('create:account'); ?>" class=""/>
