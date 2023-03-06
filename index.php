<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Participation;
use App\Models\Score;


// $verificationModel = new Verification(2, 24, 25, 26, 27, 28, 29, 30, 31, "oui", "non", 1);

// $participationModel = new Participation();
// $participation = $participationModel->findAll(Participation::class);

// $participationModel->play(2, 4, 24, 25, 26, 27, 28, 29, 30, 31, "oui", "oui", 1);

// $verifModel = new Participation();

$score = new Score();

// var_dump($participation); die;

// $test = $score->calcul(1);

$scoreRace1 = $score->sortingDesc(1);

var_dump($scoreRace1);

