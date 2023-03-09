<?php

namespace App\Controllers;

use App\Models\GeneralScore;
use App\Models\Player;
use App\Models\Score;

class StandingsController extends CoreController {


    public function results($year, $raceId) {

        $scoreModel = new Score();
        $score = $scoreModel->sortingByRace($year, $raceId);


        $this->show('results', ['race_id' => $raceId, 'score' => $score]);
    }

    public function general($year) {

        $generalModel = new GeneralScore();
        $general = $generalModel->sortingGeneral($year);

        $this->show('general', ['general' => $general], $year);
    }
}