<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of core
 *
 * @author senor
 */
require_once(ABSPATH."/Loader.php");
class Core {    
    
    //var $directory;
    //var $filelist = false;

    //var $welcome = "Bienvenidos...";
    //var $Access = "JAVIER";

    //Core configuration
    static $conf;
    static $path = ABSPATH;
    static $path_lib = ABSPATH;

    //db
    static $Access;
    static $userdb = USERDB;
    static $userpass = USERPASS;
    static $host = HOST;
    static $db = DBNAME;
    static $link;
    

    //template
    static $Template;

    //Components
    static $Components;
    static $component;
    static $method;

    //Get
    static $url;
    static $url_parameters;    
    //static $parameters;
    
    //verificar el estado de la aplicacion
    function __construct(){                
        //$this->include_path =  ABSPATH . "/Core";
        //echo "Core";
        
        /*echo MOTOR;*/
        /*$this->Access->motor = MOTOR;
        if(!self::$link = $this->Access->connect()){
            //echo "NO MAL REMAL";
            exit();
        }*/

        //echo $this->Page->dump . "Hola";
        
        /*$core_opciones = $this->Access->get(get_class()."_opciones",null,null);
        foreach($core_opciones as $conf){
            self::$conf[$conf['var']] = $conf['value'];
            
        }

        self::$conf['urltheme'] = self::$conf['urlbase'] . "/template";

        foreach(self::$conf as $templatevar => $templatevalue){
            $this->Template->setVar($templatevar, $templatevalue);
        }*/

       //print_r(self::$conf);

        
       
        //echo self::$link;

        //echo $url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . " ";
	//echo $path = $_SERVER['DOCUMENT_ROOT']  . dirname($_SERVER['PHP_SELF']);
    }

    private static function build(){
        self::$Access = new Core_Access();
        if(self::$Access->connect()){
            //echo "SI";
            //echo self::$component;

            
            self::$Components = new Core_Components();
            $component = self::$component;
            self::$component = new $component;
            //self::$component->start();


            self::$Template = new Core_Template();
            

            $core_opciones = self::$Access->get(get_class()."_opciones",null,null);
            foreach($core_opciones as $conf){
                self::$conf[$conf['var']] = $conf['value'];
                
                self::$Template->setVar($conf['var'], $conf['value']);
            }
            //self::$component->start();            

        }
        return true;
        //Core_Access::hasAccess();
    }

   public static function factory(){
        if(self::$component){
            //echo self::$component;
            $library = array("Core_Access","Core_Template","Core_Components");
            $count_library = 0;
            while($count_library < count($library)){
                if(Loader::loadClass($library[$count_library])){
                    //echo "error cargando las librerias";
                    //exit();
                }
                $count_library++;
            }
            
            if($count_library == count($library)){
                Loader::loadClass(self::$component);
                $library_dependency = explode(",",includes);
                $count_library = 0;
                while($count_library < count($library_dependency)){
                    if(Loader::loadClass($library_dependency[$count_library])){
                        //echo "error cargando las librerias";
                        //exit();
                    }
                    $count_library++;
                }

                if($count_library == count($library_dependency)){
                    if(self::build()){
                        return true;
                    }                    
                }
            }                                                    

        }        
        //$ = (self::$component)? includes:$this->filelist;
        /*
        //print_r($this->filelist);        
        $build = false;
        
        
        //
        
        if(self::$component){
            //self::$component = "Core_". self::$component;
            $component = self::$component;
            Loader::loadClass($component);
            $this->filelist = array_merge(array("Core_Access","Core_Template","Core_Components"),explode(",",includes));

            foreach($this->filelist as $file){
                //echo $file;
                if(Loader::loadClass($file)){
                    //echo $file . " ";
                    
                    $object = preg_replace("/^Core_/","",$file);
                    //echo $file;
                    $this->$object = new $file();                    
                    //$this->components[] = $object;
                    $build = true;
                }
            }
            echo $this->Access;
            $object = preg_replace("/^Components_/","",self::$component);            
            $this->$object = new $component();
        }else{
            $this->directory = dir($this->include_path);
            
            while (false !== ($file = $this->directory->read())) {
               //echo $this->include_path. "/". $file . "<br />";
               $file = (!is_dir($this->include_path. "/". $file) && !preg_match('/^\./', $file))? basename($file,".php"):null;
               if($file){
                    //$this->filelist[] = "Core_".$file;
                   if(Loader::loadClass("Core_".$file)){
                    //echo $file . " ";
                        //$object = preg_replace("/^Core_/","",$file);
                        $this->$object = new $file();
                        $build = true;
                    }
               }
            }
            $this->directory->close();
        }
        
        //print_r($this->filelist);
                       
       // echo $this->Components->welcome;
        return $build;*/
    }

    public static function request(){
        Loader::loadClass("Core_Controller");
        //$this->control = "javier";
        
        return Core_Controller::get();
    }

    public static function render($template){        
        echo self::$Template->loadTemplate($template.".tpl");
    }
}
?>