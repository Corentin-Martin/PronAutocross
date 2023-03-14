<?php

namespace App\Controllers\Admin;

use App\Models\Questions;
use App\Models\Race;

class AdminQuestionController extends AdminCoreController
{

    public function add() {

        global $router;

        // TO DO TRAITER FORMULAIRE DE VALIDATION


        $this->show('admin/question/add');
    }

    public function list($year, $raceId) {

        $questions = Questions::findQuestionsByRaceAndYear($year, $raceId);

        $this->show('admin/question/list', ['questions' => $questions]);
    }

    public function home() {

        global $router;


        $this->show('admin/question/home');
    }
}