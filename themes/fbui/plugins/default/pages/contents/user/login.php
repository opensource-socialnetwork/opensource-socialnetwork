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
$error = input('error');
?>
<div class="ossn-login">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="glass-signup-card login-card-custom">
                <div class="login-icon-badge">
                    <i class="fa fa-user-lock"></i>
                </div>
                <div class="text-center mb-4 mt-4">
                    <h2 class="fw-bold text-dark"><?php echo ossn_print('site:login'); ?></h2>
                    <div class="header-line"></div>
                </div>

                <?php if ($error == 1) { ?>
                    <div class="alert alert-danger modern-error-shake shadow-sm">
                        <i class="fa fa-shield-alt"></i>
                        <span><?php echo ossn_print('login:error'); ?></span>
                    </div>
                <?php } ?>

                <?php 
                    echo ossn_view_form('login2', array(
                        'id' => 'ossn-login',
                        'action' => ossn_site_url('action/user/login'),
                    ));
                ?>

                <div class="login-footer text-center mt-4">
                    <a href="<?php echo ossn_site_url('resetlogin');?>" class="forgot-link">
                        <i class="fa fa-question-circle"></i> <?php echo ossn_print('reset:login'); ?>
                    </a>
                </div>
            </div>              
        </div>      
    </div>
</div>