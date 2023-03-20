<?php

namespace App\Controllers;


abstract class CoreController {

    protected $router;
    protected $match;

    public function __construct($router, $match) {
        $this->router = $router;
        $this->match = $match;
    }

    protected function show($viewName, $viewData = [], $year = null) {

        global $dispatcher;
        $baseURI = $_SERVER['BASE_URI'] . "/";

        extract($viewData);

        $backIndic = (str_starts_with($dispatcher->getController(), "App\Controllers\Admin\Admin")) ? "_admin" : "";

        require_once __DIR__ . "/../views/layout/header" . $backIndic . ".tpl.php";
        require_once __DIR__ . "/../views/{$viewName}.tpl.php";
        require_once __DIR__ . "/../views/layout/footer" . $backIndic . ".tpl.php";

    }
}