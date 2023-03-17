<?php

namespace App\Controllers;

use App\Controllers\Admin\AdminCoreController;
use App\Models\Driver;
use App\Models\Player;
use App\Models\Race;
use App\Models\Score;
use App\Models\Year;

abstract class CoreController {

    protected function show($viewName, $viewData = [], $year = null) {

        global $router; 
        global $dispatcher;
        $baseURI = $_SERVER['BASE_URI'] . "/";

        $players = Player::findAll();

        $races = Race::findAll();

        $drivers = Driver::findAll();

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

        $years = Year::findAll();

        $scoreModel = new Score();

        extract($viewData);

        $backIndic = (str_starts_with($dispatcher->getController(), "App\Controllers\Admin\Admin")) ? "_admin" : "";

        require_once __DIR__ . "/../views/layout/header" . $backIndic . ".tpl.php";
        require_once __DIR__ . "/../views/{$viewName}.tpl.php";
        require_once __DIR__ . "/../views/layout/footer" . $backIndic . ".tpl.php";

    }
}