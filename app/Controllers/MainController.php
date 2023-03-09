<?php

namespace App\Controllers;

use App\Models\Player;

class MainController extends CoreController {

    public function home() {

        $player = new Player();
        $create = $player->createComplet('Oh', 'Raymond', 'Lamuch', 'oi@bi.fr', '123soleil');

        $this->show('home');
    }
    
}