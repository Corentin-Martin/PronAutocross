<?php

namespace App\Controllers;


abstract class CoreController {

    protected $router;
    protected $match;
    protected $dispatcher;

    public function __construct($router, $match, $dispatcher) {
        $this->router = $router;
        $this->match = $match;
        $this->dispatcher = $dispatcher;

    }

    public function checkAuthorization($authorizedRoles = [])
    {

      if( array_key_exists("user", $_SESSION))
      {

        if(in_array( $_SESSION['user']->getRole(), $authorizedRoles)) {
          return true; 
        } else {
            header( "Location: {$this->router->generate('error403')}" );
            exit;
        }        
      }
      else {
        header( "Location: {$this->router->generate('user-login')}" );
        exit;
      }
    }

    protected function show($viewName, $viewData = [], $year = null) {

        $baseURI = $_SERVER['BASE_URI'] . "/";

        extract($viewData);

        $backIndic = (str_starts_with($this->dispatcher->getController(), "App\Controllers\Admin\Admin")) ? "_admin" : "";

        require_once __DIR__ . "/../views/layout/header" . $backIndic . ".tpl.php";
        require_once __DIR__ . "/../views/{$viewName}.tpl.php";
        require_once __DIR__ . "/../views/layout/footer" . $backIndic . ".tpl.php";

    }
}