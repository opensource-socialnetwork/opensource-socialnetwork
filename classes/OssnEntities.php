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
class OssnEntities extends OssnDatabase {
    /**
     * Add new entity.
     *
     * @params = $this->type => entity type; (this usually is user, object, annotation, site)
     *           $this->subtype => entity subtype;
     *           $this->entity_permission => OSSN_ACCESS
     *           $this->active = is entity is active or not
     *           $this->value = data you want to insert
     *           $this->owner_guid = entity owner guid
     *
     * @return bool;
     */
    public function add() {
        self::initAttributes();
        if (!empty($this->owner_guid) && in_array($this->type, $this->entity_types)) {
            $this->params['into'] = 'ossn_entities';
            $this->params['names'] = array(
                'owner_guid',
                'type',
                'subtype',
                'time_created',
                'time_updated',
                'permission',
                'active'
            );
            $this->params['values'] = array(
                $this->owner_guid,
                $this->type,
                $this->subtype,
                $this->time_created,
                $this->time_updated,
                $this->permission,
                $this->active
            );
            if ($this->insert($this->params)) {
                $this->params['into'] = 'ossn_entities_metadata';
                $this->params['names'] = array(
                    'guid',
                    'value'
                );
                $this->params['values'] = array(
                    $this->getLastEntry(),
                    $this->value
                );
                $this->insert($this->params);
                return true;
            }
        }
        return false;
    }

    /**
     * Initialize the objects.
     *
     * @return void;
     */
    private function initAttributes() {
        $this->data = new stdClass;
        $this->time_created = time();
        $this->time_updated = '';
        $this->active = 1;

        if (empty($this->permission)) {
            $this->permission = OSSN_PUBLIC;
        }

        $this->types = array(
            'object' => 'OssnObject',
            'user' => 'OssnUser',
            'annotation' => 'OssnAnnotation',
            'entity' => 'OssnEntities',
            'site' => 'OssnSite',
            'component' => 'OssnComponents',
        );

        //generate entity types from $this->types
        foreach ($this->types as $type => $class) {
            $this->entity_types[] = $type;
        }

        if (empty($this->order_by)) {
            $this->order_by = '';
        }
		if (empty($this->limit)){
			$this->limit = '';
		}
        if (empty($this->type)) {
            $this->type = 'entity';
        }
        $this->data = new stdClass;
		$this->annotations = new OssnAnnotation;
    }

    /**
     * Get Entity.
     *
     * @params = $this->entity_guid => entity guid in database;
     *
     * @return (object);
     */
    public function get_entity() {
        self::initAttributes();
		
	$params = array();
	$params['from'] = 'ossn_entities as e';
	$params['params'] = array('e.guid, e.time_created, e.time_updated, e.permission, e.active, e.owner_guid, emd.value, e.type, e.subtype');
	$params['joins'] = "JOIN ossn_entities_metadata as emd ON e.guid=emd.guid";
	$params['wheres'] = array("e.guid ='{$this->entity_guid}'");
		
        $data = $this->select($params);
		if($data){
        	$entity = arrayObject($data, $this->types[$this->type]);
       		return $entity;
		}
    }

