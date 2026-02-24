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
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="glass-signup-card login-card-custom">
                <div class="login-icon-badge">
                    <i class="fa fa-user-lock"></i>
                </div>
                <div class="text-center mb-4 mt-4">
                    <h2 class="fw-bold text-dark"><?php echo ossn_print('reset:password'); ?></h2>
                    <div class="header-line"></div>
                </div>

                <?php 
                    echo ossn_view_form('user/resetpassword', array(
  					 	'action' => ossn_site_url('action/resetpassword'),
    				 	'class' => 'ossn-reset-login',
					));
                ?>
            </div>              
        </div>      
    </div>
</div>
