<?php
include('libs/adodb/adodb.inc.php');

class Database {
    var $db;
    
    static function getInstance() {
        global $sqltype, $host,$username,$password,$database;
        
        $DB = NewADOConnection($sqltype);
        $DB->Connect($host, $username, $password, $database);
        $DbInstance = new self();
        $DbInstance->db = $DB;
        
        return $DbInstance;
    }   
    
    function query($sql, $params = array()) {
        $result = $this->db->Execute($sql, $params);
        
        return $result;
    }
    
    function fetch($result) {
        $resultArray = array();
        
        while ($array = $result->FetchRow()) {
            $resultArray[] = $array;
        }
        
        return $resultArray;
    }
    
    function getCount($result) {
        $result->RecordCount();
    }
        
}
?>
