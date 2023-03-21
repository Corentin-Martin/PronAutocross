<?php

namespace App\Controllers\Users;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\Participation;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Rate;

class UserParticipationController extends UserCoreController
{

    public function add($raceId) {

        $race = Race::find($raceId);

        if (Participation::checkForAPlayer(date('Y'), $raceId, $_SESSION['user']->getId())) {
            header("Location: {$this->router->generate('user-recap', ['id' => $raceId])}");
            exit;
        }

        if ($race->getDate() < date('Y-m-d H:i:s')) {

            if (Participation::checkForAPlayer(date('Y'), $raceId, $_SESSION['user']->getId())) {
                header("Location: {$this->router->generate('user-recap', ['id' => $raceId])}");
                exit;
            } else {
                header("Location: {$this->router->generate('user-deadline')}");
                exit;
            }
        }

        $categories = Category::findAll();

        $questions = Questions::findQuestionsByRaceAndYear(date('Y'),$raceId);

        $entrylist = [];
        $categoriesById = [];
        foreach ($categories as $category) {
            $entriesForACategory = EntryList::listByRaceAndCategory(date('Y'), $raceId, $category->getId());

            $categoryEntries = [];
            foreach ($entriesForACategory as $entry) {
                $model = [];
                $model['driver'] = Driver::find($entry->getDriverId());
                $model['rate'] = Rate::findRateByDriverId($entry->getDriverId(), date('Y'))->getOverall();
                $categoryEntries[$entry->getDriverId()] = $model;
            }

            $entrylist[$category->getId()] = $categoryEntries;

            $categoriesById[$category->getId()] = $category;
        }

        $this->show('user/play', ['race' => $race, 'categories' => $categories, 'questions' => $questions, 'categoriesById' => $categoriesById, 'entrylist' => $entrylist]);
    }

    public function create($raceId) {

        $race = Race::find($raceId);

        if (isset($_POST)) {
            $maxiSprint = filter_input(INPUT_POST, 'MaxiSprint', FILTER_VALIDATE_INT);
            $tourismeCup = filter_input(INPUT_POST, 'TourismeCup', FILTER_VALIDATE_INT);
            $sprintGirls = filter_input(INPUT_POST, 'SprintGirls', FILTER_VALIDATE_INT);
            $buggyCup = filter_input(INPUT_POST, 'BuggyCup', FILTER_VALIDATE_INT);
            $juniorSprint = filter_input(INPUT_POST, 'JuniorSprint', FILTER_VALIDATE_INT);
            $maxiTourisme = filter_input(INPUT_POST, 'MaxiTourisme', FILTER_VALIDATE_INT);
            $buggy1600 = filter_input(INPUT_POST, 'Buggy1600', FILTER_VALIDATE_INT);
            $superSprint = filter_input(INPUT_POST, 'SuperSprint', FILTER_VALIDATE_INT);
            $superBuggy = filter_input(INPUT_POST, 'SuperBuggy', FILTER_VALIDATE_INT);
            $bonus1 = filter_input(INPUT_POST, 'bonus1', FILTER_SANITIZE_SPECIAL_CHARS);
            $bonus2 = filter_input(INPUT_POST, 'bonus2', FILTER_SANITIZE_SPECIAL_CHARS);
            $playerId = filter_input(INPUT_POST, 'playerId', FILTER_VALIDATE_INT);
            $raceId = filter_input(INPUT_POST, 'raceId', FILTER_VALIDATE_INT);
            $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);

            $errorList = [];
            if (empty($maxiSprint) || empty($tourismeCup) || empty($sprintGirls) || empty($buggyCup) || empty($juniorSprint) || empty($maxiTourisme) || empty($buggy1600) || empty($superSprint) || empty($superBuggy) || empty($bonus1) || empty($bonus2) || empty($playerId) || empty($raceId) || empty($year)) {
                $errorList[] = "Une erreur est survenue, veuillez réessayer.";
            }

            if (empty($errorList)) {
                $participation = new Participation();

                $participation->setMaxiSprint($maxiSprint);
                $participation->setTourismeCup($tourismeCup);
                $participation->setSprintGirls($sprintGirls);
                $participation->setBuggyCup($buggyCup);
                $participation->setJuniorSprint($juniorSprint);
                $participation->setMaxiTourisme($maxiTourisme);
                $participation->setBuggy1600($buggy1600);
                $participation->setSuperSprint($superSprint);
                $participation->setSuperBuggy($superBuggy);
                $participation->setBonus1($bonus1);
                $participation->setBonus2($bonus2);
                $participation->setPlayerId($playerId);
                $participation->setRaceId($raceId);
                $participation->setYearId($year);

                if ($participation->create()) {
                    header("Location: {$this->router->generate('user-recap')}");
                    exit;
                } else {
                    $errorList[] = "Une erreur est survenue, veuillez réessayer.";
                }
            }

            $categories = Category::findAll();

            $questions = Questions::findQuestionsByRaceAndYear(date('Y'),$raceId);
    
            $entrylist = [];
            $categoriesById = [];
            foreach ($categories as $category) {
                $entriesForACategory = EntryList::listByRaceAndCategory(date('Y'), $raceId, $category->getId());
    
                $categoryEntries = [];
                foreach ($entriesForACategory as $entry) {
                    $model = [];
                    $model['driver'] = Driver::find($entry->getDriverId());
                    $model['rate'] = Rate::findRateByDriverId($entry->getDriverId(), date('Y'))->getOverall();
                    $categoryEntries[$entry->getDriverId()] = $model;
                }
    
                $entrylist[$category->getId()] = $categoryEntries;
    
                $categoriesById[$category->getId()] = $category;
            }
    
            $this->show('user/play', ['race' => $race, 'categories' => $categories, 'questions' => $questions, 'categoriesById' => $categoriesById, 'entrylist' => $entrylist, 'errorList' => $errorList]);
        }
    }

    public function recap($raceId) {

        $participation = Participation::checkForAPlayer(date('Y'), $raceId, $_SESSION['user']->getId());
        $questions = Questions::findQuestionsByRaceAndYear(date('Y'),$raceId);

        $vote = [];
        $potentialWin = 0;
        $categories = Category::findAll();
        foreach ($categories as $category) {
            $categoryToGet = str_replace(" ", "", $category->getName());

            $table = [];

            $table['category'] = $category->getName();
            $table['question'] = $questions->{'get'.$categoryToGet}();

            $table['answer'] = [];

            $table['answer']['driver'] = Driver::find($participation->{'get'.$categoryToGet}())->getNumber() . " - " . Driver::find($participation->{'get'.$categoryToGet}())->getFirstName() . " " . Driver::find($participation->{'get'.$categoryToGet}())->getLastName();
            $table['answer']['rate'] = Rate::findRateByDriverId($participation->{'get'.$categoryToGet}(), date('Y'))->getOverall();
            $table['answer']['potential'] = $table['answer']['rate'] * 10;
            $potentialWin += $table['answer']['potential'];

            $vote[$category->getId()] = $table;
        }

        $table = [];

        $table['category'] = "Bonus 1";
        $table['question'] = $questions->getBonus1();
        $table['answer'] = $participation->getBonus1();

        $vote['bonus1'] = $table;

        $table = [];

        $table['category'] = "Bonus 2";
        $table['question'] = $questions->getBonus2();
        $table['answer'] = $participation->getBonus2();

        $vote['bonus2'] = $table;

        $potentialWin += 40;


        $this->show('user/recap', ['vote' => $vote, 'potentialWin' => $potentialWin]);
    }
}
