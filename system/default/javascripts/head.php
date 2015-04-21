<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.Open Source Social Network.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */
 $timestamp = time();
 $token = ossn_generate_action_token($timestamp);
 
 $token = array(
			'ossn_ts' => $timestamp,
			'ossn_token' => $token,
			);
 $configs = array('token' => $token);
?> 	
	Ossn.site_url = '<?php echo ossn_site_url();?>';
	Ossn.Config = <?php echo json_encode($configs);?>;
	Ossn.Init();