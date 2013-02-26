<?php

/**
 * Log class for conversation manager applciation
 * 
 * Manages Logs
 * @author Giancarlo Sanchez
 * @version 1.0
 */
include(dirname(__FILE__).'/../../shared/log4php/Logger.php');
/**
 * Manages CRUD and formatting operations related to Conversation_Group entity
 * @package Utils
 * @subpackage Log
 */
class Log {
    
    public static $TRACE = 0;
    public static $DEBUG = 1;
    public static $INFO  = 2;
    public static $WARN  = 3;
    public static $ERROR = 4;
    
    private $_log;
    private static $_instance;      //Instance singleton
    
    private function __construct() {
        // Tell log4php to use our configuration file.
        Logger::configure(Configuration::getLog());
        $this->_log = Logger::getLogger('Training');
    }
    
    /**
     * Manages the class singleton instantiation and access
     * @return Log instance singleton 
     */
    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c;
        }

        return self::$_instance;
    }
    
    /**
     * Singleton validation method
     */
    public function __clone()
    {
        trigger_error('Clone not allowed.', E_USER_ERROR);
    } 
    
    /**
     * Writes to conversation manager 3.0 log file
     * @param int $type
     * @param string $class
     * @param string $method
     * @param message $message 
     */
    public function put($type, $class, $method, $message){
        
        $msg = $class." ".$method." ".$message;
        
        switch ($type){
            case 0:
                $this->_log->trace($msg);
                break;
            case 1:
                $this->_log->debug($msg);
                break;
            case 2:
                $this->_log->info($msg);
                break;
            case 3:
                $this->_log->warn($msg);
                break;
            case 4:
                $this->_log->error($msg);
                break;
            default:
                $this->_log->trace($msg);
                break;         
        } 
    }
}

?>