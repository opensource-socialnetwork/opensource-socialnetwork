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

$notification_email = parse_url(ossn_installation_paths()->url);
if(substr($notification_email['host'], 0, 4) == 'www.'){
	$notification_email['host'] = substr($notification_email['host'], 4);
}
?>

<form action="<?php echo ossn_installation_paths()->url; ?>?action=install" method="post">

    <header class="content-header mb-4">
        <h1 class="display-6 fw-bold text-dark mb-1">
            <?php echo ossn_installation_print('ossn:dbsettings'); ?>
        </h1>
        <p class="text-muted fs-6">
            <?php echo ossn_installation_print('ossn:dbsettings:desc'); ?>
        </p>
    </header>

    <div class="mb-4">
        <label class="form-label fw-bold text-secondary small text-uppercase mb-2">
            <?php echo ossn_installation_print('ossn:dbsettings'); ?>
        </label>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <input class="form-control" type="text" name="dbuser" placeholder="<?php echo ossn_installation_print('ossn:dbuser'); ?>" />
            </div>
            <div class="col-md-6">
                <input class="form-control" type="password" name="dbpwd" placeholder="<?php echo ossn_installation_print('ossn:dbpassword'); ?>" />
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <input class="form-control" type="text" name="dbname" placeholder="<?php echo ossn_installation_print('ossn:dbname'); ?>" />
            </div>
            <div class="col-md-6">
                <input class="form-control" type="text" name="dbhost" placeholder="<?php echo ossn_installation_print('ossn:dbhost'); ?>" />
            </div>
        </div>
    </div>

    <header class="content-header mb-4 mt-5">
        <h1 class="display-6 fw-bold text-dark mb-1">
            <?php echo ossn_installation_print('ossn:sitesettings'); ?>
        </h1>
        <p class="text-muted fs-6">
            <?php echo ossn_installation_print('ossn:sitesettings:desc'); ?>
        </p>
    </header>

    <div class="mb-4">
        <label class="form-label fw-bold text-secondary small text-uppercase mb-2">
            <?php echo ossn_installation_print('ossn:sitesettings'); ?>
        </label>

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <input class="form-control" type="text" name="sitename" placeholder="<?php echo ossn_installation_print('ossn:websitename'); ?>" />
            </div>
            <div class="col-md-6">
                <input class="form-control" type="text" name="owner_email" placeholder="<?php echo ossn_installation_print('owner_email'); ?>" />
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <?php
                $notif_val = !filter_var($notification_email['host'], FILTER_VALIDATE_IP) ? "noreply@" . $notification_email['host'] : "";
                ?>
                <input class="form-control" type="text" name="notification_email" placeholder="<?php echo ossn_installation_print('notification_email'); ?>" value="<?php echo $notif_val; ?>" />
            </div>
        </div>
    </div>

    <header class="content-header mb-4 mt-5">
        <h1 class="display-6 fw-bold text-dark mb-1">
            <?php echo ossn_installation_print('ossn:datadir'); ?>
        </h1>
        <p class="text-danger fw-bold fs-6">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            <?php echo ossn_installation_print('ossn:datadir:desc'); ?>
        </p>
    </header>

    <div class="mb-4">
        <label class="form-label fw-bold text-secondary small text-uppercase mb-2">
            <?php echo ossn_installation_print('ossn:datadir'); ?>
        </label>

        <input type="hidden" name="url" value="<?php echo OssnInstallation::url(); ?>" />

        <div>
            <input class="form-control" type="text" name="datadir" value="<?php echo OssnInstallation::DefaultDataDir(); ?>" />

            <div class="form-text mt-3 text-dark" style="line-height: 1.6;">
                <p><?php echo ossn_installation_print('ossn:datadir:info'); ?></p>
                <ul class="ps-3">
                    <li><?php echo ossn_installation_print('ossn:datadir:step1'); ?></li>
                    <li><?php echo ossn_installation_print('ossn:datadir:step2'); ?></li>
                    <li><?php echo ossn_installation_print('ossn:datadir:step3'); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end pt-4 mt-5 border-top">
        <a href="/installation/?page=license" class="installer-btn btn-cancel"><?php echo ossn_installation_print('ossn:back'); ?></a>
        <input type="submit" value="<?php echo ossn_installation_print('ossn:install:install'); ?>" class="ms-2 installer-btn btn-primary px-5 py-3">
    </div>

</form>