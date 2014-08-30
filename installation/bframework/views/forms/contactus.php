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
* Core Contact us form
*/ 
echo bframework_form(array(
       'attributes' => array('action' => bframework_get_core_url().'actions/send.php','id' => 'contactus','method' => 'post'),
       'body' => bframework_view(bframework_get_base_path().'views/contents/forms/contactus') 
));

