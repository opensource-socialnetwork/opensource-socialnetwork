<?php
/**
 * Buddyexpress Framework Core
 *
 * @package   Bframework
 * @author    Syed Arsalan Hussain Shah <arsalan@buddyexpress.net>
 * @copyright 2012 BUDDYEXPRESS.
 * @license   Buddyexpress Public License http://www.buddyexpress.net/Licences/bpl/ 
 * @link      http://bserver.buddyexpress.net
 * @Contributors http://www.buddyexpress.net/bframework/contributors.b
 */
if(bframework_check_premission()){  
echo '<form method="post">';			
echo  '<label> Website Url:</label>';   
echo  '<br />';
echo  'Enter your website your, usually Bframework guess it correct.<br />';
echo   '<input name="siteurl" type="text" value="'.bframework_get_url(true).'" />';
echo  '</p><p>';
echo    '<input type="submit" name="submit" value="Continue"/>';
echo  '</p>';
echo '</form>';
}