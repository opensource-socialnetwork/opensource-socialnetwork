<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
define('OSSN_ALLOW_SYSTEM_START', TRUE);
require_once(dirname(dirname(dirname(__FILE__))) . '/system/start.php');

$copyrights = ossn_site_settings('copyrights');
if(!$copyrights || empty($copyrights)){
	$Site = new OssnSite();
	$Site->setSetting('notification_name', ossn_site_settings('site_name'));
	$Site->setSetting('copyrights', ossn_site_settings('site_name'));
}

?>
<div class="layout-installation">
    <header class="content-header mb-4">
        <h1 class="display-6 fw-bold text-dark mb-1"><?php echo ossn_installation_print('create:admin:account'); ?></h1>
        <p class="text-muted fs-6"><?php echo ossn_installation_print('create:admin:account:sub');?></p>
    </header>

    <form action="<?php echo ossn_installation_paths()->url; ?>?action=account" method="post">
        
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase"><?php echo ossn_installation_print('create:admin:account:firstname'); ?></label>
                <input type="text" name="firstname" class="form-control" placeholder="<?php echo ossn_installation_print('create:admin:account:firstname'); ?>"/>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase"><?php echo ossn_installation_print('create:admin:account:lastname'); ?></label>
                <input type="text" name="lastname" class="form-control" placeholder="<?php echo ossn_installation_print('create:admin:account:lastname'); ?>"/>
            </div>
        </div>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase"><?php echo ossn_installation_print('create:admin:account:email'); ?></label>
                <input type="text" name="email" class="form-control" placeholder="<?php echo ossn_installation_print('create:admin:account:email'); ?>"/>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase"><?php echo ossn_installation_print('create:admin:account:cemail'); ?></label>
                <input name="email_re" type="text" class="form-control" placeholder="<?php echo ossn_installation_print('create:admin:account:cemail'); ?>"/>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase"><?php echo ossn_installation_print('create:admin:account:username'); ?></label>
                <input type="text" name="username" class="form-control" placeholder="<?php echo ossn_installation_print('create:admin:account:username'); ?>"/>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase"><?php echo ossn_installation_print('create:admin:account:password'); ?></label>
                <input type="password" name="password" class="form-control" placeholder="<?php echo ossn_installation_print('create:admin:account:password'); ?>"/>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-12">
                <label class="form-label fw-bold text-secondary small text-uppercase d-block"><?php echo ossn_installation_print('create:admin:account:birthdate'); ?></label>
                <div class="d-flex gap-2">
                    <select name="birthday" class="form-select" style="max-width: 100px;">
                        <option value=""><?php echo ossn_installation_print('create:admin:account:day'); ?></option>
                        <?php for ($day = 1; $day <= 31; $day++) { 
                             $val = str_pad($day, 2, "0", STR_PAD_LEFT); ?>
                             <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                        <?php } ?>
                    </select>

                    <select name="birthm" class="form-select" style="max-width: 140px;">
                        <option value=""><?php echo ossn_installation_print('create:admin:account:month'); ?></option>
                        <?php for ($month = 1; $month <= 12; $month++) { 
                             $val = str_pad($month, 2, "0", STR_PAD_LEFT); ?>
                             <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                        <?php } ?>
                    </select>

                    <select name="birthy" class="form-select" style="max-width: 120px;">
                        <option value=""><?php echo ossn_installation_print('create:admin:account:year'); ?></option>
                        <?php for ($year = date('Y'); $year > date('Y') - 100; $year--) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">

            <div class="col-12">
                <label class="form-label fw-bold text-secondary small text-uppercase d-block"><?php echo ossn_installation_print('create:admin:account:gender'); ?></label>
                <div class="d-flex gap-4 mt-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderM" value="male"/>
                        <label class="form-check-label" for="genderM"><?php echo ossn_installation_print('create:admin:account:male'); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderF" value="female"/>
                        <label class="form-check-label" for="genderF"><?php echo ossn_installation_print('create:admin:account:female'); ?></label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="genderO" value="other"/>
                        <label class="form-check-label" for="genderO"><?php echo ossn_installation_print('create:admin:account:other'); ?></label>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end pt-4 mt-5 border-top">
            <input type="submit" value="<?php echo ossn_installation_print('ossn:install:create'); ?>" class="installer-btn btn-primary px-5 py-3"/>
        </div>
    </form>
</div>