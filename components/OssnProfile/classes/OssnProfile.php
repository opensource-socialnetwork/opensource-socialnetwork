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

}//class
