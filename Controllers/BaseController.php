<?php

require_once 'libs/Smarty/libs/Smarty.class.php';

class BaseController {
    
    private $controllerClass;
    
    function __construct($request) {    
        $this->set('controllerClass', $request['action']);
        $this->set('viewer',  $this->getSmartyInstance());
    }
    
    function getClass() {
        return $this->get('controllerClass');
    }
    
    function set($key, $value) {
        $this->$key = $value;
    }
    
    function get($key) {
        return $this->$key;
    }
    
    function getModule() {
        $moduleClass = $this->get('controllerClass');
        require 'Modules/'.$moduleClass.'.php';
        $moduleInstance = new $moduleClass;
        
        return $moduleInstance;
    }
    
    /**
     * Function to get the Smarty Object Instance
     * @return \Smarty
     */
    function getSmartyInstance() {
        $viewer = new Smarty();
        $viewer->setCacheDir('tmp' . DS . 'smarty' . DS . 'cache'); // set the cache directory
        $viewer->setTemplateDir('Layouts'. DS. $this->get('controllerClass')); // set the template directory
        $viewer->setCompileDir('tmp' . DS . 'smarty' . DS . 'compile'); // set the compile directory
        
        return $viewer;
    }
    
    /**
     * Function gives the Smarty Object To the Viewer
     */
    public function getViewer() {
        return $this->get('viewer');    
    }
}
?>
