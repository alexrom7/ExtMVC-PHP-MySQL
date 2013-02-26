<?php
/**
 * Model definition file
 *
 * In this file I define the class for the parent model
 * @version 0.1
 */

/**
 * The class definition for the "Model" Object
 *
 * This class manages the basic queries, getters, setters, and
 * default functionality for any model
 * @package Core
 */
 class Model {

    var $name = '';
    var $idField = '';             //Id field for the model
    var $table = '';                //The name of the entity table
    var $fields = array();      //This contains the field names for the database entity

    /**
     * Model initializer that prepares the database adapter for 
     * later usage
     */
    public function __construct() {
            $this->adapter = $this->getCurrentAdapter();
    }
    
    /**
     * Gets the adapter for de model
     * @return type 
     */
    public function getCurrentAdapter(){
            return MySQLAdapter::singleton();
    }
    
    /**
     * php Magic method that gets all the method calls to this class and 
     * evaluates them (defines the getters and setters)
     * @param string $method The method name
     * @param string $args The method call arguments
     * @return value If is a getter 
     */
    public function __call($method, $args) {
            preg_match('/(get|set)([a-zA-Z_]+)/', $method, $matches);
            if($matches[1]=='get')
                return $this->getVariable(strtolower($matches[2]));
            if($matches[1]=='set')
                return $this->setVariable(strtolower ($matches[2]), $args[0]);
    }
    
    /**
     * Getter for any variable of the object
     * @param string $name The name of the variable
     * @return value Of the array 
     */
    protected function getVariable($name){
            return in_array($name, $this->fields)?$this->$name:'undefined';
    }

    /**
     * Setter for any variable of the object
     * @param string $name Variable name
     * @param value $value The value to set
     */
    public  function setVariable($name, $value){
            if(in_array($name, $this->fields))
                $this->$name = $value;
            else
                echo 'variable [' . $name . '] doesn\'t exist. ';
    }
    
    /**
     * Generic get for a database data
     * @param int $id The id to find in the database
     * @param bool $asObject (optional) true returns an object, false returns an array
     * @return object or array 
     */
    public function get($id, $asArray=false) {

        $where = $this->idField . " = '". $id ."'";
        $numRows = $this->adapter->select($this->table, $where, '*', null, 1, null);

         if ($numRows > 0) {
            $record = $this->adapter->fetch();
            $entity = new $this->name;
            $recordVars = get_object_vars($record);
            foreach ($recordVars as $key => $value){
                if(in_array($key, $this->fields))
                    $entity->$key = $value;
            }
        }
        return $asArray?$entity->toArray():$entity;
    }
    
    /**
     * Finds all the objects from the database
     * @param type $conditions this param lets you 
     * @param type $limit
     * @param type $asArray
     * @return type 
     */
    public function getAll($conditions=null, $limit = 1000, $offset = null, $orderBy = null, $asArray=false) {
        
        $orderBy = (isset($orderBy)) ? (' ORDER BY '.$orderBy) : null;
        
        if ($conditions) {
            foreach($conditions as $key => $value){
                if ($where) $where .= " AND ".$key."='".$value."'";
                else $where = $key."='".$value."'";
            }
            
            $where .= $orderBy;
        }
       
        else $where = '';
        $this->adapter->select($this->table, $where, '*', null, $limit, $offset);
        $entities = array();
        while ($record = $this->adapter->fetch()) {
            $entity = new $this->name;
            $recordVars = get_object_vars($record);
            foreach ($recordVars as $key => $value){
                if(in_array($key, $this->fields))
                    $entity->$key = $value;
            }
            $entities[] = $asArray?$entity->toArray():$entity;
        }
        return $entities;
    }
    
    /**
     * Gets the number of registers
     * that this class has
     * @return int count
     */
    public function count($where = '') {  
        $select = 'count(*) as total';
        //Invoke query setting ($table, $where = '', $fields = '*', $order = '', $limit = null, $offset = null)
        $this->adapter->select($this->table,$where,$select,null,'',null);
        $result =  $this->adapter->fetch();
        return $result->total;
    }
    
    /**
     * Inserts a new object in the database given the attributes 
     * that this class has
     * @return int The inserted Id 
     */
    public function create($data) {

        $insertedId = $this->adapter->insert($this->table, $data);
        $this->{$this->idField}=$insertedId;
        return $insertedId;
    }
    
    /**
     * Save changes to current Conversation
     * @return int Number of rows affected
     */
    public function update(){
        $where = $this->idField . " = '" . $this->{$this->idField} . "'";
        return $this->adapter->update($this->table,  $this->toArray() ,$where);
    } 
    
    /**
     * Deletes the object from the database
     * @return int Affected rows
     */
    public function delete(){
        $where = $this->idField . " = '" . $this->{$this->idField} . "'";
        return $this->adapter->delete($this->table, $where);
    }
    
    /**
     * Converts the model object to an array
     * @return array 
     */
    public  function toArray(){
        $auxObject = array();
        foreach ($this->fields as $field){
            $auxObject[$field] = $this->$field;
        }
        return $auxObject;
    }
}

?>