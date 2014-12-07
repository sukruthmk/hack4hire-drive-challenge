<?php

class Record {
    var $valueMap;
    static $nextPage = false;
    static $previousPage = false;
    
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
    
    static function getFiles($searchKey, $searchValue, $page) {
        if(empty($page)) {
            $page = 0;
        } 
        $db = Database::getInstance();
        if($searchKey && $searchValue) {
            $limit = self::getPaginationLimit($page);
            $result = $db->query('select *from drive_files where '.$searchKey.' LIKE ? ORDER BY modifiedtime DESC limit '.$limit, array("%".$searchValue."%"));
        } else {
            $limit = self::getPaginationLimit($page);
            $result = $db->query('select *from drive_files ORDER BY modifiedtime DESC limit '.$limit);
        }
        
        $data = $db->fetch($result);
        if(count($data) > 10) {
           self::$nextPage = $page + 1;
           array_pop($data);
        }
        
        if($page>0) {
            self::$previousPage = true;
        }
        
        $records = array();
        foreach ($data as $valueMap) {
            $records[] = Record::getInstance($valueMap);
        }
        
        return $records;
    }
    
    static function getPaginationLimit($page) {
        $start = $page*10;
        $end = $start+10+1;
        $limit = $start.",".$end;
        
        return $limit;
    }
}
?>
