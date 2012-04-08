<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
require(ABSPATH."/Loader.php");
Loader::loadClass("Core_Controller");
$controller = new Core_Controller();
$controller->control();*/
//$core->run();
require("Config.php");
require(ABSPATH."/Core.php");
$template = Core::request();
if($template){   
    Core::render($template);
}

?>
