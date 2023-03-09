<?php

namespace App\Controllers;

use App\Models\Participation;
use App\Models\Player;
use App\Models\Rate;

class MainController extends CoreController {

    public function home() {

        $rateModel = new Rate();

        $rate = $rateModel->updateRate(2023, 1);

        dd($rate);

        $this->show('home');
    }
    
}