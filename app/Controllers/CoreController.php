<?php

namespace App\Controllers;

use App\Models\Player;
use App\Models\Race;

class CoreController {

    protected function show($viewName, $viewData = []) {

        global $router; 
        $baseURI = $_SERVER['BASE_URI'] . "/";

        $playerModel = new Player();
        $players = $playerModel->findAll(Player::class);

        $raceModel = new Race();
        $races = $raceModel->findAll(Race::class);

        $playersById = [];
        foreach ($players as $player) {
            $playersById[$player->getId()] = $player;
        }

        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        require_once __DIR__ . "/../views/header.tpl.php";
        require_once __DIR__ . "/../views/{$viewName}.tpl.php";
        require_once __DIR__ . "/../views/footer.tpl.php";

    }
}