<?php
require_once 'libs/Dropbox/strict.php';
require_once 'libs/Dropbox/autoload.php';

use \Dropbox as dbx;

class DropBoxLogin {
    
    function getClient() {
        list($appInfo, $clientIdentifier, $userLocale) = $this->getAppConfig();
        return new dbx\Client($accessToken, $clientIdentifier, $userLocale, $appInfo->getHost());
    }
    
    function getWebAuth() {
        global $siteUrl;
        
        session_start();
        
        list($appInfo, $clientIdentifier, $userLocale) = $this->getAppConfig();
        $redirectUri = $siteUrl.'Callbacks/DropBoxCallBack.php';
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        return new dbx\WebAuth($appInfo, $clientIdentifier, $redirectUri, $csrfTokenStore, $userLocale);
    }
    
    function getAppConfig() {
        require_once 'DropBoxConfig.php';
        $appInfo = dbx\AppInfo::loadFromJson($appInfo);
        $clientIdentifier = "DriveU";
        $userLocale = null;
        return array($appInfo, $clientIdentifier, $userLocale);
    }
    
    function getUserInfo($accessToken) {
        $dbxClient = new dbx\Client($accessToken, "DriveU/1.0");
        $accountInfo = $dbxClient->getAccountInfo();
        
        return $accountInfo;
    }
    
    function checkUserExits($userId, $email, $source) {
        $db = Database::getInstance();
        $result = $db->query('select id from drive_users where userid = ? and email = ? and source = ?', array($userId, $email, $source));
        $count = $db->getCount($result);
        if($count > 0) {
            return true;
        }
        
        return false;
    }
}
?>
