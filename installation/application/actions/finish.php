<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
 
  file_put_contents(bframework_get_approot_path().'INSTALLED', 1);
  $installed = str_replace('installation/', '', bframework_get_url()).'administrator';
  header("Location: {$installed}");
  