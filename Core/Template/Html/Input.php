<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of input
 *
 * @author senor
 */
require_once(ABSPATH."/Core/Template/Html.php");
class Core_Html_Input extends Core_Template_Html{
    //put your code here    
    var $name = true;
    var $type = true;
    var $close = false;
    //var $attrs = array("type" => "javier");

    /*function build($attrs){
        $this->attrs = $attrs;
        $attrs = $this->setAttrs();
        if($attrs){
            $this->output = "<input ";
            $this->output .= $attrs;
            $this->output .= "/>";
            return $this->output;
            //return "<input type=\"$this->type\" name=\"$this->name\" value=\"$this->value\" />";
        }else{
            echo "IMPOSIBLE CREAR EL INPUT";
        }
    }*/

}
?>
