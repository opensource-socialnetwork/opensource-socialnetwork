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
?>
<div class="ossn-login">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-5 col-md-7 col-sm-10">
            
            <div class="glass-signup-card login-card-custom">
                <div class="login-icon-badge reset-badge">
                    <i class="fa fa-unlock-alt"></i>
                </div>

                <div class="text-center mb-4 mt-4">
                    <h2 class="fw-bold text-dark"><?php echo ossn_print('reset:password'); ?></h2>
                    <div class="header-line"></div>
                </div>

                <div class="modern-reset-form">
                    <?php 
                        echo ossn_view_form('user/resetlogin', array(
                            'action' => ossn_site_url('action/resetlogin'),
                            'class' => 'ossn-reset-login',
                        ));
                    ?>
                </div>

                <div class="text-center mt-4 pt-3 border-top border-light">
                    <a href="<?php echo ossn_site_url('login');?>" class="back-to-login">
                        <i class="fa fa-chevron-left"></i> <?php echo ossn_print('site:login');?>
                    </a>
                </div>
            </div>              
        </div>      
    </div>
</div>