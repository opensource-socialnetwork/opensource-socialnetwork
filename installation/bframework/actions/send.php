<?php 
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Buddyexpress Core Team <admin@buddyexpress.net
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */
require_once(dirname(dirname(__FILE__)).'/buddyexpress.php');

if(isset($_POST['name']) && !empty($_POST['name'])){ $name = $_POST['name']; } else { $name = null; echo 'Name canot be empty.<br/>'; }
if(isset($_POST['email']) && !empty($_POST['email'])){ $email = $_POST['email']; } else { $email = null; echo 'Email canot be empty.<br/>'; }
if(isset($_POST['message']) && !empty($_POST['message'])){ $message = $_POST['message']; } else { $message = null; echo 'Message canot be empty.<br/>'; }
bframework_send_email_admin($message, $email, bframework_get_app_name().' : '.$name);

?>