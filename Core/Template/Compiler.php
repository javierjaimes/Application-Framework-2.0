<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Compiler
 *
 * @author senor
 */
class Core_Template_Compiler {    
    
    //static $tag = null;
    //static $tag_attributes = null;
    //static $tag_text = null;
    //put your code here

    //compila el template
    function parse($template){
       
        //$template = eregi_replace("[\n|\r|\n\r]", '', $template);
        /*$regex = "/<\/?\w+((\s+(\w|\w[\w-]*\w)(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/i";*/
        $regex = "/<\/?\w+((\s+(\w|\w[\w-]*\w)(\s*=\s*(?:\".*?\"|'.*?'|[^'\">\s]+))?)+\s*|\s*)\/?>/i";

        echo $tag_sintax = preg_replace("/\|$/","",implode("|",Core_Template::$token));
        /*/*$is_tags =  preg_match_all("/<tpl:\w*(?:(?:\s[a-z]*=\\\"[^\\\"]*\\\")+)?\s?\/>|<tpl:\w*(?:(?:\s[a-z]*=\\\"[^\\\"]*\\\")+)?>.*<\/tpl:\w*>/", $template, $tags_matches, PREG_PATTERN_ORDER);*/
        $is_tags =  preg_match_all("/<tpl:a(?:(?:\s[a-z]*=\\\"[^\\\"]*\\\")+)?>(?:(?:<\/tpl:a>{1})|.*)?<\/tpl:a>/", $template, $tags_matches, PREG_PATTERN_ORDER);
        print_r($tags_matches);
        /*$is_tags =  preg_match_all("/<tpl:\w*(?:(?:\s[a-z]*=\\\"[^\\\"]*\\\")+)?\s?\/>|<tpl:\w*(?:(?:\s[a-z]*=\\\"[^\\\"]*\\\")+)?>.*<\/tpl:\w*>/is", $template, $tags_matches);
        print_r($tags_matches);

        if($is_tags){
            $tags = preg_replace("/[\n|\r|\n\r]/", "", implode("",$tags_matches[0]));
            //echo $tags = str_replace("><", ">|<", $tags);
            $is_valid_tags = preg_match_all("/$tag_sintax/", $tags, $tags_matches);
            if($is_valid_tags){
                print_r($tags_matches);
            }

        }*/

        //echo $tags_matches[1][0] . "SI";
       //if(is_null($tags_matches[1][0])) echo "YES";
       
       
        //return $template;
    }

    
    //si es etiqueta
    public static function is_tag(){
        echo
        $tag_name = strtolower(preg_replace("/Core_Template_Html_/","",get_class(self::$tag)));
        $tag = "<".$tag_name;

        //print_r(Core_Template::$tag_attributes);

        if(self::$tag_attributes){

            $tag_attributes = get_class_vars(get_class(self::$tag));

            /*print_r($tag_attributes);
            echo "<br />";
            echo "<br />";
            print_r(Core_Template::$tag_attributes);*/

            //verifica los atributos obligatorios de la etiqueta
            foreach($tag_attributes as $tag_attribute_name => $tag_attribute_value){

                if($tag_attribute_value and $tag_attribute_name != "close"){
                    //echo $tag_class . " : " .$tag_attribute_name ."<br />";
                    if(!array_key_exists($tag_attribute_name, self::$tag_attributes)){
                        echo "AQUI HAY ERROR: $tag";
                        $tag_error = 1;
                        //break;
                        return false;
                    }
                    //return
                }

                /*if($tag_attribute_value and $tag_attribute_name != "close" and $tag_attribute_name != "text"){

                    if(array_key_exists($tag_attribute_name, self::$attributes)){

                    }else{


                    }
                }*/
            }

           foreach(self::$tag_attributes as $tag_attribute_name => $tag_attribute_value){
                if(property_exists(self::$tag, $tag_attribute_name) and $tag_attribute_name != 'text'){
                    $tag .= " $tag_attribute_name=\"".self::$tag_attributes[$tag_attribute_name] . "\"";
                }
            }
            //echo $tag_error;

            //ingresa atributos a la etiqueta
            //if(!$tag_error){


                //Core_Template::$tag_attributes = null;
                //echo " LLEGO AUI ";
                //return $tag
            //}else{
                //echo " YEES ERROR <br /><br />";
                //return false;

            //}

            //print_r($tag_attributes);
            //echo "Siempre paso<br />";

        }
        
        $tag = (self::$tag_text)?  $tag . ">".self::$tag_text."</$tag_name>" : $tag . " />";
        return $tag;
        //}
    }
}
?>
