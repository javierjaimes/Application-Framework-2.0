<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template
 *
 * @author senor
 */
require_once(ABSPATH."/Loader.php");
Loader::loadClass("Core_Template_Html");
class Core_Template{

    //variables del template
    var $directory;

    //etiquetas html soportadas
    public static $token = null;
    
    private $tags = array(
        "br" => false,
        "form" => false,
        "a" => false
    );

    private $functions = array(
        "if" => false,
        "foreach" => false
    );

    
    /*var $br;
    var $form;
    var $a;*/

    
    //var $html;
    //var $attrs;
    //var $replace_elements = array("¿","!","?");

    function __construct(){
        //echo "TEMPLATE";
        $this->dir = ABSPATH . "/template";


        //reglas de parse para los elementos html
        while (list($tag_name,$tag_value) = each($this->tags)) {
            //echo $tag_name;
            if(!Loader::loadClass('Core_Template_Html_'.ucfirst($tag_name))){
                $this->tags[$tag_name] = false;
                break;
            }else{
                //$tag_key_class = 'Core_Template_Html_'.ucfirst($tag_key);
                $tag_rule = "<tpl:" . $tag_name;

                $tag_attributes = get_class_vars('Core_Template_Html_'.ucfirst($tag_name));
                $tag_text = get_class_methods('Core_Template_Html_'.ucfirst($tag_name));
                
                $tag_attributes_required = array_keys($tag_attributes, 1);
                $tag_attributes_opcional = array_keys($tag_attributes, 2, true);
                
                $tag_attributes_required_number = count($tag_attributes_required);
                $tag_attributes_required = implode("|",$tag_attributes_required);

                $tag_attributes_opcional_number = count($tag_attributes_opcional);
                $tag_attributes_opcional = implode("|",$tag_attributes_opcional);

                $i = 0;
                while ($i < $tag_attributes_required_number) {
                    $tag_rule .= "\s(?:$tag_attributes_required)=\\\"[^\\\"]*\\\"";
                    $i++;
                }

                $j = 0;
                while ($j < $tag_attributes_opcional_number){
                    $tag_rule .= "(?:\s(?:$tag_attributes_opcional)=\\\"[^\\\"]\\\")?";
                    $j++;
                }
                                
                if($tag_text[0] == "text"){
                    $tag_rule .= ">.*<\/tpl:$tag_name>";
                }else{
                    $tag_rule .= " \/>";
                }
                //echo $tag_name;
                self::$token[$tag_name] = $tag_rule;
                
                //$this->$tag_key = new $tag_key_class();

            }
           // print_r(self::$token);
            //echo "Key: $tag_key; Value: $tag_value<br />\n";
        }

        //self::$token = $token;
        //echo $this->token;

        //print_r($this->tags);

    }
    

    public function variable(){
        $tag_attributes_required = array("name");

        foreach($tag_attributes_required as $tag_attribute_required_name){
            if(!array_key_exists($tag_attribute_required_name, self::$tag_attributes)){
                return false;
            }
        }
        
        /*if(preg_match("/name/", $arguments)){
            $arguments = preg_replace("/\&$/","",$arguments);
        }else{
            return false;
        }
        
        foreach(explode("&", $arguments) as $argument){
            
            list($argument_name, $argument_value) = explode("=",$argument);
        }*/
        //print_r(self::$tag_attributes);
        $variable = self::$tag_attributes['name'];
        //self::$tag_attributes = null;
        if(!property_exists($this, $variable)){            
            return $this->errorTag("La Variable solicitada no existe");
        }else{
            return $this->$variable;
        }
    }

    //ELIMINAR
    /*function titlepage(){
        return $this->name;
    }

    function url(){
        return $this->urlbase;
    }

    function urltheme(){
        return $this->urltheme;
    }*/

    function header(){        
        //echo "javier";
        return $this->includefile("header.tpl");
    }

    function Footer(){        
        return $this->includeFile("footer.tpl");
    }

    function includefile($href){        
        return $this->loadTemplate(file_get_contents($this->dir . "/" .$href),true);
    }

    function errorTag($text){
        //$this->attrs = array("class" => "error","text"=>"Etiqueta desconocida");
        if(!Loader::loadClass("Core_Template_Html_Span")){
            $tag_new = null;
        }else{
            self::$tag = new Core_Template_Html_Span();
            self::$tag_attributes = array("class" => "error");
            self::$tag_text = $text;
            $tag_new = Core_Template_html::render();
        }        
        if($tag_new){            
            return $tag_new;
        }else{
            return "Error creando la Etiqueta";
        }
        //return $this->display("span");
    }

    function setVar($name, $value){
        $this->$name = $value;
    }


    //carga y parseo de template;
    function loadTemplate($template){
        if(preg_match("/\.tpl$/", $template)){
            //echo " SI ";
            $template = file_get_contents($this->dir."/".$template);
        }else{
            $template = $template;
        }
        
        if(Loader::loadClass("Core_Template_Compiler")){
            $compiler = new Core_Template_Compiler();
            return $compiler->parse($template);
        }

               
    }
}
?>