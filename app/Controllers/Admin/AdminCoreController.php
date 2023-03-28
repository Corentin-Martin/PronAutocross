<?php

namespace App\Controllers\Admin;

use App\Controllers\CoreController;

class AdminCoreController extends CoreController
{

    protected $router;
    protected $match;
    protected $dispatcher;
    
    public function __construct($router, $match, $dispatcher) {
        $this->router = $router;
        $this->match = $match;
        $this->dispatcher = $dispatcher;

        if($this->checkAuthorization(['admin', 'editor']) === false) {
            header("Location: {$this->router->generate('home')}");
            exit;
        };

   
    }

    public function home() {

     $this->show('admin/home');
     
    }

}