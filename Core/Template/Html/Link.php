<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Link
 *
 * @author senor
 */
require_once(ABSPATH."/Core/Template/Html.php");
class Core_Template_Html_Link extends Core_Template_Html{
    //put your code here
    var $rel = true;
    var $type = true;
    var $href = true;
    var $close = false;
}
?>
