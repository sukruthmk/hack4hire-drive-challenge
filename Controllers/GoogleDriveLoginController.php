<?php

require_once 'Controllers/BaseController.php';

class GoogleDriveLoginController extends BaseController {
    
    function process() {
        $moduleInstance = $this->getModule();
        $appConfig = $moduleInstance->getAppConfig();
        $client = new Google_Client();
        // Get your credentials from the console
        $client->setClientId($appConfig['key']);
        $client->setClientSecret($appConfig['secret']);
        $client->setRedirectUri($appConfig['redirect']);
        $client->setScopes(array('https://www.googleapis.com/auth/drive'));
        
        $service = new Google_DriveService($client);
        $authUrl = $client->createAuthUrl();
        
        header('Location: '.$authUrl);
    }
}

?>
