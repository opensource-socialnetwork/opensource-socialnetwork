<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="col-lg-12 d-flex justify-content-center">
    <div class="w-100" style="max-width: 600px; margin-top: 40px; margin-bottom: 40px;">
        <div class="ossn-error-page card shadow-sm border-0 text-center p-5 rounded-lg bg-white">
            <div class="error-icon-wrapper mb-4">
                <span class="fa-stack fa-3x text-muted" style="color: #e4e6eb !important;">
                    <i class="fa fa-circle fa-stack-2x" style="color: #f0f2f5;"></i>
                    <i class="fa fa-compass fa-stack-1x" style="color: #1877f2;"></i>
                </span>
            </div>
            
            <div class="error-heading font-weight-bold mb-2" style="font-size: 24px; color: #050505;">
                <?php echo ossn_print('page:error:heading'); ?>
            </div>
            
            <div class="error-text text-muted mb-4" style="font-size: 15px; line-height: 1.5;">
                <?php echo ossn_print('page:error:text'); ?>
                <br><?php echo ossn_print('fbui:error:subtext'); ?>
            </div>

            <div class="error-actions d-flex justify-content-center align-items-center gap-2">
                <a href="<?php echo ossn_site_url(); ?>" class="btn btn-light px-4 font-weight-bold" style="background-color: #e4e6eb; color: #050505; border-radius: 6px;">
                    <i class="fa fa-arrow-left mr-1"></i> <?php echo ossn_print('fbui:button:back'); ?>
                </a>
                <?php if(ossn_isLoggedin()){ ?>
                <a href="<?php echo ossn_site_url('home'); ?>" class="btn btn-primary px-4 font-weight-bold" style="background-color: #1877f2; border-color: #1877f2; border-radius: 6px;">
                    <i class="fa fa-home mr-1"></i> <?php echo ossn_print('fbui:button:feed'); ?>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>      
</div>