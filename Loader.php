<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loader
 *
 * @author senor
 */
class Loader{
    //put your code here
    //var $include_path;
    
    public static function loadClass($file, $dirs = null){
        if (class_exists($file, false)) {            
            return true;
        }        
        $file = str_replace('_', DIRECTORY_SEPARATOR, $file) . '.php';
        if($dirs){
            if(is_string($dirs)){
                //echo $file = $dirs . PATH_SEPARATOR . $file;
            }
        }else{
           $file = ABSPATH . DIRECTORY_SEPARATOR . $file;
        }        
        if(self::loadFile($file)){
            return true;
        }
    }    

    public static function loadFile($file,$dir = null, $once = false){        
        if(!is_file($file)) return false;
        if($once){
            return require_once($file);
        }else{
            return require($file);
        }        
    }

}
?>