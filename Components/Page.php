<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Page
 *
 * @author senor
 */
//definicion de dependencias por coma
define("includes", "Core_Exceptions");

/*require_once(ABSPATH."/Loader.php");
Loader::loadClass("Core_Components");*/

class Components_Page extends Core_Components {
    //put your code here
    //var $tpl;
    //var $parameters;                    
    

        
    public function start(){        
        //$this->Template->setVar("start","hola mundo");
        //echo self::$conf['urltheme'] . "/" . preg_replace("/^[A-Z].*\::/","",__METHOD__);
        //return true;
        //echo "STARTT  ";
        echo $this->path;
        return true;
    }

    public function register_service(){
        return true;
    }

}
?>