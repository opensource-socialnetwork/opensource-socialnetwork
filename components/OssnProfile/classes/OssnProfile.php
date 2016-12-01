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
class OssnProfile extends OssnDatabase {
    /**
     * Reposition cover
     *
     * @params $guid: User guid
     *         $top : Position from top
     *         $left: Position from left
     *
     * @return bool;
     */
    public function repositionCOVER($guid, $top, $left) {
        $user = ossn_user_by_guid($guid);
        if (!isset($user->cover_position) && empty($user->cover_position)) {
            $position = array(
                $top,
                $left
            );
            $fields = new OssnEntities;
            $fields->owner_guid = $guid;
            $fields->type = 'user';
            $fields->subtype = 'cover_position';
            $fields->value = json_encode($position);
            if ($fields->add()) {
                return true;
            }
        } else {
            $this->statement("SELECT * FROM ossn_entities WHERE(
				             owner_guid='{$guid}' AND 
				             type='user' AND 
				             subtype='cover_position');");
            $this->execute();
            $entity = $this->fetch();
            $entity_id = $entity->guid;

            $position = array(
                $top,
                $left
            );
            $fields = new OssnEntities;
            $fields->owner_id = $guid;
            $fields->guid = $entity_id;
            $fields->type = 'user';

            $fields->subtype = 'cover_position';
            $fields->value = json_encode($position);
            if ($fields->updateEntity()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Reset cover back to it original position
     *
     * @params $guid: User guid
     *
     * @return bool;
     */
    public function ResetCoverPostition($guid) {
        $this->statement("SELECT * FROM ossn_entities WHERE(
				             owner_guid='{$guid}' AND 
				             type='user' AND 
				             subtype='cover_position');");
        $this->execute();
        $entity = $this->fetch();
        $position = array(
            '',
            ''
        );

        $fields = new OssnEntities;
        $fields->owner_id = $guid;
        $fields->guid = $entity->guid;
        $fields->type = 'user';

        $fields->subtype = 'cover_position';
        $fields->value = json_encode($position);
        if ($fields->updateEntity()) {
            return true;
        }
        return false;
    }

    /**
     * Get cover parameters
     *
     * @params $guid: User guid
     *
     * @return array;
     */
    public function coverParameters($guid) {
        $user = ossn_user_by_guid($guid);
        if (isset($user->cover_position)) {
            $parameters = $user->cover_position;
            return json_decode($parameters);
        }
        return false;
    }
    /**
     * Add a wall post for new profile/cover picture
     *
     * @param int $ownerguid = Guid of owner
	 * @param int $itemguid photo guid
	 * @param string $type profile photo/cover
     *
     * @return bool;
     */	
	public function addPhotoWallPost($ownerguid, $itemguid, $type = 'profile:photo'){
		if(empty($ownerguid) || empty($itemguid)){
			error_log("Empty item/owner guid has been provided for new cover wall post", 0);
			return false;
		}
		$this->wall = new OssnWall;
			
		$this->wall->item_type = $type;
		$this->wall->owner_guid = $ownerguid;
		$this->wall->poster_guid = $ownerguid;
		$this->wall->item_guid = $itemguid;
		
		if($this->wall->Post('null:data')){
			return true;
		}
	}
	/**
	 * Delete profile photo/cover wall post
	 * 
	 * @param int $fileguid Profile/Cover file id
	 * @return bool
	 */
	public function deletePhotoWallPost($fileguid){
		if(empty($fileguid)){
			return false;
		}
		//prepare a query to get post guid
		$statement = "SELECT * FROM ossn_entities, ossn_entities_metadata WHERE(
				  	  ossn_entities_metadata.guid = ossn_entities.guid 
				      AND  ossn_entities.subtype='item_guid'
				      AND  ossn_entities.type = 'object'
				      AND ossn_entities_metadata.value = '{$fileguid}'
				      );";	
		
		$this->statement($statement);
		$this->execute();
		$entity = $this->fetch();
		
		//check if post exists or not
		if($entity){
			//get object
			$object = ossn_get_object($entity->owner_guid);
			if($object && $object->subtype == 'wall'){
				$wall = new OssnWall;
				//delete wall post
				if($wall->deletePost($object->guid)){
					return true;
				}
			}
		}
		return false;
	}
	/**
	 * Get cover URL
	 *
	 * @param object $user OssnUser object
	 *
	 * @return string|boolean
	 */
	public function getCoverURL($user = ''){
		if(!empty($user) && $user instanceof OssnUser){
			if(!isset($user->cover_time) && empty($user->cover_time)){
				$user->cover_time = time();
				$user->data->cover_time = $user->cover_time;
				$user->save();
			}
			return ossn_site_url("cover/{$user->username}/".md5($user->cover_time).'.jpg');
		}
		return false;
	}
}//class
