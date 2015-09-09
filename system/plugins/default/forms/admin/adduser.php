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
	<label> <?php echo ossn_print('first:name'); ?> </label>
	<input type='text' name="firstname" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('last:name'); ?> </label>
	<input type='text' name="lastname" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('username'); ?> </label>
	<input type='text' name="username" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('email'); ?> </label>
	<input type='text' name="email" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('password'); ?> </label>
	<input type='password' name="password" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('birthdate'); ?> </label> 
    <select name="birthday">
        <option value=""><?php echo ossn_print('day'); ?></option>
        <?php for ($day = 1; $day <= 31; $day++) { ?>
            <option
                value="<?php echo strlen($day) == 1 ? '0' . $day : $day; ?>"><?php echo strlen($day) == 1 ? '0' . $day : $day; ?></option>
        <?php } ?>
    </select>

    <select name="birthm">
        <option value=""><?php echo ossn_print('month'); ?></option>
        <?php for ($month = 1; $month <= 12; $month++) { ?>
            <option
                value="<?php echo strlen($month) == 1 ? '0' . $month : $month; ?>"><?php echo strlen($month) == 1 ? '0' . $month : $month; ?></option>
        <?php } ?>
    </select>

    <select name="birthy">
        <option value=""><?php echo ossn_print('year'); ?></option>
        <?php for ($year = date('Y'); $year > date('Y') - 100; $year--) { ?>
            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
        <?php } ?>
    </select>
</div>
<div>
	<label> <?php echo ossn_print('gender'); ?> </label>
	<select name="gender">
    	<option value="male"> <?php echo ossn_print('male'); ?> </option>
    	<option value="female"><?php echo ossn_print('female'); ?> </option>
	</select>
</div>
<div>
	<label> <?php echo ossn_print('type'); ?> </label>

	<select name="type">
    	<option value="normal"><?php echo ossn_print('normal'); ?></option>
    	<option value="admin"> <?php echo ossn_print('admin'); ?> </option>
	</select>
</div>
<div>
	<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
</div>