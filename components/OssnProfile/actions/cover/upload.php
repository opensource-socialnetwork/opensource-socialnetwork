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
$file = new OssnFile;
$file->owner_guid = ossn_loggedin_user()->guid;;
$file->type = 'user';
$file->subtype = 'profile:cover';
$file->setFile('coverphoto');
$file->setPath('profile/cover/');
if ($file->addFile()) {
    $ossnprofile = new OssnProfile;
    $ossnprofile->ResetCoverPostition($file->owner_guid);
    echo 1;
} else {
    echo 0;
} 