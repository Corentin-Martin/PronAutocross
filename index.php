<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Participation;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Score;


// $verificationModel = new Verification(2, 24, 25, 26, 27, 28, 29, 30, 31, "oui", "non", 1);

// $participationModel = new Participation();
// $participation = $participationModel->findAll(Participation::class);

// $participationModel->play(2, 4, 24, 25, 26, 27, 28, 29, 30, 31, "oui", "oui", 1);

// $verifModel = new Participation();

// $score = new Score();

// $race1 = $score->sortingByRace(1);

$raceModel = new Race();

$test = date('Y-m-d H:i:s');
$race = $raceModel->insertRace('Saint Junien', $test);



// var_dump($participation); die;

// $score->calcul(1);

// $questionModel = new Questions();
// $question = $questionModel->addQuestions('Qui gagne ?', 'Qui fait la pôle ?', 'Top 3 en finale ?', 'Qui gagne ?','Qui fait la pôle ?', 'Top 3 en finale ?','Qui gagne ?', 'Qui fait la pôle ?', 'Top 3 en finale ?', 'Du soleil ?', 'De la pluie ?', 1);

// $scoreRace1 = $score->sortingDesc(1);

var_dump($test);

