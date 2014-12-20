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
class OssnObject extends OssnEntities {

    /**
     * Initialize the objects.
     *
     * @return void;
     */
    public function initAttributes() {
        $this->OssnDatabase = new OssnDatabase;
        $this->time_created = time();
        if (empty($this->subtype)) {
            $this->subtype = NULL;
        }
        if (empty($this->order_by)) {
            $this->order_by = '';
        }
    }
	
    /**
     * Create object;
     *
     * @requires : (object)->(owner_guid, type, subtype, title, description)
     *
     * @return bool;
     */
    public function addObject() {
        self::initAttributes();
        $params['into'] = 'ossn_object';
        $params['names'] = array(
            'owner_guid',
            'type',
            'subtype',
            'time_created',
            'title',
            'description'
        );
        $params['values'] = array(
            $this->owner_guid,
            $this->type,
            $this->subtype,
            $this->time_created,
            $this->title,
            $this->description
        );
        if ($this->OssnDatabase->insert($params)) {
            $this->createdObject = $this->OssnDatabase->getLastEntry();
            if (isset($this->data) && is_object($this->data)) {
                foreach ($this->data as $name => $value) {
                    $this->owner_guid = $this->OssnDatabase->getLastEntry();
                    $this->type = 'object';
                    $this->subtype = $name;
                    $this->value = $value;
                    $this->add();
                }
            }
            return true;
        }
        return false;
    }
    /**
     * Get object by owner guid;
     *
     * @requires : (object)->(owner_guid)
     *             (object)->order_by => to sort the data in a recordset
     *
     * @return (object);
     */
    public function getObjectByOwner() {
        self::initAttributes();
        if (!empty($this->type)) {
            $type = "AND type='{$this->type}'";
        }
        if (!empty($this->subtype)) {
            $subtype = "AND subtype='{$this->subtype}'";
        }
        $params['from'] = 'ossn_object';
        $params['wheres'] = array("owner_guid='{$this->owner_guid}' {$type} {$subtype}");
        $params['order_by'] = $this->order_by;
        $objects = $this->OssnDatabase->select($params, true);
        if ($objects) {
            foreach ($objects as $object) {
                $this->owner_guid = $object->guid;
                $this->subtype = '';
                $this->type = 'object';
                $this->entities = $this->get_entities();
                foreach ($this->entities as $entity) {
                    $fields[$entity->subtype] = $entity->value;
                }
                if (!empty($fields)) {
                    $data[] = array_merge(get_object_vars($object), $fields);
                    unset($fields);
                } else {
                    $data[] = arrayObject($object, get_class($this));
                }
            }
        }
        if (isset($data) && is_array($data)) {
            return arrayObject($data, get_class($this));
        }
		return false;
    }

    /**
     * Get object by types;
     *
     * @requires : (object)->(type , subtype(optional))
     *             (object)->order_by => to sort the data in a recordset
     *
     * @return (object);
     */
    public function getObjectsByTypes() {
        self::initAttributes();
        if (empty($this->type)) {
            return false;
        }
        if (!empty($this->subtype)) {
            $subtype = "AND subtype='{$this->subtype}'";
        }
        $params['from'] = 'ossn_object';
        $params['wheres'] = array("type='{$this->type}' {$subtype}");
        $params['order_by'] = $this->order_by;
        $objects = $this->OssnDatabase->select($params, true);
        if ($objects) {
            foreach ($objects as $object) {
                $this->owner_guid = $object->guid;
                $this->subtype = '';
                $this->type = 'object';
                $this->entities = $this->get_entities();
                if ($this->entities) {
                    foreach ($this->entities as $entity) {
                        $fields[$entity->subtype] = $entity->value;
                    }
                }
                if (!empty($fields)) {
                    $data[] = array_merge(get_object_vars($object), $fields);
                    unset($fields);
                } else {
                    $data[] = arrayObject($object, get_class($this));
                }
            } //end of loop
        	if (isset($data) && is_array($data)) {
            	return arrayObject($data, get_class($this));
        	}			
        }//end of  if ($objects)
		return false;
    }

    /**
     * Get object by object guid;
     *
     * @requires : (object)->(object_guid)
     *
     * @return (object);
     */
    public function getObjectById() {
        self::initAttributes();
        if (empty($this->object_guid)) {
            return false;
        }
        $params['from'] = 'ossn_object';
        $params['wheres'] = array("guid='{$this->object_guid}'");
        $params['order_by'] = $this->order_by;
        $object = $this->OssnDatabase->select($params);

        $this->owner_guid = $object->guid;
        $this->subtype = '';
        $this->type = 'object';
        $this->entities = $this->get_entities();
		
        if ($this->entities) {
            foreach ($this->entities as $entity) {
                $fields[$entity->subtype] = $entity->value;
            }
        	$data = array_merge(get_object_vars($object), $fields);
        	if (!empty($fields)) {
				return arrayObject($data, get_class($this));
        	} else {
				return arrayObject($object, get_class($this));
       		 }			
        }
		return false;
    }

    /**
     * Get newly created object
     *
     * @return (int);
     */
    public function getObjectId() {
        if (isset($this->createdObject)) {
            return $this->createdObject;
        }
    }

    /**
     * Update Object;
     *
     * @params = $name => array(column names)
     *           $values => array(new values)
     *           $guid => object_guid
     *           (object)->data->object(update object entities)
     *
     * @return bool;
     */
    public function updateObject($name, $value, $guid) {
        self::initAttributes();
        $params['table'] = 'ossn_object';
        $params['names'] = $name;
        $params['values'] = $value;
        $params['wheres'] = array("guid='{$guid}'");
        if ($this->OssnDatabase->update($params)) {
            if (isset($this->data)) {
                $this->owner_guid = $guid;
                $this->type = 'object';
                $this->save();
            }
            return true;
        }
        return false;
    }

    /**
     * Delete object;
     *
     * @params = $object => object guid
     *
     * @return bool;
     */
    public function deleteObject($object) {
	  if(isset($this->guid)){
		 $object = $this->guid; 
	  }
      //delete entites of (this) object
      if ($this->deleteByOwnerGuid($object, 'object')) {
            $data = ossn_get_userdata("object/{$object}/");
            if (is_dir($data)) {
                OssnFile::DeleteDir($data);
                // As of v2.0 DeleteDir delete directory also
                //rmdir($data);
            }
		}
		$delete['from'] = 'ossn_object';
		$delete['wheres'] = array("guid='{$object}'");
		if($this->OssnDatabase->delete($delete)){
            return true;
        }
        return false;
    }
}
