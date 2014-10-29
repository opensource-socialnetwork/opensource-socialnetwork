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
     *           $this->entity_premission => OSSN_ACCESS
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
                'premission',
                'active'
            );
            $this->params['values'] = array(
                $this->owner_guid,
                $this->type,
                $this->subtype,
                $this->time_created,
                $this->time_updated,
                $this->premission,
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

        if (empty($this->premission)) {
            $this->premission = OSSN_PUBLIC;
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
        if (empty($this->type)) {
            $this->type = 'entity';
        }
        $this->data = new stdClass;
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
        $this->get = array(
            'from' => 'ossn_entities',
            'wheres' => array("guid ='{$this->entity_guid}'"),
            'order_by' => $this->order_by
        );
        $this->get = $this->select($this->get);
        $metadata = $this->select(array(
            'from' => 'ossn_entities_metadata',
            'wheres' => array("guid='{$this->get->guid}'"),
        ));
        unset($metadata->id);
        $data = array_merge(get_object_vars($this->get), get_object_vars($metadata));
        $entity = arrayObject($data, $this->types[$this->type]);
        return $entity;
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
        $this->get = array(
            'from' => 'ossn_entities',
            'wheres' => array("owner_guid ='{$this->owner_guid}' AND type='{$this->type}' {$this->subtype}"),
            'order_by' => $this->order_by
        );
        $this->get = $this->select($this->get, true);
        if ($this->get) {
            foreach ($this->get as $entites) {
                $metadata = $this->select(array(
                    'from' => 'ossn_entities_metadata',
                    'wheres' => array("guid='{$entites->guid}'"),
                ));
                unset($metadata->id);
                $data = array_merge(get_object_vars($entites), get_object_vars($metadata));
                $entity[] = arrayObject($data, $this->types[$this->type]);
            }
            return $entity;
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
            $this->statement("UPDATE ossn_entities_metadata SET
						  value='{$this->value}' WHERE(guid='{$this->guid}')");
            if ($this->execute()) {
                return true;
            }
            return false;
        }
    }

    /**
     * Delete all entities related to owner guid.
     *
     * @params = $guid = Entity guid in database
     *           $type = Entity type
     *
     * @todo why not there is subtype?
     * @return (bool);
     */
    public function deleteByOwnerGuid($guid, $type) {
        $this->statement("SELECT * FROM ossn_entities
					 WHERE(owner_guid='{$guid}' AND type='{$type}');");
        $this->execute();
        $ids = $this->fetch(true);
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
        $this->statement("DELETE FROM ossn_entities WHERE(guid='{$guid}');");
        if ($this->execute()) {
            $this->statement("DELETE FROM ossn_entities_metadata WHERE(guid='{$guid}');");
            $this->execute();
            $params['entity'] = $guid;
            ossn_trigger_callback('delete', 'entity', $params);
            return true;
        }
        return false;
    }

    /**
     * Get a parameter from object
     *
     * @params = parameter
     *
     * @return string;
     */
    public function getParam($param) {
        if (isset($this->$param)) {
            return $this->$param;
        }
        return false;
    }

    /**
     * Deconstruct Class
     *
     * @return (void);
     */
    public function __destruct() {

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