<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of html
 *
 * @author senor
 */

require_once(ABSPATH . "/Loader.php");
class Core_Template_html{
    //html
    /*static $attributes;
    private static $tag;
    private static $tag_error;*/
    //private static $attributes;
    
    var $type = false;
    var $name = false;
    var $value = false;
    var $size = false;    
    var $class = false;
    var $text = false;
    var $href = false;
    var $rel = false;
    var $style = false;
    var $action = false;
    var $method  = false;
    var $title = false;
    
    var $onclick = false;


    private function text($text){
        
    }
    //
    /*private $element;
    private $object;
    private $attr = false;    
    private $output = false;*/

    /*function setAttrs(){
        //print_r($this->attrs);
        $properties = get_class_vars(get_class($this));        
        foreach($properties as $property => $value){
            if($value){
               if(!array_key_exists($property, $this->attrs)){
                   echo "ERROR falta una propiedad requerida";
                   return false;
               }
            }
        }
        foreach($this->attrs as $attr => $value){            
            if(property_exists($this, $attr)){
                if($attr != "text"){
                $attrs .= " " . $attr . "=" . "\"$value\"";
                }else{
                    $this->object->text = $value;
                }
            }
            
        }
        unset($this->attrs);
        return $attrs;
    }*/
    //eliminar
    /*function br(){
        return $this->build();
    }

    public static function a(){
        return $this->build();
    }

    function input(){
        return $this->build();
        /*$element = new Core_Html_Input();
        return $this->build();*/
    /*}

    function link(){        
        return $this->build();
    }

    function span(){
        //echo "SI";
        return $this->build();
    }*/

    
    /*
    public static function render(){
        //self::$tag = ucfirst($tag);        
        $tag = self::build_tag();        
        if($tag){            
            return $tag;
        }else{            
            return false;
        }

    }*/
    /*
    public static function render($element){
        ///echo $element;
        $this->element = $element;
        $object = 'Core_Html_'.ucfirst($element);
        Loader::loadClass($object);
        $this->object = new $object();
        //echo $this->object;
        return $this->$element();

        //return $this->$element();
        /*$element = new $element();
        if($attrs){
            foreach(explode(" ",$attrs) as $attr){
                $attrmeta = explode("=",$attr);
                if(property_exists($element, $attrmeta[0])){
                    //$this->output .= " {$attrmeta[0]}={$attrmeta[1]} ";
                    $this->attrs .= $attrmeta[0].'='.$attrmeta[1].' ';
                }
            }
        }*/
        
    //}
}
?>
