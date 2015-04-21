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
$email = ossn_site_settings('owner_email');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo ossn_site_settings('site_name'); ?></title>
    <link rel="stylesheet"href="<?php echo ossn_site_url(); ?>themes/<?php echo ossn_site_settings('theme'); ?>/plugins/default/css/exception.css"type="text/css"/>
</head>
<div class="ossn-exception-header">
    <div class="inner">
        <?php echo ossn_site_settings('site_name'); ?>
    </div>
</div>
<div class="ossn-exception-handler">
    <div class="container-inner">
        <div class="ossn-logo"></div>
        <div class="title"><?php echo ossn_print('ossn:exception:title', array($email)); ?></div>
    </div>
    <div class="ossn-exception-description"><?php echo $params['exception']; ?></div>

</div>
<body>
</body>
</html>