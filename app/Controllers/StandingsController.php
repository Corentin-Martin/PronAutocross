<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\GeneralScore;
use App\Models\Player;
use App\Models\Race;
use App\Models\Score;

class StandingsController extends CoreController {


    public function results($year, $raceId) {

        $categories = Category::findAll();

        $race = Race::find($raceId);

        $scores = Score::sortingByRace($year, $raceId);
        $players = [];


        $place=2;
        $increment=1;
        $preceding = null;

        foreach ($scores as $score) {

            $model = [];
            $model['score'] = $score;

            $player = Player::find($score->getPlayerId());

            $model['fiche'] = $player;

            if (is_null($preceding) || $preceding === $score->getTotal()) {

                $place--;
                $model['place'] = $place;

            } else {

                $model['place'] = $increment;
                $place = $increment;

            }

            $place++; 
            $increment++; 
            $preceding = $score->getTotal(); 

            $players[$score->getPlayerId()] = $model;
        } 


        $this->show('standings/results', ['players' => $players, 'categories' => $categories, 'race' => 
        $race]);
    }

    public function general($year) {

        $races = Race::findByYear($year);

        $allGeneral = GeneralScore::sortingGeneral($year);

        $players = [];

        $place=2;
        $increment=1;
        $preceding = null;

        foreach ($allGeneral as $general) {
            $model = [];
            $model['general'] = $general->getTotal();

            $player = Player::find($general->getPlayerId());

            $model['fiche'] = $player;

            if (is_null($preceding) || $preceding === $general->getTotal()) {
                $place--;
                $model['place'] = $place;
            } else {
                $model['place'] = $increment;
                $place = $increment;
            }

            $place++;
            $increment++;
            $preceding = $general->getTotal();

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

        $this->show('standings/general', ['year' => $year, 'players' => $players, 'races' => $races]);
    }
}