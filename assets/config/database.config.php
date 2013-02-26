<?php
/**
 * Database configuration class
 * 
 * Manages the configuration parameters for database
 * @version 1.0
 */

/**
 * Manages database application configuration parameters
 * @package Assets
 * @subpackage Config
 */
class Database {
    
    //Local database configuration
    private static $_local = array(
        'host' => 'localhost',
        'database' => 'extjs_example',
        'user' => 'root',
        'password' => 'root'
    );
    
    //Development database configuration
    private static $_development = array(
        'host' => '',
        'database' => '',
        'user' => '',
        'password' => ''
    );
    
    //QA database configuration
    private static $_qa = array(
        'host' => '',
        'database' => '',
        'user' => '',
        'password' => ''
    );
    
    //Production database configuration
    private static $_production = array(
        'host' => '',
        'database' => '',
        'user' => '',
        'password' => ''
    );
    
    /**
     * Returns database configuration given an environment
     * @param int $environment  Environment type
     * @return array    Database configuration
     */
    public static function get($environment){
        switch ($environment){
            case 0:
                return self::$_local;
                break;
            case 1:
                return self::$_development;
                break;
            case 2:
                return self::$_qa;
                break;
            case 3:
                return self::$_production;
                break;
            default:
                return self::$_local;
                break;         
        }
    }
    
}

?>