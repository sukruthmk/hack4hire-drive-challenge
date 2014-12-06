<?php

class Record {
    var $valueMap;
    
    function get($key) {
        return $this->valueMap[$key];
    }
    
    function set($key, $value) {
        return $this->valueMap[$key] = $value;
    }
    
    function getData() {
        return $this->valueMap;
    }
    
    function setData($data) {
        $this->valueMap = $data;
    }
    
    static function getInstance($valueMap) {
        $instance = new self();
        $instance->setData($valueMap);
        
        return $instance;
    }
    
    static function getFiles($searchKey, $searchValue) {
        $db = Database::getInstance();
        if($searchKey && $searchValue) {
            $result = $db->query('select *from drive_files where '.$searchKey.' LIKE ? ORDER BY modifiedtime DESC limit 0,11', array("%".$searchValue."%"));
        } else {
            $result = $db->query('select *from drive_files ORDER BY modifiedtime DESC limit 0,10');
        }
        $data = $db->fetch($result);
        $records = array();
        foreach ($data as $valueMap) {
            $records[] = Record::getInstance($valueMap);
        }
        
        return $records;
    }
}
?>
