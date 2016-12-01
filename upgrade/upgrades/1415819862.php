<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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

$upgrade_json = array_merge(ossn_get_upgraded_files(), array($upgrade));
$upgrade_json = json_encode($upgrade_json);

$update['table'] = 'ossn_site_settings';
$update['names'] = array('value');
$update['values'] = array($upgrade_json);
$update['wheres'] = array("name='upgrades'");

$upgrade = str_replace('.php', '', $upgrade);
if ($database->update($update)) {
    ossn_trigger_message(ossn_print('upgrade:success', array($upgrade)), 'success');
} else {
    ossn_trigger_message(ossn_print('upgrade:failed', array($upgrade)), 'error');
}