<?php

namespace App\Controllers;

use App\Models\Driver;
use App\Models\Participation;
use App\Models\Player;
use App\Models\Rate;
use App\Models\Score;

class MainController extends CoreController {

    public function home() {


        $this->show('home');
    }
    
}