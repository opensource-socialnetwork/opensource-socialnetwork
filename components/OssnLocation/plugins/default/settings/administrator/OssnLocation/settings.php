<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Rafael Amorim <amorim@rafaelamorim.com.br>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

echo ossn_view_form('OssnLocation/admin/settings', array(
    'action' => ossn_site_url() . 'action/location/admin/settings',
));
