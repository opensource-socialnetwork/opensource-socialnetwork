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

/* 
* Bframework need your website url, 
* Please make sure you have enter backslash '/' at the end of url
* like http://www.mywebsite.com <= this is not accepted
* url like http://www.mywebsite.com/ <= this is accepted
*/
$Bframework->baseurl = '<<site_url>>';

/* 
* Bframework display errors or not, 
* Enter on or off
* Example ini_set('display_errors','off'); 
*/
ini_set('display_errors','<<display_errors>>'); 

/* 
* Bframework need bframework date on your websserver, 
* Example 1355656882, this is auto generated upon installation
*/
$Bframework->sitebron = '<<siteborn_time>>';
