<?php

namespace App\Controllers\Admin;

use App\Controllers\CoreController;

class AdminCoreController extends CoreController
{

    public function home() {

     $this->show('admin/home');
     
    }

}