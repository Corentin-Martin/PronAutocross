<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Year;

class AdminQuestionController extends AdminCoreController
{

    public function add() {

        global $router;

        $categories = Category::findAll(Category::class);
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $races = Race::findAll(Race::class);
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $years = Year::findAll(Year::class);


        $this->show('admin/question/add', ['categories' => $categoriesById, 'races' => $racesById, 'years' => $years]);
    }

    public function create() {

     if (isset($_POST)) {
        $maxiSprint = filter_input(INPUT_POST, 'Maxi_Sprint', FILTER_SANITIZE_SPECIAL_CHARS);
        $tourismeCup = filter_input(INPUT_POST, 'Tourisme_Cup', FILTER_SANITIZE_SPECIAL_CHARS); 
        $sprintGirls = filter_input(INPUT_POST, 'Sprint_Girls', FILTER_SANITIZE_SPECIAL_CHARS); 
        $buggyCup = filter_input(INPUT_POST, 'Buggy_Cup', FILTER_SANITIZE_SPECIAL_CHARS); 
        $juniorSprint = filter_input(INPUT_POST, 'Junior_Sprint', FILTER_SANITIZE_SPECIAL_CHARS); 
        $maxiTourisme = filter_input(INPUT_POST, 'Maxi_Tourisme', FILTER_SANITIZE_SPECIAL_CHARS);
        $buggy1600 = filter_input(INPUT_POST, 'Buggy1600', FILTER_SANITIZE_SPECIAL_CHARS);
        $superSprint = filter_input(INPUT_POST, 'Super_Sprint', FILTER_SANITIZE_SPECIAL_CHARS);
        $superBuggy = filter_input(INPUT_POST, 'Super_Buggy', FILTER_SANITIZE_SPECIAL_CHARS);
        $bonus1 = filter_input(INPUT_POST, 'bonus1', FILTER_SANITIZE_SPECIAL_CHARS);
        $bonus2 = filter_input(INPUT_POST, 'bonus2', FILTER_SANITIZE_SPECIAL_CHARS);
        $raceId = filter_input(INPUT_POST, 'raceId', FILTER_VALIDATE_INT);
        $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);

        $questionModel = new Questions();
        $questionnaire = $questionModel->add($maxiSprint, $tourismeCup, $sprintGirls, $buggyCup, $juniorSprint, $maxiTourisme, $buggy1600, $superSprint, $superBuggy, $bonus1, $bonus2, $raceId, $year);
        
        if ($questionnaire === 1) {
            global $router;
            header("Location: {$router->generate('question-list', ['year' => $year])}");
            exit; 
        } else {
            echo "<p> Erreur, questionnaire non ajouté </p>";
        }

     }
    }

    public function list($year) {

        $questions = Questions::findQuestionsByYear($year);

        $races = Race::findAll(Race::class);
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $categories = Category::findAll(Category::class);
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $years = Year::findAll(Year::class);

        $this->show('admin/question/list', ['questions' => $questions, 'year' => $year, 'races' => $racesById, 'categories' => $categoriesById, 'years' => $years]);
    }

    public function home() {

        global $router;


        $this->show('admin/question/home');
    }
}