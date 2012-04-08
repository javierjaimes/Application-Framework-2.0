<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Access
 *
 * @author senor
 */
require_once(ABSPATH."/Loader.php");
Loader::loadClass("Core");

class Core_Access{
    //put your code here    
    var $object;
    var $loader;
    var $record;
    var $welcome = "PRobando";

    function __construct($motor = null){        
        //$this->loader = new Core_loader();        
        if(!is_null($motor)){
            $file = ($motor == "Mysql")?"Core_Access_Mysql":"Core_Access_Postgres";            
        }else{
            $file = (MOTOR == "Mysql")?"Core_Access_Mysql":"Core_Access_Postgres";
        }

        if(Loader::loadClass($file)){            
            $this->object = new $file();
        }
    }

    public function connect(){
        $link = $this->object->connect(Core::$host, Core::$userdb, Core::$userpass, Core::$db);
        if($link){
            if($this->hasAccess()){
                return $this->link = $link;
            }
        }
    }

    public function hasAccess(){
        //echo "SHOW FULL TABLES FROM ".Core::$db;
        if($this->run("SHOW FULL TABLES FROM ".Core::$db)){
            if($this->numRows() > 0){
                return true;
            }
        }
    }

    public function get($table,$where = null, $mode = null){
       //echo "SELECT * FROM " . $table . $where;
       $recordset = $this->run("SELECT * FROM " . $table . $where);
       if($recordset){
           $mode = "resultIn". (($mode)? $mode:"Array");
           return $this->record = $this->$mode($recordset);
       }
    }    

    public function resultInArray($recordset){
        unset($this->record);
        //echo $recordset;
        while($record = $this->object->getRecordSet($recordset)){
           foreach($record as $campo => $item){
               $recordtemp[preg_replace('/^[a-z][A-z].*_/','',$campo)] =  $item;
           }
           $this->record[] = $recordtemp;           
        }
        return $this->record;
    }

    public function numRows(){
        return $this->object->getNumsRows();
    }

    
    public function run($sql){
        return $this->object->query($sql);
    }
    
}
?>