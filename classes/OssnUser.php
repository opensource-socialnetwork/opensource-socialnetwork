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
class OssnUser extends OssnEntities {
    /**
     * Add user to system.
     *
     * @return bool;
     */
    public function addUser() {
        self::initAttributes();
        if (empty($this->usertype)) {
            $this->usertype = 'normal';
        }
        $user = $this->getUser();
        if (empty($user->username) && $this->isPassword() && $this->isUsername()) {
            $this->salt = $this->generateSalt();
            $password = $this->generate_password($this->password, $this->salt);
            $activation = md5($this->password . time() . rand());
	    $this->sendactiviation = ossn_call_hook('user', 'send:activation', false, $this->sendactiviation);
            if ($this->sendactiviation === false) {
                //don't set null , set empty value for users created by admin
		$activation = '';
            }
            $params['into'] = 'ossn_users';
            $params['names'] = array(
                'first_name',
                'last_name',
                'email',
                'username',
                'type',
                'password',
                'salt',
                'activation'
            );
            $params['values'] = array(
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->username,
                $this->usertype,
                $password,
                $this->salt,
                $activation
            );
            if ($this->OssnDatabase->insert($params)) {
                $guid = $this->OssnDatabase->getLastEntry();
                if (!empty($guid) && is_int($guid)) {
                    $this->owner_guid = $guid;
                    $this->type = 'user';

                    $this->subtype = 'gender';
                    $this->value = $this->gender;
                    $this->add();

                    $this->subtype = 'birthdate';
                    $this->value = $this->birthdate;
                    $this->add();
                }
                if ($this->sendactiviation === true) {
                    $link = ossn_site_url("uservalidate/activate/{$guid}/{$activation}");
		    $link = ossn_call_hook('user', 'validation:email:url', $this, $link);
                    $sitename = ossn_site_settings('site_name');
                    $activation = ossn_print('ossn:add:user:mail:body', array(
                        $sitename,
                        $link,
                        ossn_site_url()
                    ));
                    $subject = ossn_print('ossn:add:user:mail:subject', array(
                        $this->first_name,
                        $sitename
                    ));
                    $this->notify->NotifiyUser($this->email, $subject, $activation);
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Check if username is exist in database or not.
     *
     * @return bool;
     */
    public function isOssnUsername() {
        $user = $this->getUser();
        if (!empty($user->guid) && $this->username == $user->username) {
            return true;
        }
        return false;
    }

    /**
     * Check if email is exist in database or not.
     *
     * @return bool;
     */
    public function isOssnEmail() {
        $user = $this->getUser();
        if (!empty($user->guid) && $this->email == $user->email) {
            return true;
        }
        return false;
    }

    /**
     * Initialize the objects.
     *
     * @return void;
     */
    public function initAttributes() {
        $this->OssnDatabase = new OssnDatabase;
        $this->OssnAnnotation = new OssnAnnotation;
        $this->notify = new OssnMail;
        if (!isset($this->sendactiviation)) {
            $this->sendactiviation = false;
        }
    }

    /**
     * Get user with its entities.
     *
     * @return object;
     */
    public function getUser() {
        self::initAttributes();
        if (!empty($this->email)) {
            $params['from'] = 'ossn_users';
            $params['wheres'] = array("email='{$this->email}'");
            $user = $this->OssnDatabase->select($params);
        }
        if (empty($user) && !empty($this->username)) {
            $params['from'] = 'ossn_users';
            $params['wheres'] = array("username='{$this->username}'");
            $user = $this->OssnDatabase->select($params);
        }
        if (empty($user) && !empty($this->guid)) {
            $params['from'] = 'ossn_users';
            $params['wheres'] = array("guid='{$this->guid}'");
            $user = $this->OssnDatabase->select($params);
        }
        if (!$user) {
            return false;
        }
        $user->fullname = "{$user->first_name} {$user->last_name}";
        $this->owner_guid = $user->guid;
        $this->type = 'user';
        $entities = $this->get_entities();
        if (empty($entities)) {
            return arrayObject($user, get_class($this));
        }
        foreach ($entities as $entity) {
            $fields[$entity->subtype] = $entity->value;
        }
        $data = array_merge(get_object_vars($user), $fields);
        return arrayObject($data, get_class($this));
    }

    /**
     * Check if password is > 5 or not.
     *
     * @return bool;
     */
    public function isPassword() {
        if (strlen($this->password) > 5) {
            return true;
        }
        return false;
    }
    /**
     * Check if password is > 5 or not.
     *
     * @return bool;
     */
    public function isEmail() {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }  
	/**
     * Check if the user is correct or not.
     *
     * @return bool;
     */
    public function isUsername() {
        if (preg_match("/^[a-zA-Z0-9]+$/", $this->username) && strlen($this->username) > 4) {
            return true;
        }
        return false;
    }

    /**
     * Generate salt.
     *
     * @return string;
     */
    public function generateSalt() {
        return substr(uniqid(), 5);
    }

    /**
     * Generate password.
     *
     * @return hash;
     */
    public function generate_password($password = '', $salt = '') {
        return md5($password . $salt);
    }

    /**
     * Login into site.
     *
     * @return bool;
     */
    public function Login() {
        $user = $this->getUser();
        $salt = $user->salt;
        $password = $this->generate_password($this->password . $salt);
        if ($password == $user->password && $user->activation == NULL) {
            unset($user->password);
            unset($user->salt);
            $_SESSION['OSSN_USER'] = $user;
            $this->update_last_login();
            return true;
        }
        return false;
    }

    /**
     * Update user last login time.
     *
     * @return bool;
     */
    public function update_last_login() {
        self::initAttributes();
        $user = ossn_loggedin_user();
        $guid = $user->guid;
        $params['table'] = 'ossn_users';
        $params['names'] = array('last_login');
        $params['values'] = array(time());
        $params['wheres'] = array("guid='{$guid}'");
        if ($guid > 0 && $this->OssnDatabase->update($params)) {
            return true;
        }
        return false;
    }

    /**
     * Get user friends requests.
     *
     * @return object;
     */
    public function getFriendRequests($user = '') {
        if (isset($this->guid)) {
            $user = $this->guid;
        }
        $this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_to='{$user}' AND
					     type='friend:request'
					     );");
        $this->execute();
        $from = $this->fetch(true);
        if (!is_object($from)) {
            return false;
        }
        foreach ($from as $fr) {
            $this->statement("SELECT * FROM ossn_relationships WHERE(
                            relation_from='{$user}' AND
                            relation_to='{$fr->relation_from}' AND
                            type='friend:request'
                            );");
            $this->execute();
            $from = $this->fetch();            
            if (!isset($from->relation_id)) {
                $uss[] = ossn_user_by_guid($fr->relation_from);
            }
        }
        if (isset($uss)) {
            return $uss;
        }
        return false;
    }

    /**
     * Check if the user is friend with other or not.
     *
     * @return bool;
     */
    public function isFriend($usera, $user2) {
        $this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_from='{$usera}' AND
					     relation_to='{$user2}' AND
					     type='friend:request'
					     );");
        $this->execute();
        $from = $this->fetch();
        $this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_from='{$user2}' AND
					     relation_to='{$usera}' AND
				 	     type='friend:request'
					     );");
        $this->execute();
        $to = $this->fetch();
        if (isset($from->relation_id) && isset($to->relation_id)) {
            return true;
        }
        return false;
    }

    /**
     * Get user friends.
     *
     * @return object;
     */
    public function getFriends($user = '') {
        if (isset($this->guid)) {
            $user = $this->guid;
        }
        $this->statement("SELECT * FROM ossn_relationships WHERE(
			   		     relation_to='{$user}' AND
					     type='friend:request'
					     );");
        $this->execute();
        $from = $this->fetch(true);
        if (!is_object($from)) {
            return false;
        }
        foreach ($from as $fr) {
            if ($this->isFriend($user, $fr->relation_from)) {
                $uss[] = ossn_user_by_guid($fr->relation_from);
            }
        }
        if (isset($uss)) {
            return $uss;
        }
        return false;
    }

    /**
     * Send request to other user.
     *
     * @return bool;
     */
    public function sendRequest($from, $to) {
        if ($this->requestExists($from, $to)) {
            return false;
        }
        if (ossn_add_relation($from, $to, 'friend:request')) {
            return true;
        }
        return false;
    }

    /**
     * Check if the request already sent or not.
     *
     * @return bool;
     */
    public function requestExists($from, $user) {
        if (isset($this->guid)) {
            $user = $this->guid;
        }
        $this->statement("SELECT * FROM ossn_relationships WHERE(
					     relation_to='{$user}' AND
						 relation_from='{$from}' AND
					     type='friend:request'
					     );");
        $this->execute();
        $request = $this->fetch();
        if (!empty($request->relation_id)) {
            return true;
        }
        return false;
    }

    /**
     * Delete friend from list
     *
     * @return bool;
     */
    public function deleteFriend($from, $to) {
        $this->statement("DELETE FROM ossn_relationships WHERE(
						 relation_from='{$from}' AND relation_to='{$to}' OR
						 relation_from='{$to}' AND relation_to='{$from}')");
        if ($this->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Get site users.
     *
     * @return object;
     */
    public function getSiteUsers() {
        $this->statement("SELECT * FROM ossn_users");
        $this->execute();
        return $this->fetch(true);
    }

    /**
     * Update user last activity time
     *
     * @return bool;
     */
    public function update_last_activity() {
        self::initAttributes();
        $user = ossn_loggedin_user();
        if ($user) {
            $guid = $user->guid;
            $params['table'] = 'ossn_users';
            $params['names'] = array('last_activity');
            $params['values'] = array(time());
            $params['wheres'] = array("guid='{$guid}'");
            if ($guid > 0 && $this->OssnDatabase->update($params)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Count Total online site users.
     *
     * @return bool;
     */
    public function online_total() {
        return count((array)$this->getOnline());
    }

    /**
     * Get online site users.
     *
     * @params = $intervals => seconds
     *
     * @return object;
     */
    public function getOnline($intervals = '100') {
        self::initAttributes();
        $time = time();
        $params['from'] = 'ossn_users';
        $params['wheres'] = array("last_activity > {$time} - {$intervals}");
        return $this->OssnDatabase->select($params, true);
    }

    /**
     * Search site users with its entities
     *
     * @return bool;
     */
    public function searchUsers($q) {
        $search = $this->SearchSiteUsers($q);
        if (!$search) {
            return false;
        }
        $users = new OssnUser;
        foreach ($search as $user) {
            $users->guid = $user->guid;
            $userentity[] = $users->getUser();
        }
        $data = $userentity;
        return $data;
    }

    /**
     * Search users.
     *
     * @return object;
     */
    public function SearchSiteUsers($q) {
        $this->statement("SELECT * FROM ossn_users WHERE(CONCAT(first_name, ' ', last_name) LIKE '%$q%' OR
					 username LIKE '%$q%' OR email LIKE '%$q%')");
        $this->execute();
        return $this->fetch(true);
    }

    /**
     * Validate User Registration
     *
     * @return bool;
     */
    public function ValidateRegistration($code) {
        self::initAttributes();
        $user_activation = $this->getUser();
        $guid = $user_activation->guid;
        if ($user_activation->activation == $code) {
            $params['table'] = 'ossn_users';
            $params['names'] = array('activation');
            $params['values'] = array('');
            $params['wheres'] = array("guid='{$guid}'");
            if ($this->OssnDatabase->update($params)) {
                return true;
            }
        }
        return false;
    }

    /**
     * View user icon url
     *
     * @return url;
     */
    public function iconURL() {
        $this->iconURLS = new stdClass;
        foreach (ossn_user_image_sizes() as $size => $dimensions) {
            $seo = md5($this->username . $size);
            $url = ossn_site_url("avatar/{$this->username}/{$size}/{$seo}.jpeg");
            $this->iconURLS->$size = $url;
        }
        return ossn_call_hook('user', 'icon:urls', $this, $this->iconURLS);
    }

    /**
     * View user profile url
     *
     * @return url;
     */
    public function profileURL($extends = '') {
        $this->profileurl = ossn_site_url("u/{$this->username}") . $extends;
        return ossn_call_hook('user', 'profile:url', $this, $this->profileurl);
    }

    /**
     * Send user reset password link
     *
     * @return bool;
     */
    public function SendResetLogin() {
        self::initAttributes();
        $this->old_code = $this->getParam('login:reset:code');
        $this->type = 'user';
        $this->subtype = 'login:reset:code';
        $this->owner_guid = $this->guid;
        if (!isset($this->{'login:reset:code'}) && empty($this->old_code)) {
            $this->value = md5(time() . $this->guid);
            $this->add();
        } else {
            $this->value = md5(time() . $this->guid);
            $this->data->{'login:reset:code'} = $this->value;
            $this->save();
        }
        $emailreset_url = ossn_site_url("resetlogin?user={$this->username}&c={$this->value}");
        $emailreset_url = ossn_call_hook('user', 'reset:login:url', $this, $emailreset_url);
        $sitename = ossn_site_settings('site_name');

        $emailmessage = ossn_print('ossn:reset:password:body', array(
            $this->first_name,
            $emailreset_url,
            $sitename
        ));
        $emailsubject = ossn_print('ossn:reset:password:subject');
        if (!empty($this->value) && $this->notify->NotifiyUser($this->email, $emailsubject, $emailmessage)) {
            return true;
        }
        return false;
    }

    /**
     * Reset user password
     *
     * @return bool;
     */
    public function resetPassword($password) {
        self::initAttributes();
        if (!empty($password)) {
            $this->salt = $this->generateSalt();
            $password = $this->generate_password($password, $this->salt);
            $reset['table'] = 'ossn_users';
            $reset['names'] = array(
                'password',
                'salt'
            );
            $reset['values'] = array(
                $password,
                $this->salt
            );
            $reset['wheres'] = array("guid='{$this->guid}'");
            if ($this->OssnDatabase->update($reset)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Remove user reset code
     *
     * @return bool;
     */
    public function deleteResetCode() {
        $this->type = 'user';
        $this->subtype = 'login:reset:code';
        $this->owner_guid = $this->guid;
        $code = $this->get_entities();
        if ($this->deleteEntity($code[0]->guid)) {
            return true;
        }
        return false;
    }

    /**
     * Check if user is online or not
     *
     * @return bool;
     */
    public function isOnline($intervals = 100) {
        if (isset($this->last_activity)) {
            $time = time();
            if ($this->last_activity > $time - $intervals) {
                return true;
            }
        }
        return false;
    }

    /**
     * Delete user from syste,
     *
     * @return bool;
     */
    public function deleteUser() {
        self::initAttributes();
        if (!empty($this->guid) && !empty($this->username)) {
            $params['from'] = 'ossn_users';
            $params['wheres'] = array("guid='{$this->guid}'");
            if ($this->OssnDatabase->delete($params)) {
                //delete user files
                $datadir = ossn_get_userdata("user/{$this->guid}/");;
                if (is_dir($datadir)) {
                    OssnFile::DeleteDir($datadir);
                    //From of v2.0 DeleteDir delete directory also #138
                    //rmdir($datadir);
                }
                //delete user entites also
                $this->deleteByOwnerGuid($this->guid, 'user');

                //delete annotations
                $this->OssnAnnotation->owner_guid = $this->guid;
                $this->OssnAnnotation->deleteAnnotationByOwner($this->guid);
                //trigger callback so other components can be notified when user deleted.

                //should delete relationships
                ossn_delete_user_relations($this);

                $vars['entity'] = $this;
                ossn_trigger_callback('user', 'delete', $vars);
                return true;
            }
        }
        return false;
    }
	/**
	 * Check if user is validated or not
	 * 
	 * @return bool
	 */
	public function isUserVALIDATED(){
		if(isset($this->activation) && empty($this->activation)){
			return true;
		}
		return false;
	}
	/**
	 * Resend validation email to user
	 *
	 * @return bool
	 */
	public function resendValidationEmail(){
		self::initAttributes();
		if(!$this->isUserVALIDATED()){
			$link = ossn_site_url("uservalidate/activate/{$this->guid}/{$this->activation}");
			$link = ossn_call_hook('user', 'validation:email:url', $this, $link);
			$sitename = ossn_site_settings('site_name');
			$activation = ossn_print('ossn:add:user:mail:body', array(
                        $sitename,
                        $link,
                        ossn_site_url()
                    ));
			$subject = ossn_print('ossn:add:user:mail:subject', array(
                        $this->first_name,
                        $sitename
                    ));
			return $this->notify->NotifiyUser($this->email, $subject, $activation);
		}
		return false;
	}
	/**
	 * Get list of unvalidated users
	 *
	 * @return false|object
	 */	
	public function getUnvalidatedUSERS(){
		$params = array();
		$params['from'] = 'ossn_users';
		$params['wheres'] = array("activation <> ''");
		$users = $this->select($params, true);
		if($users){
			return $users;
		}
		return false;
	}
}//CLASS
