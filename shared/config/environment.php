<?php
/**
 * Environmental definition, settings for
 * managing current application environment
 */
class Environment {
    
    //put your code here
    public static $environments = array(
        0 => 'LOCAL',
        1 => 'DEVELOPMENT',
        2 => 'QA',
        3 => 'PRODUCTION'
    );
    
    public static $environment = 0;
}

?>
