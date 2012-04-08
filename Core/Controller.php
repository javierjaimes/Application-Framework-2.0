<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author senor
 */
//require_once(ABSPATH."/Core.php");
class Core_Controller{
    var $component_default;
    var $method;
    //put your code here    
    //private $parameters;    
    //var $view;
    public static function  get() {
        //echo "YO";
        //$core = new Core();
        
        if(empty($_GET)){
            Core::$component = "Components_Page";
            Core::$method = "start";
            Core::$url_parameters = null;
        }else{

            //definicion del componente y parseo de variables

            //Core::$url_parameters = ($_GET)? $_SERVER['QUERY_STRING']:null;
            $parameters = ($_GET)? str_replace("|", "-", $_SERVER['QUERY_STRING']):null;
            //echo $parameters = str_replace("_", ".", $parameters);
            if(preg_match("/^[a-zA-Z0-9]*\=.*(&[a-z]*\=[a-z0-9]*)?/", $parameters, $match)){
                //print_r($match);
                if(count($match) > 0){
                    $parameters = explode("&", $parameters);
                    $parameters_component = explode("=",$parameters[0]);

                    $parameters_url = explode("=", $parameters[1]);
                    $parameters_url = explode(",",$parameters_url[1]);

                }else{
                    $parameters_component = explode("=",$match[0]);
                    $parameters_url = null;
                }


                Core::$component = "Components_" . ucfirst($parameters_component[0]);
                Core::$method = $parameters_component[1];
                Core::$url_parameters = $parameters_url;
                //Core::$url_parameters;
            }
            
            /*$component =  preg_match("/^[a-z0-9]*\=/", Core::$url_parameters, $macth);

            foreach(explode("&",Core::$url_parameters) as $parameter_key => $parameter){                
                $parameters_value = explode("=",$parameter);
                
                $parameters_component = explode("|",$parameters_value[1]);
                if(count($parameters_component > 1)){
                    foreach($parameters_component as $parameter_component){
                        Core::$parameters[$parameters_value[0]][] = $parameter_component;
                    }
                }else{

                    Core::$parameters[$parameters_value[0]] = array($parameter_component);
                    //Core::$parameters[$parameter_key][1] = $parameter_component;
                }
            }
            //print_r(Core::$parameters);
            $component = preg_replace("/\=$/","",$macth[0]);
            Core::$component = "Components_" . ucfirst($component);*/
        }

        //corre el nucleo
        if(Core::factory()){
            //echo "LLEGO";
            return self::set();
            //Core::__construct();
        }else{
            echo "NO Le pudeo servir el nucleo no esta listo";
        }
                
        
        //$this->control();
    }

    
    public static function set(){
        $component_name =  strtolower(preg_replace("/^Components\_/", "", get_class(Core::$component)));
        $method_name = Core::$method;
        //echo Core::$method;

        if(method_exists(Core::$component, Core::$method)){
            //echo "GUE";
            
            if(Core::$component->$method_name()){
                //echo "SI";
                return $component_name . "_" . $method_name;
                //return true;
            }else{

                
            }

        }else{
            echo "Error 404";
            return "404";
        }

        
        //$parameters = ;
        
        /*if(Core::$parameters){
            $component  = ucfirst($this->component_default);
            $method = Core::$parameters[($this->component_default)][0];
        }else{
            $component = self::$component;
            $method = "start";
            
        }
        //echo $method = Core::$parameters[($this->component_default)][0];

        if(method_exists($this->$component, $method)){
            //echo "GUE";
            echo $this->$component->$method();
            
        }else{

        }*/
        /*if($url_parameters){
            if($url_parameters > 1){
                $url_parameters = array_slice(Core::$url_parameters,0,1);
            }

            //componente a ejecutar y asignaicon de parametros al core
            Core::$component = key(Core::$url_parameters);
            Core::$parameters = explode("|",$this->url[Core::$component]);                        
        }else{

        }*/

        //$component = ucfirst(Core::$component);
        //print_r(Core::$parameters);
        //$this->$component->init($parameters);
        
        /*if(empty($_GET)){
            $component = $this->component;            
        }else{            
            foreach($_GET as $get => $value){
                //echo $value;
                $component = ucfirst($get);
                $params = explode("|",$value);
                if($params){
                    foreach($params as $param){
                        $parameters[$component][] = $param;
                    }
                }else{
                    $parameters[$component] = null;
                }                
                
                //print_r($parameters);
                /*
                if($params){
                    foreach($params as $param){
                        $this->parameters[] = $param;
                    }
                }else{
                    $this->parameters[] = null;
                }*/
              //  break;
            //}

            //print_r($this->parameters);
        //}

        //echo $component;
        //echo $view.".xhtml";
        //$view = $this->$component->init($parameters);
        //$this->display($view.".xhtml");
    }

    //Funcion se puede eliminar
    function display($tpl){
        //echo $tpl;
        $tpl = $this->Template->loadTemplate($tpl);
        if($tpl){
            echo $tpl;
        }
    }
}
?>