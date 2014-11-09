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
class OssnWall extends OssnObject {
    /**
     * Post on wall
     *
     * @params $post: Post text
     *         $friends: Friend guids
     *         $location: Post location
     *         $access: (OSSN_PUBLIC, OSSN_PRIVATE, OSSN_FRIENDS)
     *
     * @return bool;
     */
    public function Post($post, $friends = '', $location = '', $access = '') {
        self::initAttributes();
        if (empty($access)) {
            $access = OSSN_PUBLIC;
        }
        if ($this->owner_guid < 1 || $this->poster_guid < 1 || empty($post)) {
            return false;
        }
        $this->data->poster_guid = $this->poster_guid;
        $this->data->access = $access;
        $this->subtype = 'wall';
        $this->title = '';

        $wallpost['post'] = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
        if (!empty($friends)) {
            $wallpost['friend'] = $friends;
        }
        if (!empty($location)) {
            $wallpost['location'] = $location;
        }
        $this->description = json_encode($wallpost, JSON_UNESCAPED_UNICODE);
        if ($this->addObject()) {
            $this->wallguid = $this->getObjectId();
            if (isset($_FILES['ossn_photo'])) {
                $this->OssnFile->owner_guid = $this->wallguid;
                $this->OssnFile->type = 'object';
                $this->OssnFile->subtype = 'wallphoto';
                $this->OssnFile->setFile('ossn_photo');
                $this->OssnFile->setPath('ossnwall/images/');
                $this->OssnFile->addFile();
            }
            $params['subject_guid'] = $this->wallguid;
            $params['poster_guid'] = $this->poster_guid;
            if (isset($wallpost['friend'])) {
                $params['friends'] = explode(',', $wallpost['friend']);
            }
            ossn_trigger_callback('wall', 'post:created', $params);
            return true;
        }
        return true;
    }

    /**
     * Initialize the objects.
     *
     * @return void;
     */
    public function initAttributes() {
        if (empty($this->type)) {
            $this->type = 'user';
        }
        $this->OssnFile = new OssnFile;
        if (!isset($this->data)) {
            $this->data = new stdClass;
        }
    }

    /**
     * Get posts by owner
     *
     * @params $owner: Owner guid
     *         $type Owner type
     *
     * @return object;
     */
    public function GetPostByOwner($owner, $type = 'user') {
        self::initAttributes();
        $this->type = $type;
        $this->subtype = 'wall';
        $this->owner_guid = $owner;
        $this->order_by = 'guid DESC';
        return $this->getObjectByOwner();
    }

    /**
     * Get user posts
     *
     * @params $user: User guid
     *
     * @return object;
     */
    public function GetUserPosts($user) {
        $this->type = "user";
        $this->subtype = 'wall';
        $this->owner_guid = $user;
        $this->order_by = 'guid DESC';
        return $this->getObjectByOwner();
    }

    /**
     * Get post by guid
     *
     * @params $guid: Post guid
     *
     * @return object;
     */
    public function GetPost($guid) {
        $this->object_guid = $guid;
        return $this->getObjectById();
    }

    /**
     * Delete post
     *
     * @params $post: Post guid
     *
     * @return bool;
     */
    public function deletePost($post) {
        if ($this->deleteObject($post)) {
            ossn_trigger_callback('post', 'delete', $post);
            return true;
        }
        return false;
    }

    /**
     * Delete All Posts
     *
     * @return void;
     */
    public function deleteAllPosts() {
        $posts = $this->GetPosts();
        if (!$posts) {
            return false;
        }
        foreach ($posts as $post) {
            $this->deleteObject($post->guid);
            ossn_trigger_callback('post', 'delete', $post->guid);
        }
    }

    /**
     * Get all site wall posts
     *
     * @return object;
     */
    public function GetPosts() {
        self::initAttributes();
        $this->subtype = 'wall';
        $this->order_by = 'guid DESC';
        return $this->getObjectsByTypes();
    }
    /**
     * Get user group posts guids
     *
	 * @param (int) $userguid Guid of user
	 *
     * @return array;
     */	
	public static function getUserGroupPostsGuids($userguid){
		if(empty($userguid)){
			return false;
		}
		$statement = "SELECT * FROM ossn_entities, ossn_entities_metadata WHERE(
				  ossn_entities_metadata.guid = ossn_entities.guid 
				  AND  ossn_entities.subtype='poster_guid'
				  AND type = 'object'
				  AND value = '{$userguid}'
				  );";
		$database = new OssnDatabase;
		$database->statement($statement);
		$database->execute();
		$objects = $database->fetch(true);
		if($objects){
			foreach($objects as $object){
				$guids[] = $object->owner_guid;
			}
			asort($guids);
			return $guids;
		}
		return false;
	}

}//class
