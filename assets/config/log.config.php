<?php
/**
 * Log configuration class
 * 
 * Manages the configuration parameters for log
 * @version 1.0
 */

/**
 * Manages log application configuration parameters
 * @package Assets
 * @subpackage Config
 */
class LogConfig {
    
    //Local variable for extjs sample log, print everything
    private static $_local = array(
        'fileName' => 'extjs_sample_log.html',
        'logLevel' => 'TRACE'
    );
    
    //Dev variable for extjs sample log, print debug, info, errors and warnings
    private static $_development = array(
        'fileName' => 'extjs_sample_log.html',
        'logLevel' => 'DEBUG'
    );
    
    //QA variable for extjs sample log, print info, errors and warnings     
    private static $_qa = array(
        'fileName' => 'extjs_sample_log.html',
        'logLevel' => 'INFO'
    );
    
    //Production variable for extjs sample log, print errors and warnings 
    private static $_production = array(
        'fileName' => 'extjs_sample_log.html',
        'logLevel' => 'WARN'
    );

    /**
     * Returns log configuration given an environment
     * @param int $environment  Environment type
     * @return array    Log configuration
     */
    public static function get($environment){
        
       $path = dirname(__FILE__) . '/../../logs/';
       $fileName = null;
       $level = null;
       
        switch ($environment){
            case 0:
                $fileName = self::$_local['fileName'];
                $level = self::$_local['logLevel'];
                break;
            case 1:
                $fileName = self::$_development['fileName'];
                $level = self::$_development['logLevel'];
                break;
            case 2:
                $fileName = self::$_qa['fileName'];
                $level = self::$_qa['logLevel'];
                break;
            case 3:
                $fileName = self::$_production['fileName'];
                $level = self::$_production['logLevel'];
                break;
            default:
                $fileName = self::$_local['fileName'];
                $level = self::$_local['logLevel'];
                break;         
        }

       $path .= $fileName;      
       
       return self::buildConfiguration($path, $level);

    }
    
    /**
     * Buils the log configuration object given a log full path and level of details
     * @param string $path  Full path of log file
     * @param string $level Level of detail to display
     * @return array    Log configuration array 
     */
     private static function buildConfiguration($path,$level){
         
        return array(
                'rootLogger' => array(
                    'appenders' => array('default'),
                    'level' => $level
                ),
                'appenders' => array(
                    'default' => array(
                        'class' => 'LoggerAppenderFile',
                        'layout' => array(
                            'class' => 'LoggerLayoutHtml',
                            'locationInfo' => true
                        ),
                     'params' => array(
                            'file' => $path,
                            'append' => true
                        )
                    )
                )
            );
     }
}

?>