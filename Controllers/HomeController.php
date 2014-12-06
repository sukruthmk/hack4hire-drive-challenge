<?php

require_once 'Controllers/BaseController.php'; 
require_once 'Modules/Record.php';

class HomeController extends BaseController {
    
    function process() {
        $records = Record::getFiles($_REQUEST['searchkey'],$_REQUEST['searchvalue']);
        $viewer = $this->getViewer();
        $viewer->assign('ACTION', $this->getClass());
        $viewer->assign('SEARCH_KEY', $_REQUEST['searchkey']);
        $viewer->assign('SEARCH_VALUE', $_REQUEST['searchvalue']);
        $viewer->assign('RECORD', $records);
        $viewer->display('Home.tpl');
    }
}

?>
