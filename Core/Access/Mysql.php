<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mysql
 *
 * @author senor
 */
class Core_Access_Mysql {
    //put your code here
    var $link;
    var $db;
    var $recordset;

    function connect($host, $user, $userpass, $db){        
        $this->link = mysql_connect($host, $user, $userpass) or die('No pudo conectarse a la bd: ' . mysql_error());
        if($this->link){
            $this->db = mysql_select_db($db, $this->link);
            if($this->db){
                return $this->link;
            }else{
                return false;
            }
        }
        
    }

    function query($sql){        
        $this->recordset = mysql_query($sql, $this->link);
        if(!$this->recordset){
                return false;
        }else{
                return $this->recordset;
        }
    }

    function getRecordSet($recordset = null){
        if(is_null($recordset)){
                return mysql_fetch_array($this->recordset, MYSQL_ASSOC);
        }else{
                return mysql_fetch_array($recordset, MYSQL_ASSOC);
        }
    }

    function getNumsRows(){
        return mysql_num_rows($this->recordset);
    }
}
?>
