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
$user = $params['user'];
?>
<label> <?php echo ossn_print('first:name'); ?> </label>
<input type='text' name="firstname" value="<?php echo $user->first_name; ?>"/>

<label> <?php echo ossn_print('last:name'); ?> </label>
<input type='text' name="lastname" value="<?php echo $user->last_name; ?>"/>

<label> <?php echo ossn_print('username'); ?>  </label>
<input type='text' name="username" value="<?php echo $user->username; ?>" style="background:#E8E9EA;"
       readonly="readonly"/>

<label> <?php echo ossn_print('email'); ?> </label>
<input type='text' name="email" value="<?php echo $user->email; ?>"/>

<label> <?php echo ossn_print('password'); ?>  </label>
<input type='password' name="password" value=""/>
<?php
$birthdate = explode('/', $user->birthdate);
?>
<label><?php echo ossn_print('birthdate'); ?> </label>
<div class="groups-inline">
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
<label> <?php echo ossn_print('gender'); ?> </label>
<select name="gender">
    <?php
    if ($user->gender == 'male') {
        $male = 'selected';
        $female = '';
    }
    if ($user->gender == 'female') {
        $female = 'selected';
        $male = '';
    }
    ?>
    <option value="male" <?php echo $male; ?>><?php echo ossn_print('male'); ?> </option>
    <option value="female" <?php echo $female; ?>><?php echo ossn_print('female'); ?></option>
</select>
<label><?php echo ossn_print('language');?></label>
<?php
	//profile edit form shows wrong default language #546
	$userlanguage = ossn_site_settings('language');
	echo ossn_plugin_view('input/dropdown', array(
				'name' => 'language',
				'value' => $userlanguage,
				'options' => ossn_get_installed_translations(false),
	));
?>
<input type="hidden" value="<?php echo $user->username; ?>" name="username"/>
<input type="submit" class="ossn-button ossn-button-submit" value="<?php echo ossn_print('save'); ?>"/>
