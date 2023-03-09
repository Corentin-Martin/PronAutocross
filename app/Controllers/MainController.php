<?php

namespace App\Controllers;

use App\Models\Participation;
use App\Models\Player;
use App\Models\Rate;

class MainController extends CoreController {

    public function home() {


        $this->show('home');
    }
    
}