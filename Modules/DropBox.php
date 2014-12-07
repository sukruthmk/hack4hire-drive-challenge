<?php

require_once 'Modules/Record.php';
require_once 'libs/Dropbox/strict.php';
require_once 'libs/Dropbox/autoload.php';

use \Dropbox as dbx;

class DropBox {
    var $dbxClient;
    
    function __construct() {
        if($_SESSION['userid']) {
            $userId = $_SESSION['userid'];
            $accessKey = $this->getAccessKey($userId);
            if($accessKey) {
                $this->dbxClient = new dbx\Client($accessKey, "DriveU/1.0");
            }
        }
    }
    
    function getAccessKey($userId) {
        $db = Database::getInstance();
        $result = $db->query('select access_token from drive_tokens where userid = ? limit 1', array($userId));
        $data = $db->fetch($result);
        $data = $data[0];
        
        return $data['access_token'];
    }
    
    public function getAllFolders() {
        try{
            $folderMetadata = $this->dbxClient->getMetadataWithChildren("/");
        } catch (Dropbox\Exception_InvalidAccessToken $e){
            return $response;
        }
        $metaContents = $folderMetadata['contents'];
        $folders = array();
        foreach($metaContents as $file) {
            if($file['is_dir']){
                $folders[] = $file;
            }
        }
        return $folders;
    }
    
    
    public function getAllInFolder($folder = '/') {
        try{
            $folderMetadata = $this->dbxClient->getMetadataWithChildren($folder);
        } catch (Dropbox\Exception_InvalidAccessToken $e){
            return $response;
        }
        $metaContents = $folderMetadata['contents'];
        return $metaContents;
    }
    
    public function searchFiles($searchKey) {
        try{
            $result = $this->dbxClient->searchFileNames('/',$searchKey);
        } catch(Exception $e){
            return NULL;
        }
        foreach($result as $file)
            if(!$file['is_dir']) $filesList[] = $file;
        return $filesList;
    }
    
    public function updateTable($fileInfo) {
        $modifiedTime = $this->convertToDateFormat($fileInfo['modified']);
        $name = explode('/', $fileInfo['path']);
        $name = end($name);
        $db = Database::getInstance();
        $db->query('insert into drive_files(path,modifiedtime,icon,type,size,source,name) values(?,?,?,?,?,?,?)', array($fileInfo['path'],$modifiedTime,$fileInfo['icon'],$fileInfo['mime_type'],$fileInfo['size'],'dropbox',$name));
    }
    
    public function convertToDateFormat($dateTime) {
        return date('Y-m-d H:i:s', strtotime($dateTime));
    }
    
    public function deleteEntries() {
        $db = Database::getInstance();
        $db->query('delete from drive_files where source = ?', array('dropbox'));
    }
    
}

?>
