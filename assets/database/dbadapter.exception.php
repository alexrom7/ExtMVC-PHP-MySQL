<?php
/**
 * Database Adapter Exception Class
 * 
 * Database Adapter Exception Class for all connections
 * @author Giancarlo Sanchez
 * @version 1.0
 */

/**
 * Exception Class for database connections
 * @package Assets
 * @subpackage Database
 */
class DbAdapterException extends Exception
{
    public function __construct($message, $code) {

        // make sure everything is assigned properly
        parent::__construct($message, $code);
    }

    // custom string representation of object
    public function getFullDescription() {
        
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
?>