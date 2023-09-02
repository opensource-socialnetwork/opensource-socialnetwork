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
if (ossn_isLoggedIn()) {
    ?>
    <div class="ossn-photo-menu">
        <li><a class="btn btn-danger btn-sm" href="<?php echo ossn_site_url("action/profile/cover/photo/delete?id={$params->guid}", true); ?>"> <?php echo ossn_print('delete:photo'); ?> </a>
        </li>
    </div>
<?php } ?>
