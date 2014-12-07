<?php

require_once 'Controllers/BaseController.php'; 
require_once 'Modules/Record.php';

class HomeController extends BaseController {
    
    function process() {
        $currentPage = $_REQUEST['page'];
        $records = Record::getFiles($_REQUEST['searchkey'],$_REQUEST['searchvalue'], $currentPage);
        $viewer = $this->getViewer();
        $viewer->assign('ACTION', $this->getClass());
        $viewer->assign('SEARCH_KEY', $_REQUEST['searchkey']);
        $viewer->assign('SEARCH_VALUE', $_REQUEST['searchvalue']);
        $viewer->assign('NEXT_PAGE', Record::$nextPage);
        $viewer->assign('PREVIOUS_PAGE', Record::$previousPage);
        $viewer->assign('PAGE', $currentPage);
        $viewer->assign('RECORD', $records);
        $viewer->display('Home.tpl');
    }
}

?>
