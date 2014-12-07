<?php

require_once 'Controllers/BaseController.php';

class LogOutController extends BaseController {
    function process() {
        session_start();
        session_destroy();
        
        header('Location: index.php?action=Login');
    }
} 

?>
