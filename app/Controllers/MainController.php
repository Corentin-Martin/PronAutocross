<?php

namespace App\Controllers;

use App\Models\Participation;
use App\Models\Player;
use App\Models\Rate;
use App\Models\Score;

class MainController extends CoreController {

    public function home() {

        $scoreModel = new Score();

        $scoreModel->calcul(2023,1);


        $this->show('home');
    }
    
}