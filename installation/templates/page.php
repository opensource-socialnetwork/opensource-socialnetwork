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

// 1. Define the order of pages
$steps_order = [
    'default' => 0, // Requirements checklist
    'license' => 1, 
    'settings' => 2, 
    'account' => 3, 
    'installed'  => 4
];

// 2. Get the current page from URL, default to 'default' if empty
$current_page = isset($_GET['page']) ? $_GET['page'] : 'default';

// 3. Get the numeric index of the current step
$current_index = isset($steps_order[$current_page]) ? $steps_order[$current_page] : 0;

/**
 * Helper function to return the CSS class based on progress
 */
function getStepClass($step_name, $steps_order, $current_index) {
    $step_index = $steps_order[$step_name];
    
    if ($current_index > $step_index) {
        return 'visited';
    } elseif ($current_index == $step_index) {
        return 'active';
    }
    return ''; // Pending
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $params['title']; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="./styles/bootstrap.min.css" rel="stylesheet">
    <script src="./styles/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="./styles/ossn.install.css"/>
    <link rel="icon" href="./styles/favicon.ico?ossn_cache" type="image/x-icon" />
</head>

<body>
	<div class="blob-container">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        <div class="blob blob-4"></div>
    </div>
    <div class="ossn-installer-window">
        <!-- Sidebar -->
        <aside class="installer-sidebar">
            <div>
                <div class="sidebar-logo">
                    <img src="./styles/logo.png" alt="Logo" class="sidebar-img-logo">
                    <div class="premium-badge-wrapper d-none">
                        <span class="badge premium-badge">
                            <i class="bi bi-patch-check-fill me-1"></i> PREMIUM EDITION
                        </span>
                    </div>
                </div>

                <!-- Installation Steps -->
                <ul class="sidebar-steps mt-2">
                    <li class="step-item <?php echo getStepClass('default', $steps_order, $current_index); ?>">
                        <span class="circle"></span>
                        <span class="text"><?php echo ossn_installation_print('ossn:install:checklist'); ?></span>
                    </li>

                    <li class="step-item <?php echo getStepClass('license', $steps_order, $current_index); ?>">
                        <span class="circle"></span>
                        <span class="text"><?php echo ossn_installation_print('ossn:install:licence'); ?></span>
                    </li>

                    <li class="step-item <?php echo getStepClass('settings', $steps_order, $current_index); ?>">
                        <span class="circle"></span>
                        <span class="text"><?php echo ossn_installation_print('ossn:dbsettings'); ?></span>
                    </li>

                    <li class="step-item <?php echo getStepClass('account', $steps_order, $current_index); ?>">
                        <span class="circle"></span>
                        <span class="text"><?php echo ossn_installation_print('ossn:install:account'); ?></span>
                    </li>

                    <li class="step-item <?php echo getStepClass('installed', $steps_order, $current_index); ?>">
                        <span class="circle"></span>
                        <span class="text"><?php echo ossn_installation_print('ossn:install:complete'); ?></span>
                    </li>
                </ul>

                <!-- Help Section -->
                <div class="sidebar-help">
                    <span class="help-icon">?</span>
                    <span class="help-text"><a href="https://www.opensource-socialnetwork.org/community" target="_blank"><?php echo ossn_installation_print('helpcenter');?></a></span>
                </div>
            </div>
        </aside>

        <!-- Main Installer Content -->
        <section class="installer-content">
            <div class="installer-form-area">
                <?php
                    echo ossn_installation_messages();
                    echo $params['contents'];
                ?>
            </div>
        </section>

    </div> 
</body>
</html>