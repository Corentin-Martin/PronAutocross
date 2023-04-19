<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\GeneralScore;
use App\Models\Player;
use App\Models\Race;
use App\Models\Score;

class StandingsController extends CoreController {


    public function results($year, $raceId) {

        if ($year > date('Y')) {
            $year = date('Y');
        }

        $categories = Category::findAll();

        $race = Race::find($raceId);

        if (!$race) {
            header("Location: {$this->router->generate('error404')}");
            exit;
        }

        $scores = Score::sortingByRace($year, $raceId);
        $players = [];

        foreach ($scores as $score) {

            $model = [];
            $model['score'] = $score;

            $player = Player::find($score->getPlayerId());

            $model['fiche'] = $player;
            $model['place'] = $score->getPlace();


            $players[$score->getPlayerId()] = $model;
        } 

        $races = Race::findByYear($year);

        $friends = null;

        if (isset($_SESSION['user'])) {
            $player = Player::find($_SESSION['user']->getId());
            $friends = $player->showFriends();
        }


        $this->show('standings/results', ['players' => $players, 'categories' => $categories, 'race' => 
        $race, 'races' => $races, 'year' => $year, 'friends' => $friends]);
    }

    public function general($year) {

        if ($year > date('Y')) {
            $year = date('Y');
        }

        $races = Race::findByYear($year);

        $allGeneral = GeneralScore::sortingGeneral($year);

        $players = [];

        foreach ($allGeneral as $general) {

            if ($general->getPlace() != 0) {
                
                $model = [];
                $model['general'] = $general->getTotal();

                $player = Player::find($general->getPlayerId());

                $model['fiche'] = $player;

                $model['place'] = $general->getPlace();

                $scores = [];
                foreach ($races as $race) {
                    $score = Score::findForGeneral($year, $race->getId(), $general->getPlayerId());

                    if ($score) {
                        $scores[$race->getId()] = $score;
                    } else {
                        $scores[$race->getId()] = null;
                    }
                }

                $model['scores'] = $scores;

                $players[$general->getPlayerId()] = $model;
            }
        }

        $friends = null;

        if (isset($_SESSION['user'])) {
            $player = Player::find($_SESSION['user']->getId());
            $friends = $player->showFriends();
        }

        $this->show('standings/general', ['year' => $year, 'players' => $players, 'races' => $races, 'friends' => $friends]);
    }
}