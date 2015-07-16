<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
    <h2><?php echo ossn_print('notifications'); ?></h2>
<?php
$get = new  OssnNotifications;
$notifications = $get->get(ossn_loggedin_user()->guid);
echo '<div class="ossn-notifications-all ossn-notification-page">';
if ($notifications) {
    foreach ($notifications as $not) {
        echo "{$not}";
    }
}
echo '</div>';
?>