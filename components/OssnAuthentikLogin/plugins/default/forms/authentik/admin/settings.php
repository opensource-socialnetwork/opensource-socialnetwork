<?php
/**
 * Admin settings form for OssnAuthentikLogin.
 */
$s = ossn_authentik_login_settings();
$default_redirect = ossn_site_url('authentik/callback');
?>
<div>
    <label><?php echo ossn_print('authentik:settings:issuer'); ?></label>
    <input type="text" name="authentik_issuer"
           value="<?php echo isset($s->issuer) ? htmlspecialchars($s->issuer, ENT_QUOTES) : ''; ?>"
           placeholder="https://auth.togetherfdn.us/application/o/&lt;slug&gt;/" />
    <small><?php echo ossn_print('authentik:settings:issuer:help'); ?></small>
</div>
<div>
    <label><?php echo ossn_print('authentik:settings:client_id'); ?></label>
    <input type="text" name="authentik_client_id"
           value="<?php echo isset($s->client_id) ? htmlspecialchars($s->client_id, ENT_QUOTES) : ''; ?>" />
</div>
<div>
    <label><?php echo ossn_print('authentik:settings:client_secret'); ?></label>
    <input type="password" name="authentik_client_secret"
           value="<?php echo isset($s->client_secret) ? htmlspecialchars($s->client_secret, ENT_QUOTES) : ''; ?>"
           autocomplete="new-password" />
</div>
<div>
    <label><?php echo ossn_print('authentik:settings:redirect_uri'); ?></label>
    <input type="text" name="authentik_redirect_uri"
           value="<?php echo isset($s->redirect_uri) ? htmlspecialchars($s->redirect_uri, ENT_QUOTES) : ''; ?>"
           placeholder="<?php echo htmlspecialchars($default_redirect, ENT_QUOTES); ?>" />
    <small><?php echo ossn_print('authentik:settings:redirect_uri:help'); ?></small>
</div>
<div>
    <input type="submit" value="<?php echo ossn_print('save'); ?>" class="btn btn-success btn-sm" />
</div>
