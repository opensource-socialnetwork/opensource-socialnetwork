<?php
/**
 * Admin panel page for OssnAuthentikLogin (rendered under Components → OssnAuthentikLogin → Settings).
 */
echo ossn_view_form('authentik/admin/settings', array(
    'action' => ossn_site_url('action/authentik/admin/settings'),
));
