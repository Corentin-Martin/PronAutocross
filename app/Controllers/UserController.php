<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\EntryList;
use App\Models\Participation;
use App\Models\Questions;
use App\Models\Rate;

class UserController extends CoreController
{

    public function play($year, $raceId) {

        $entryModel = new EntryList();

        $categoryModel = new Category();
        $categories = $categoryModel->findAll(Category::class);

        $questionsModel = new Questions();
        $questions = $questionsModel->findQuestionsByRaceAndYear($year,$raceId);

        $entrylist = [];
        $categoriesById = [];
        foreach ($categories as $category) {
            $entrylist[$category->getId()] = $entryModel->listByRaceAndCategory($year, $raceId, $category->getId());
            $categoriesById[$category->getId()] = $category;
        }

        $rateModel = new Rate();
        $rates = $rateModel->findAllRatesByYear($year);

        $ratesByDriverId = [];
        foreach ($rates as $rate) {
            $ratesByDriverId[$rate->getDriverId()] = $rate;
        }

        if (!empty($_GET['MaxiSprint'])) {

            $playerId = 1;
            $maxiSprint = filter_input(INPUT_GET, 'MaxiSprint', FILTER_VALIDATE_INT);
            $tourismeCup = filter_input(INPUT_GET, 'TourismeCup', FILTER_VALIDATE_INT);
            $sprintGirls = filter_input(INPUT_GET, 'SprintGirls', FILTER_VALIDATE_INT);
            $buggyCup = filter_input(INPUT_GET, 'BuggyCup', FILTER_VALIDATE_INT);
            $juniorSprint = filter_input(INPUT_GET, 'JuniorSprint', FILTER_VALIDATE_INT);
            $maxiTourisme = filter_input(INPUT_GET, 'MaxiTourisme', FILTER_VALIDATE_INT);
            $buggy1600 = filter_input(INPUT_GET, 'Buggy1600', FILTER_VALIDATE_INT);
            $superSprint = filter_input(INPUT_GET, 'SuperSprint', FILTER_VALIDATE_INT);
            $superBuggy = filter_input(INPUT_GET, 'SuperBuggy', FILTER_VALIDATE_INT);
            $bonus1 = filter_input(INPUT_GET, 'Bonus1', FILTER_SANITIZE_SPECIAL_CHARS);
            $bonus2 = filter_input(INPUT_GET, 'Bonus2', FILTER_SANITIZE_SPECIAL_CHARS);
            $raceId = filter_input(INPUT_GET, 'raceId', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT);

            // TO DO Attention, les bonus n'arrivent pas !
            
        
        $participationModel = new Participation();
        $participation = $participationModel->play($playerId, $maxiSprint,$tourismeCup,$sprintGirls,$buggyCup, $juniorSprint, $maxiTourisme, $buggy1600, $superSprint, $superBuggy, $bonus1, $bonus2, $raceId, $year);
        
        if ($participation === 1) {
            global $router;
            header("Location: {$router->generate('recap')}");
            exit; 
        } else {
            echo "<p> Erreur !!! </p>";
        }
        
        }

        $this->show('user/play', ['entrylist' => $entrylist, 'categories' => $categoriesById, 'questions' => $questions, 'raceId' => $raceId, 'year' => $year, 'rates' => $ratesByDriverId]);
    }

    public function recap() {

       

        $this->show('user/recap');
    }
}