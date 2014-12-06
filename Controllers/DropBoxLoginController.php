<?php

require_once 'Controllers/BaseController.php';

class DropBoxLoginController extends BaseController {
    
    function process() {
        
        $moduleInstance = $this->getModule();
        $authorizeUrl = $moduleInstance->getWebAuth()->start();
        header("Location: $authorizeUrl");
    }
}

?>
