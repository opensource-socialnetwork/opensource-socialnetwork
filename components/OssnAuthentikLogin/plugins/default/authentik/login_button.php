<?php
/**
 * Renders the "Sign in with Authentik" button on the OSSN login form.
 * Hooked into the `forms/login2/before/submit` extend point.
 */
?>
<div class="ossn-authentik-login" style="margin: 12px 0;">
    <a href="<?php echo ossn_site_url('authentik/login'); ?>"
       class="btn btn-primary btn-sm" style="width: 100%; text-align: center;">
        <?php echo ossn_print('authentik:login:button'); ?>
    </a>
    <div style="text-align: center; color: #888; margin: 8px 0; font-size: 12px;">
        <?php echo ossn_print('authentik:or'); ?>
    </div>
</div>
