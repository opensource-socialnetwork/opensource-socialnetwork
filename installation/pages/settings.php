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
if (substr($notification_email['host'], 0, 4) == 'www.') {
    $notification_email['host'] = substr($notification_email['host'], 4);
}

$root_dir = dirname(__DIR__, 2);

// 1. Scan /locale/ only for files matching ossn.(code).php
$languages = [];
$langs_dir = $root_dir . '/locale/';
if (is_dir($langs_dir)) {
    foreach (scandir($langs_dir) as $file) {
        if (preg_match('/^ossn\.([a-zA-Z0-9_-]+)\.php$/', $file, $matches)) {
            $languages[] = $matches[1];
        }
    }
}
if (empty($languages)) {
    $languages = ['en'];
}

// 2. Scan /themes/ only for directories containing ossn_theme.xml
$themes     = [];
$themes_dir = $root_dir . '/themes/';
if (is_dir($themes_dir)) {
    foreach (scandir($themes_dir) as $dir) {
        if ($dir === '.' || $dir === '..') {
            continue;
        }
        $xml_file = $themes_dir . $dir . '/ossn_theme.xml';
        if (is_dir($themes_dir . $dir) && is_file($xml_file)) {
            $xml = @simplexml_load_file($xml_file);
            $themes[$dir] = ($xml && !empty($xml->name)) ? (string) $xml->name : ucfirst($dir);
        }
    }
}
if (empty($themes)) {
    $themes['goblue'] = 'Goblue';
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

        <label class="form-label fw-bold text-secondary small text-uppercase mb-2">
            <?php echo ossn_installation_print('notification_email'); ?>
        </label>

        <div class="row mb-3">
            <div class="col-12">
                <?php
                if (!filter_var($notification_email['host'], FILTER_VALIDATE_IP)) {
                    $email     = "noreply@" . $notification_email['host'];
                    $notif_val = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : "";
                } else {
                    $notif_val = "";
                }
                ?>
                <input class="form-control" type="text" placeholder="<?php echo ossn_installation_print('notification_email:noreply'); ?>" name="notification_email" value="<?php echo $notif_val; ?>" />
            </div>
        </div>

        <div class="row g-3 mt-1">
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase mb-2">
                    <?php echo ossn_installation_print('ossn:default:language'); ?>
                </label>
                <select class="form-select" name="default_language">
                    <?php foreach ($languages as $code) { ?>
                        <option value="<?php echo $code; ?>" <?php echo ($code === 'en') ? 'selected' : ''; ?>>
                            <?php echo ossn_installation_print($code); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary small text-uppercase mb-2">
                    <?php echo ossn_installation_print('ossn:default:theme'); ?>
                </label>
                <select class="form-select" name="default_theme">
                    <?php foreach ($themes as $theme_id => $theme_name) { ?>
                        <option value="<?php echo $theme_id; ?>" <?php echo ($theme_id === 'goblue') ? 'selected' : ''; ?>>
                            <?php echo $theme_name; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-text mt-2 text-muted">
            <i class="bi bi-info-circle me-1"></i>
            <?php echo ossn_installation_print('ossn:theme:lang:note'); ?>
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
        <a href="<?php echo ossn_installation_paths()->url; ?>?page=license" class="installer-btn btn-cancel">
            <?php echo ossn_installation_print('ossn:back'); ?>
        </a>
        <input type="submit" value="<?php echo ossn_installation_print('ossn:install:install'); ?>" class="ms-2 installer-btn btn-primary px-5 py-3">
    </div>

</form>