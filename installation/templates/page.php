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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $params['title']; ?></title>
    <link rel="stylesheet" href="./styles/ossn.install.css"/>
</head>

<body>
<div class="ossn-header">
    <div class="inner">
        <div class="logo-installation"></div>
    </div>
</div>
<div style="margin:0 auto; width:1000px;">
    <div class="ossn-default">
        <div class="ossn-top">
            <table border="0">
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <div class="buddyexpresss-search-box inline" style="margin-top: -50px;"></div>
                    </td>
                </tr>
            </table>

        </div>
        <div id="ossn-page-menubar">
            <li><a href="#"><?php echo ossn_installation_print("ossn:installation"); ?></a></li>
            <li><a href="#"> > </a></li>
            <li><a href="#"><?php echo $params['title']; ?></a></li>
            </li>

        </div>
    </div>
    <div>

        <div>
            <?php
            echo ossn_installation_messages();?>
        </div>

        <div>
            <?php echo $params['contents']; ?>
        </div>

        <div class="ossn-installation-footer">
            <?php echo 'POWERED <a href="http://www.opensource-socialnetwork.org">OPEN SOURCE SOCIAL NETWORK</a>'; ?>
        </div>

</body>
</html>
