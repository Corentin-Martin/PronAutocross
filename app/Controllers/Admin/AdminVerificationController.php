<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\GeneralScore;
use App\Models\Participation;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Rate;
use App\Models\Score;
use App\Models\Verification;
use App\Models\Year;

class AdminVerificationController extends AdminCoreController
{

    public function addOrEdit($raceId = null) {


        if ($raceId) {
            $verification = Verification::showByRaceId($raceId, date('Y'));
        } else {
            $verification = null;
        }
        $questions = Questions::findQuestionsByRaceAndYear(date('Y'), $raceId);

        $races = Race::findByYear(date('Y'));

        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }


        $categories = Category::findAll();

        $categoriesOnDB = [];
        foreach ($categories as $category) {
            $categoriesOnDB[$category->getId()] = str_replace(" ", "", $category->getName());
        }

        if ($raceId) {
            $entryList = [];
            foreach ($categories as $category) {
                $entryList[$category->getId()] = EntryList::listByRaceAndCategory(date('Y'), $raceId, $category->getId());
            }
        } else {
            $entryList = null;

        }

        $drivers = Driver::findAll();
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }

        $questions = Questions::findQuestionsByRaceAndYear(date('Y'), $raceId);

        $this->show('admin/verification/add', ['racesById' => $racesById, 'entryList' => $entryList, 'categories' => $categories, 'categoriesOnDB' => $categoriesOnDB, 'driversById' => $driversById, 'currentRace' => $raceId, 'questions' => $questions, 'verification' => $verification]);
    }

    public function home() {
        $this->show('admin/verification/home');
    }

    public function create() {

    if (isset($_POST)) {
        $MaxiSprint = filter_input(INPUT_POST, 'MaxiSprint', FILTER_VALIDATE_INT);
        $TourismeCup = filter_input(INPUT_POST, 'TourismeCup', FILTER_VALIDATE_INT);
        $SprintGirls = filter_input(INPUT_POST, 'SprintGirls', FILTER_VALIDATE_INT);
        $BuggyCup = filter_input(INPUT_POST, 'BuggyCup', FILTER_VALIDATE_INT);
        $JuniorSprint = filter_input(INPUT_POST, 'JuniorSprint', FILTER_VALIDATE_INT);
        $MaxiTourisme = filter_input(INPUT_POST, 'MaxiTourisme', FILTER_VALIDATE_INT);
        $Buggy1600 = filter_input(INPUT_POST, 'Buggy1600', FILTER_VALIDATE_INT);
        $SuperSprint = filter_input(INPUT_POST, 'SuperSprint', FILTER_VALIDATE_INT);
        $SuperBuggy = filter_input(INPUT_POST, 'SuperBuggy', FILTER_VALIDATE_INT);
        $bonus1 = filter_input(INPUT_POST, 'bonus1', FILTER_SANITIZE_SPECIAL_CHARS);
        $bonus2 = filter_input(INPUT_POST, 'bonus2', FILTER_SANITIZE_SPECIAL_CHARS);
        $raceId = filter_input(INPUT_POST, 'raceId', FILTER_VALIDATE_INT);
        $yearId = filter_input(INPUT_POST, 'yearId', FILTER_VALIDATE_INT);

        $verification = new Verification();

        $verification->setMaxiSprint($MaxiSprint);
        $verification->setTourismeCup($TourismeCup);
        $verification->setSprintGirls($SprintGirls);
        $verification->setBuggyCup($BuggyCup);
        $verification->setJuniorSprint($JuniorSprint);
        $verification->setMaxiTourisme($MaxiTourisme);
        $verification->setBuggy1600($Buggy1600);
        $verification->setsuperSprint($SuperSprint);
        $verification->setSuperBuggy($SuperBuggy);
        $verification->setBonus1($bonus1);
        $verification->setBonus2($bonus2);
        $verification->setRaceId($raceId);
        $verification->setYearId($yearId);

        $verif = $verification->createOrUpdate();

        if ($verif) {

            header("Location: {$this->router->generate('verification-validation', ['id' => $verification->getId()])}");
            exit;

        } else {
            exit ("erreur");
        }
    }
    }

    public function validation($id) {

        $drivers = Driver::findAll();
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }

        $verification = Verification::find($id);

        $questions = Questions::findQuestionsByRaceAndYear($verification->getYearId(), $verification->getRaceId());

        $races = Race::findbyYear($verification->getYearId());

        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $categories = Category::findAll();

        $categoriesOnDB = [];
        foreach ($categories as $category) {
            $categoriesOnDB[$category->getId()] = str_replace(" ", "", $category->getName());
        }

        $this->show('admin/verification/verification', ['verification' => $verification, 'driversById' => $driversById, 'categories' => $categories, 'categoriesOnDB' => $categoriesOnDB, 'questions' => $questions, 'racesById' => $racesById]);
    }

    public function makevalidation() {

        if (isset($_POST)) {
            $yearId = filter_input(INPUT_POST, 'yearId', FILTER_VALIDATE_INT);
            $raceId = filter_input(INPUT_POST, 'raceId', FILTER_VALIDATE_INT);

            $verification = Verification::showByRaceId($raceId, $yearId);

            $participations = Participation::showAllParticipations($yearId, $raceId);

            foreach ($participations as $participation) {
                $score = new Score();

                $categories = Category::findAll(Category::class);

                foreach ($categories as $category) {
                    $categoryOnVerif = str_replace(" ", "", $category->getName());
    
                    if ($verification->{'get'.$categoryOnVerif}() === $participation->{'get'.$categoryOnVerif}()) {
    
                        $rate = Rate::findRateByDriverId($verification->{'get'.$categoryOnVerif}(), $yearId);
                        
                        $pointsToAdd = 10 * $rate->getOverall();
                        $score->{'set'.$categoryOnVerif}($pointsToAdd);
        
                    } else {
                        $score->{'set'.$categoryOnVerif}(0);
                    }
    
                }
    
                if ($verification->getBonus1() === $participation->getBonus1()) {
    
                    $score->setBonus1(20);
                    
                } else {
                    $score->setBonus1(0);
                }
    
                if ($verification->getBonus2() === $participation->getBonus2()) {
    
                    $score->setBonus2(20);
                    
                } else {
                    $score->setBonus2(0);
                }
    
                $score->setPlayerId($participation->getPlayerId());
                $score->setParticipationId($participation->getId());
                $score->setRaceId($participation->getRaceId());
                $score->setYearId($participation->getYearId());
                
                $total =  $score->getMaxiSprint() +
                $score->getTourismeCup() +
                $score->getSprintGirls() +
                $score->getBuggyCup() +
                $score->getJuniorSprint() +
                $score->getMaxiTourisme() +
                $score->getBuggy1600() +
                $score->getSuperSprint() +
                $score->getSuperBuggy() +
                $score->getBonus1() +
                $score->getBonus2();
    
                $score->setTotal($total);


                if ($score->createOrUpdate()) {
                    $general = GeneralScore::findGeneralForPlayer($score->getPlayerId());

                    $newTotal = $general->getTotal() + $score->getTotal();

                    $general->setTotal($newTotal);

                    $general->createOrUpdate();

                }
            }

            header("Location: {$this->router->generate('results', ['year' => $yearId, 'id' => $raceId])}");
            exit;
            
        }
    }

    public function update($raceId) {

        if (isset($_POST)) {
            $MaxiSprint = filter_input(INPUT_POST, 'MaxiSprint', FILTER_VALIDATE_INT);
            $TourismeCup = filter_input(INPUT_POST, 'TourismeCup', FILTER_VALIDATE_INT);
            $SprintGirls = filter_input(INPUT_POST, 'SprintGirls', FILTER_VALIDATE_INT);
            $BuggyCup = filter_input(INPUT_POST, 'BuggyCup', FILTER_VALIDATE_INT);
            $JuniorSprint = filter_input(INPUT_POST, 'JuniorSprint', FILTER_VALIDATE_INT);
            $MaxiTourisme = filter_input(INPUT_POST, 'MaxiTourisme', FILTER_VALIDATE_INT);
            $Buggy1600 = filter_input(INPUT_POST, 'Buggy1600', FILTER_VALIDATE_INT);
            $SuperSprint = filter_input(INPUT_POST, 'SuperSprint', FILTER_VALIDATE_INT);
            $SuperBuggy = filter_input(INPUT_POST, 'SuperBuggy', FILTER_VALIDATE_INT);
            $bonus1 = filter_input(INPUT_POST, 'bonus1', FILTER_SANITIZE_SPECIAL_CHARS);
            $bonus2 = filter_input(INPUT_POST, 'bonus2', FILTER_SANITIZE_SPECIAL_CHARS);
            $raceId = filter_input(INPUT_POST, 'raceId', FILTER_VALIDATE_INT);
            $yearId = filter_input(INPUT_POST, 'yearId', FILTER_VALIDATE_INT);
    
            $verification = Verification::showByRaceId($raceId, date('Y'));


            $verification->setMaxiSprint($MaxiSprint);
            $verification->setTourismeCup($TourismeCup);
            $verification->setSprintGirls($SprintGirls);
            $verification->setBuggyCup($BuggyCup);
            $verification->setJuniorSprint($JuniorSprint);
            $verification->setMaxiTourisme($MaxiTourisme);
            $verification->setBuggy1600($Buggy1600);
            $verification->setsuperSprint($SuperSprint);
            $verification->setSuperBuggy($SuperBuggy);
            $verification->setBonus1($bonus1);
            $verification->setBonus2($bonus2);
            $verification->setRaceId($raceId);
            $verification->setYearId($yearId);
    
            $update = $verification->createOrUpdate();
    
            if ($update) {
    
                header("Location: {$this->router->generate('verification-validation', ['id' => $verification->getId()])}");
                exit;
    
            } else {
                exit ("erreur");
            }
        }
    }

    public function list($year) {

        $verifications = Verification::findByYear($year);

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

        $drivers = Driver::findAll();
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }

        $years = Year::findAll();

        $this->show('admin/verification/list', ['verifications' => $verifications, 'currentYear' => $year, 'races' => $racesById, 'categories' => $categoriesById, 'years' => $years, 'driversById' => $driversById]);
    }

    public function delete($id) {

        $verification = Verification::find($id);

        $year = $verification->getYearId();

        if ($verification->delete()) {

            header("Location: {$this->router->generate('verification-list', ['year' => $year])}");
            exit;

        } else {
            exit ("erreur");
        }
        
    }
}