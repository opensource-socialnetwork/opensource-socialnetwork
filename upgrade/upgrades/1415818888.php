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

$database = new OssnDatabase;
/**
 * Fix duplicate username in database
 *
 * @access private
 */
$database->statement("SELECT DISTINCT username, count(username) as 
				 times FROM `ossn_users` GROUP BY username HAVING  
				 count(username) > 1");	

$database->execute();
$data = $database->fetch(true);

foreach($data as $meta){
	$duplicates[] = $meta->username;
    $database->statement("SELECT * FROM `ossn_users` 
							  WHERE(username='{$meta->username}');");																												
    $database->execute();

    $users = $database->fetch(true);
	//no need to fix first username
	unset($users->{0});
	
	$increment = 0;
	foreach($users as $user){
		$databasen = $increment+1;
	    $databaseusername = $user->username.''.$databasen;
	    $database->statement("UPDATE `ossn_users` SET 
								 username='{$databaseusername}' 
								 WHERE(guid='{$user->guid}');");																												
        $database->execute();
    }
	unset($increment);
}
/**
 * Update processed updates in database so user cannot upgrade again and again.
 *
 * @access private
 */

$upgrade_json = array_merge(ossn_get_upgraded_files(), $upgrades);
$upgrade_json = json_encode($upgrade_json);

$update['table'] = 'ossn_site_settings';
$update['names'] = array('value');
$update['values'] = array($upgrade_json);
$update['wheres'] = array("name='upgrades'");

if ($database->update($update)) {
    ossn_trigger_message(ossn_print('upgrade:success'), 'success', 'admin');
    redirect('administrator');
} else {
    ossn_trigger_message(ossn_print('upgrade:failed'), 'error', 'admin');
    redirect('administrator');
}