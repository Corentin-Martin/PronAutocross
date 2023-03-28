<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Year;

class AdminQuestionController extends AdminCoreController
{

    public function addOrEdit($id = null) {

        $categories = Category::findAll();
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $races = Race::findByYear(date('Y'));
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] =  $race;
        }

        if ($id) {
            $questionnaire = Questions::find($id);
        } else {
            $questionnaire = null;
        }


        $this->show('admin/question/add', ['categories' => $categoriesById, 'races' => $races, 'racesById' => $racesById, 'questionnaire' => $questionnaire]);
    }

    public function createOrUpdate($id = null) {

        if (isset($_POST)) {

            $maxiSprint = filter_input(INPUT_POST, 'Maxi_Sprint', FILTER_SANITIZE_SPECIAL_CHARS);
            $tourismeCup = filter_input(INPUT_POST, 'Tourisme_Cup', FILTER_SANITIZE_SPECIAL_CHARS); 
            $sprintGirls = filter_input(INPUT_POST, 'Sprint_Girls', FILTER_SANITIZE_SPECIAL_CHARS); 
            $buggyCup = filter_input(INPUT_POST, 'Buggy_Cup', FILTER_SANITIZE_SPECIAL_CHARS); 
            $juniorSprint = filter_input(INPUT_POST, 'Junior_Sprint', FILTER_SANITIZE_SPECIAL_CHARS); 
            $maxiTourisme = filter_input(INPUT_POST, 'Maxi_Tourisme', FILTER_SANITIZE_SPECIAL_CHARS);
            $buggy1600 = filter_input(INPUT_POST, 'Buggy_1600', FILTER_SANITIZE_SPECIAL_CHARS);
            $superSprint = filter_input(INPUT_POST, 'Super_Sprint', FILTER_SANITIZE_SPECIAL_CHARS);
            $superBuggy = filter_input(INPUT_POST, 'Super_Buggy', FILTER_SANITIZE_SPECIAL_CHARS);
            $bonus1 = filter_input(INPUT_POST, 'bonus1', FILTER_SANITIZE_SPECIAL_CHARS);
            $bonus2 = filter_input(INPUT_POST, 'bonus2', FILTER_SANITIZE_SPECIAL_CHARS);
            $raceId = filter_input(INPUT_POST, 'raceId', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
    
            if ($id) {
                $questionnaire = Questions::find($id);
            } else {
                $questionnaire = new Questions();  
            }

            $questionnaire->setMaxiSprint($maxiSprint);
            $questionnaire->setTourismeCup($tourismeCup);
            $questionnaire->setSprintGirls($sprintGirls);
            $questionnaire->setBuggyCup($buggyCup);
            $questionnaire->setJuniorSprint($juniorSprint);
            $questionnaire->setMaxiTourisme($maxiTourisme);
            $questionnaire->setBuggy1600($buggy1600);
            $questionnaire->setSuperSprint($superSprint);
            $questionnaire->setSuperBuggy($superBuggy);
            $questionnaire->setBonus1($bonus1);
            $questionnaire->setBonus2($bonus2);
            $questionnaire->setRaceId($raceId);
            $questionnaire->setYearId($year);

            if($id) {
                $questionnaire->setId($id);
            }
            
            if ($questionnaire->createOrUpdate('questions')) {
                header("Location: {$this->router->generate('question-list', ['year' => $year])}");
                exit; 
            } else {
                echo "<p> ERREUR </p>";
            }
    
        } else {
            header("Location: {$this->router->generate('question-home')}");
            exit; 
        }
    }

    public function list($year) {

        $questions = Questions::findByYear($year);

        $races = Race::findAll();
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $categories = Category::findAll();
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $years = Year::findAll();

        $this->show('admin/question/list', ['questions' => $questions, 'currentYear' => $year, 'races' => $racesById, 'categories' => $categoriesById, 'years' => $years]);
    }

    public function home() {

        $this->show('admin/question/home');
    }

    public function delete($id, $token) {

        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

        if (hex2bin($token) !== $sessionToken) {

            header( "Location: {$this->router->generate('error403')}" );
            exit;

        } else {
            unset($_SESSION['token']);
        }

        $questions = Questions::find($id);

        $year = $questions->getYearId();

        if ($questions->delete()) {
    
            header("Location: {$this->router->generate('question-list', ['year' => $year])}");
            exit;

        } else {
            exit ("erreur");
        }
        
    }
}