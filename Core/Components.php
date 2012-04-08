<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Component
 *
 * @author senor
 */
require_once ABSPATH.'/Core.php';
class Core_Components {
    //put your code here    
    var $path;

    public function  __construct() {
        //parent::__construct();
        //echo "Componente" . $this->welcome;
        //
        //echo Core::$Access->welcome;
        $this->path = Core::$path;
    }
}
?>
