<?php

namespace App\Controllers;

use App\Models\Driver;
use App\Models\Player;
use App\Models\Race;
use App\Models\Score;
use App\Models\Year;

class CoreController {

    protected function show($viewName, $viewData = [], $year = null) {

        global $router; 
        $baseURI = $_SERVER['BASE_URI'] . "/";

        $playerModel = new Player();
        $players = $playerModel->findAll(Player::class);

        $raceModel = new Race();
        $races = $raceModel->findAll(Race::class);

        $driverModel = new Driver();
        $drivers = $driverModel->findAll(Driver::class);

        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }

        $playersById = [];
        foreach ($players as $player) {
            $playersById[$player->getId()] = $player;
        }

        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $yearModel = new Year();
        $years = $yearModel->findAll(Year::class);

        $scoreModel = new Score();

        extract($viewData);


        require_once __DIR__ . "/../views/layout/header.tpl.php";
        require_once __DIR__ . "/../views/{$viewName}.tpl.php";
        require_once __DIR__ . "/../views/layout/footer.tpl.php";

    }
}