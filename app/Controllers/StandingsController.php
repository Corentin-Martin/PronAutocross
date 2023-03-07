<?php

namespace App\Controllers;

use App\Models\Score;

class StandingsController extends CoreController {


    public function results($raceId) {

        $scoreModel = new Score();
        $score = $scoreModel->sortingByRace($raceId);


        $this->show('results', ['race_id' => $raceId, 'score' => $score]);
    }

    public function general() {
        $this->show('general');
    }
}