<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\GeneralScore;
use App\Models\Player;
use App\Models\Score;

class StandingsController extends CoreController {


    public function results($year, $raceId) {

        $scoreModel = new Score();
        $score = $scoreModel->sortingByRace($year, $raceId);

        $categories = Category::findAll();


        $this->show('standings/results', ['race_id' => $raceId, 'score' => $score, 'categories' => $categories]);
    }

    public function general($year) {

        $general = GeneralScore::sortingGeneral($year);

        $this->show('standings/general', ['general' => $general], $year);
    }
}