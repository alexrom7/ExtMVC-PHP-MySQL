<?php
/**
 * ExtjsMVC Example Configuration Class
 * 
 * Manages the configuration parameters for the application
 */

include(dirname(__FILE__).'/../../shared/config/environment.php');
include(dirname(__FILE__).'/database.config.php');
include(dirname(__FILE__).'/log.config.php');

/**
 * Manages application configuration parameters
 * @package Assets
 * @subpackage Config
 */

class Configuration {
    
    /**
     * Obtains database configuration parameters
     * @return array
     */
    public static function getDatabase(){
        return Database::get(Environment::$environment);
    }
    
    /**
     * Obtains log configuration parameters
     * @return array
     */
    public static function getLog(){
        return LogConfig::get(Environment::$environment);
    }
    

}

?>