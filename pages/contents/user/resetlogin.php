<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
echo ossn_view_form('user/resetlogin', array(
    'id' => 'ossn-login',
    'action' => ossn_site_url('action/resetlogin'),
    'method' => 'post',
    'class' => 'ossn-reset-login',
));
?>
