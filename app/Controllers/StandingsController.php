<?php

namespace App\Controllers;

use App\Models\Score;

class StandingsController extends CoreController {


    public function results($year, $raceId) {

        $scoreModel = new Score();
        $score = $scoreModel->sortingByRace($year, $raceId);


        $this->show('results', ['race_id' => $raceId, 'score' => $score]);
    }

    public function general($year) {
        $this->show('general');
    }
}