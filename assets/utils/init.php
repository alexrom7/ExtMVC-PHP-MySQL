<?php

    /**
     * Init
     *
     * Includes all classes
     * @version 1.0
     * @package Assets
     * @subpackage Init
     */

     /**
      * Includes
      */
    //Config
    require_once dirname(__FILE__).'/../../assets/config/configuration.php';

    //Adapters
    require_once dirname(__FILE__).'/../../assets/database/dbadapter.interface.php';
    require_once dirname(__FILE__).'/../../assets/database/mysql.adapter.php';
    require_once dirname(__FILE__).'/../../assets/database/dbadapter.exception.php';

    //Models
    require_once dirname(__FILE__).'/../../model/Model.php';
    require_once dirname(__FILE__).'/../../model/contact.model.php';
    
    //Utils
    require_once dirname(__FILE__).'/../../assets/utils/log.php';
?>