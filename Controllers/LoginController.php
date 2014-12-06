<?php
require_once 'Controllers/BaseController.php';

class LoginController extends BaseController {
    
    function process() {
        $viewer = $this->getViewer();
        $viewer->display('Login.tpl');
    }
}
?>
