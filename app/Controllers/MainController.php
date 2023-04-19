<?php

namespace App\Controllers;

use App\Models\GeneralScore;
use App\Models\Player;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Score;
use App\Models\Verification;

class MainController extends CoreController {

    public function home() {
        $allGeneral = GeneralScore::sortingGeneral(date('Y'));

        $players = [];

        foreach (array_slice($allGeneral, 0, 5) as $general) {
            $model = [];
            $model['general'] = $general->getTotal();

            $player = Player::find($general->getPlayerId());

            $model['pseudo'] = $player->getPseudo();

            $model['place'] = $general->getPlace();

            $players[$general->getPlayerId()] = $model;
        }

        $verification = Verification::lastVerif();

        if ($verification) {
            $race = Race::find($verification->getRaceId());

            $scores = Score::sortingByRace(date('Y'), $race->getId());
            $playersForRace = [];

            foreach (array_slice($scores, 0, 5) as $score) {

                $model = [];
                $model['score'] = $score->getTotal();

                $player = Player::find($score->getPlayerId());

                $model['pseudo'] = $player->getPseudo();
                $model['place'] = $score->getPlace();


                $playersForRace[$score->getPlayerId()] = $model;
            } 
        } else {
            $playersForRace = null;
            $race = null;
        }

        $this->show('main/home', ['players' => $players, 'playersForRace' => $playersForRace, 'race' => $race]);
    }

    public function rules() {
        $this->show('main/rules');
    }

    public function legalNotice() {
        $this->show('main/legalnotice');
    }
    
}