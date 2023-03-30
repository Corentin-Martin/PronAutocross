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

        $csrfTokenToCheck = [
          'category-create',
          'category-update',
          'driver-create',
          'driver-update',
          'driver-updatePlaces',
          'entrylist-create',
          'question-create',
          'question-update',
          'race-create',
          'race-update',
          'verification-create',
          'verification-update',
          'verification-makevalidation',
          'rate-update',
          'user-participation'
        ];

        if (isset($match['name'])) {
          if (in_array($match['name'], $csrfTokenToCheck)) {
            
            $postToken = isset($_POST['token']) ? $_POST['token'] : '';
            $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

            dd(bin2hex($postToken), bin2hex($sessionToken));

            if ($postToken !== $sessionToken || empty($postToken)) {

              header( "Location: {$this->router->generate('error403')}" );
              exit;

            } else {
                unset($_SESSION['token']);
            }
          }

        }

    }

    public function checkAuthorization($authorizedRoles = []) {

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

        $baseURI = $_SERVER['BASE_URI'];

        extract($viewData);

        $backIndic = (str_starts_with($this->dispatcher->getController(), "App\Controllers\Admin\Admin")) ? "_admin" : "";

        require_once __DIR__ . "/../views/layout/header" . $backIndic . ".tpl.php";
        require_once __DIR__ . "/../views/{$viewName}.tpl.php";
        require_once __DIR__ . "/../views/layout/footer" . $backIndic . ".tpl.php";

    }
}