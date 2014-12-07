<?php

require_once 'libs/google/src/Google_Client.php';
require_once 'libs/google/src/contrib/Google_DriveService.php';

class GoogleDrive {
    
    protected $developerCredentials;

    protected $scopes = array('https://www.googleapis.com/auth/drive');

    protected $redirectUri;

    protected $client;

    protected $service;

    protected $serviceProvider = 'GoogleDrive';

    protected $security;
    
    function __construct() {
        if($_SESSION['googletoken']) {
            $this->developerCredentials = $this->getAppConfig();
            $this->client = new Google_Client();
            $this->client->setClientId($this->developerCredentials['key']);
            $this->client->setClientSecret($this->developerCredentials['secret']);
            $this->redirectUri = $this->developerCredentials['redirect'];
            $this->client->setRedirectUri($this->redirectUri);
            $this->client->setScopes($this->scopes);
            $this->client->setAccessType('offline');
            $this->client->setApprovalPrompt('force');
            $this->client->setAccessToken($_SESSION['googletoken']);
            $this->service = new Google_DriveService($this->client);
        }
    }
    
    public function getAppConfig() {
        require_once 'GoogleDriveConfig.php';
        
        return $appInfo;
    }
    
    /**
     * Retrieve a list of File resources
     *
     * @param String $filter - Filter to retrieve files from drive
     * @return Array of Results - Meta data of drive objects
     */
    public function retrieveFilesFromDrive($filter=false) {
        $result = array();
        $pageToken = NULL;

        do {
          try {
            $parameters = array();
            if($filter)
                $parameters = $filter;
            if ($pageToken) {
              $parameters['pageToken'] = $pageToken;
            }
            $files = $this->service->files->listFiles($parameters);

            $result = array_merge($result, $files['items']);
            $pageToken = $files['nextPageToken'];
          } catch (Exception $e) {
            if($e->getCode() == 401 || $e->getCode() == 403){
                return $response;
            }
            $pageToken = NULL;
          }
        } while ($pageToken);
        return $result;
    }

    /**
     * Retrieve all untrashed folders from drive
     *
     * @return Array Folders in google drive
     */
    public function getAllFolders() {
        $foldersFilter = array(
            'maxResults'=> '1000',
            'q' => 'mimeType = "application/vnd.google-apps.folder" and trashed=false'
        );
        $folders = $this->retrieveFilesFromDrive($foldersFilter);
        return $folders;
    }

    /**
     * Retrieve all untrashed files from drive
     *
     * @return Array Files in google drive
     */
    public function getAllFiles() {
        $filesFilter = array(
            'maxResults'=> '1000',
            'q' => 'mimeType != "application/vnd.google-apps.folder" and trashed=false'
        );
        $files = $this->retrieveFilesFromDrive($filesFilter);
        return $files;
    }
    
    /**
     * Retrieve all untrashed Files/Folders in the Drive folder
     * 
     * @param String $folder
     * @return Array Files in google drive
     */
    public function getAllInFolder($folder = 'root') {
        if($folder == 'root') {
            $access = $folder = $this->getRootFolderId();
            if($access['reauth']) return $access;
        }
        $filesFilter = array(
            'maxResults'=> '1000',
            'q' => "'".$folder."' in parents"." and trashed=false"
        );
        $files = $this->retrieveFilesFromDrive($filesFilter);
        return $files;
    }
    
    public function updateTable($fileInfo) {
        $modifiedTime = $this->convertToDateFormat($fileInfo['modifiedDate']);
        $name = $fileInfo['title'];
        $db = Database::getInstance();
        $db->query('insert into drive_files(path,modifiedtime,icon,type,source,name) values(?,?,?,?,?,?)', array($fileInfo['alternateLink'],$modifiedTime,$fileInfo['iconLink'],$fileInfo['mimeType'],'googledrive',$name));
    }
    
    public function convertToDateFormat($dateTime) {
        $dateTime = str_replace('T', ' ', $dateTime);
        $dateTime = str_replace('Z', '', $dateTime);
        return date('Y-m-d H:i:s', strtotime($dateTime));
    }
    
    public function deleteEntries() {
        $db = Database::getInstance();
        $db->query('delete from drive_files where source = ?', array('googledrive'));
    }
    
}
?>
