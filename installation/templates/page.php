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
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $params['title']; ?></title>
    <link rel="stylesheet" href="./styles/ossn.install.css"/>
    <link rel="icon" href="./styles/favicon.ico?ossn_cache" type="image/x-icon" />
</head>

<body>
<div class="ossn-header">
    <div class="inner">
        <div class="logo-installation"></div>
        <img class="settings" src="./styles/settings.jpg" />
    </div>
</div>
<div id="ossn-page-menubar">
	<div class="inner">
	    <li><a href="#"><?php echo ossn_installation_print("ossn:installation"); ?></a></li>
   		<li><a href="#"> > </a></li>
  	 	<li><a href="#"><?php echo $params['title']; ?></a></li>
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
    </div>
    <div>

        <div class="ossn-installation-message-marg">
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
