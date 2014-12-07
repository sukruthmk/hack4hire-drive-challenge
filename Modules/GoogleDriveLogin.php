<?php

require_once 'libs/google/src/Google_Client.php';
require_once 'libs/google/src/contrib/Google_DriveService.php';
        
class GoogleDriveLogin {
    
    public function getAppConfig() {
        require_once 'GoogleDriveConfig.php';
        
        return $appInfo;
    }
}

?>
