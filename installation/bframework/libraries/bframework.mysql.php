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
 
define('db_host', 'localhost');
define('db_hostip', '127.0.0.1');

function bframework_connect_db($params = array()){
if(empty($params['host'])){ 
      $params['host'] = db_host;
}  if(empty($params['user'])){ 
      $params['user'] = 'root';
} if(empty($params['password'])){ 
      $params['password'] = '';
} if(empty($params['db'])){ 
   throw new DatabaseException('Can not connect to database');
} mysql_connect ($params['host'],$params['password'],$params['user']) or die('Cannot connect to MySQL: ' . mysql_error());
mysql_select_db ($params['db']) or die ('Cannot connect to the database: ' . mysql_error());
}


