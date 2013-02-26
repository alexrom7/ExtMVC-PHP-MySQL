<?php
/**
 * Database Adapter Interface
 * 
 * Interface Adapter for all connections
 * @author Giancarlo Sanchez
 * @version 1.0
 */

/**
 * Database interface adapter connection
 * @package Assets
 * @subpackage Database
 */
interface DbAdapterInterface {

    public function connect();

    public function disconnect();  

    public function query($query);

    public function fetch();  

    public function select($table, $where = '', $fields = '*', $order = '', $limit = null, $offset = null);

    public function insert($table, array $data);

    public function update($table, array $data, $where = '');

    public function delete($table, $where = '');

    public function getInsertId();

    public function countRows();

    public function getAffectedRows();

    public function SetDbOnDemand($name);
} 
?>