    /**
     * Update Entity in database.
     *
     * @required (object)->data
     *
     * @return bool;
     */
    public function save() {
        if (!empty($this->owner_guid)) {
            $this->datavars = $this->get_data_vars();
            // i don't think we need to add new data on save $arsalanshah;
            /*  foreach($this->datavars as $vars => $value){
                  if(!in_array($vars, $this->get_data_dbvars())){
                      $this->subtype = $vars;
                      $this->value = $value;
                      $this->add();
                  }
              }*/
            foreach ($this->get_entities() as $entity) {
                if (isset($this->datavars[$entity->subtype])) {
                    $params['table'] = 'ossn_entities_metadata';
                    $params['names'] = array('value');
                    $params['values'] = array($this->datavars[$entity->subtype]);
                    $params['wheres'] = array("guid='{$entity->guid}'");
                    if ($this->update($params)) {
                        $params['table'] = 'ossn_entities';
                        $params['names'] = array('time_updated');
                        $params['values'] = array(time());
                        $params['wheres'] = array("guid='{$entity->guid}'");
                        $this->update($params);
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get data object.
     *
     * @required (object)->data
     *
     * @return (array);
     */
    private function get_data_vars() {
        if (!$this->data) {
            return false;
        }
        foreach ($this->data as $name => $value) {
            $vars[$name] = $value;
        }
        return $vars;
    }

    /**
     * Get entities.
     *
     * @params = $this->type => entity type;
     *           $this->subtype => entity subtype;
     *           $this->owner_guid => guid of entity owner
     *           $this->order_by =  to sort the data in a recordset
     *
     * @return (object);
     */
    public function get_entities() {
        self::initAttributes();
        if (!empty($this->subtype)) {
            $this->subtype = "AND subtype='{$this->subtype}'";
        } else {
            $this->subtype = '';
        }
	if(isset($this->owner_guid)){
		$this->byowner = "owner_guid ='{$this->owner_guid}' AND";
	}
		
	$params = array();
	$params['from'] = 'ossn_entities as e';
	$params['params'] = array('e.guid, e.time_created, e.time_updated, e.permission, e.active, e.owner_guid, emd.value, e.type, e.subtype');
	$params['joins'] = "JOIN ossn_entities_metadata as emd ON e.guid=emd.guid";
	$params['wheres'] = array("{$this->byowner} type='{$this->type}' {$this->subtype}");
	$params['order_by'] =  $this->order_by;	
	$params['limit'] = $this->limit;
        
	$this->get = $this->select($params, true);
        if ($this->get) {
		foreach($this->get as $entity){
            		$entities[] =  arrayObject($entity, $this->types[$this->type]);
		}
		return $entities;
        }
        return false;
    }

    /**
     * Get newly added entity guid.
     *
     * @return (int);
     */
    public function AddedEntityGuid() {
        return $this->getLastEntry();
    }

    /**
     * Update entity metadata only.
     *
     * @return bool;
     */
    public function updateEntity() {
        if (!empty($this->guid)) {
            
			$params['table'] = 'ossn_entities_metadata';
            $params['names'] = array('value');
            $params['values'] = array($this->value);
            $params['wheres'] = array("guid='{$this->guid}'");			
			
			if ($this->update($params)) {
               	
				$params['table'] = 'ossn_entities';
                $params['names'] = array('time_updated');
                $params['values'] = array(time());
                $params['wheres'] = array("guid='{$this->guid}'");
                
				$this->update($params);
				return true;
			}
        }
	    return false;	
    }

    /**
     * Delete all entities related to owner guid.
     *
     * @params = $guid = Entity guid in database
     *           $type = Entity type
     * @param string $type
     *
     * @todo why not there is subtype?
     * @return (bool);
     */
    public function deleteByOwnerGuid($guid, $type) {

		$params['from'] = 'ossn_entities';
		$params['wheres'] = array("owner_guid='{$guid}' AND type='{$type}'");
		
		$ids = $this->select($params, true);
        if (!$ids) {
            return false;
        }
        foreach ($ids as $entity) {
            $this->deleteEntity($entity->guid);
        }
        return true;
    }

    /**
     * Delete entity.
     *
     * @params = $guid = Entity guid in database
     *
     * @return (bool);
     */
    public function deleteEntity($guid) {
		if(isset($this->guid) && !empty($this->guid) && empty($guid)){
			$guid = $this->guid;
		}
		$params['from'] = 'ossn_entities';
		$params['wheres'] = array("guid = '{$guid}'");
		
        	if ($this->delete($params)) {
			$metadata['from'] = 'ossn_entities_metadata';
			$metadata['wheres'] = array("guid = '{$guid}'");			
            		$this->delete($metadata);
			
			$vars['entity'] = $guid;
            		ossn_trigger_callback('delete', 'entity', $vars);
        	 	return true;
        	}
        	return false;
    }
    /**
     * Get subtypes from entites.
     *
     * @required (object)->data
     *
     * @return (array);
     */
    private function get_data_dbvars() {
        $entities = $this->get_entities();
        if ($entities) {
            foreach ($entities as $entity) {
                $vars[] = $entity->subtype;
            }
            return $vars;
        }
        return false;
    }
}//class
