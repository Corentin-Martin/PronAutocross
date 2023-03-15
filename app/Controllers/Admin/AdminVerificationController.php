<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\GeneralScore;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Score;
use App\Models\Verification;
use App\Models\Year;

class AdminVerificationController extends AdminCoreController
{

    public function add($year, $raceId) {


        $years = Year::findAll(Year::class);

        $races = Race::findbyYear($year);

        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }


        $categories = Category::findAll(Category::class);

        $categoriesOnDB = [];
        foreach ($categories as $category) {
            $categoriesOnDB[$category->getId()] = str_replace(" ", "", $category->getName());
        }

        $entryList = [];
        foreach ($categories as $category) {
            $entryList[$category->getId()] = EntryList::listByRaceAndCategory($year, $raceId, $category->getId());
        }

        $drivers = Driver::findAll(Driver::class);
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }



        $questions = Questions::findQuestionsByRaceAndYear($year, $raceId);

        $this->show('admin/verification/add', ['years' => $years, 'racesById' => $racesById, 'entryList' => $entryList, 'categories' => $categories, 'categoriesOnDB' => $categoriesOnDB, 'driversById' => $driversById, 'currentYear' => $year, 'currentRace' => $raceId, 'questions' => $questions]);
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

        $verif = $verification->verif();

        if ($verif) {

            global $router;

            header("Location: {$router->generate('verification-validation', ['id' => $verification->getId()])}");
            exit;

        } else {
            exit ("erreur");
        }
    }
    }

    public function validation($id) {

        $drivers = Driver::findAll(Driver::class);
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }

        $verification = Verification::find($id, Verification::class);

        $questions = Questions::findQuestionsByRaceAndYear($verification->getYearId(), $verification->getRaceId());

        $races = Race::findbyYear($verification->getYearId());

        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $categories = Category::findAll(Category::class);

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

            $scoreModel = new Score();
            $scoreModel->calcul($yearId, $raceId);

            global $router;

            header("Location: {$router->generate('results', ['year' => $yearId, 'id' => $raceId])}");
            exit;
            
        }
    }

    public function edit($id) {

        $verification = Verification::find($id, Verification::class);

        $years = Year::findAll(Year::class);

        $races = Race::findbyYear($verification->getYearId());

        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }


        $categories = Category::findAll(Category::class);

        $categoriesOnDB = [];
        foreach ($categories as $category) {
            $categoriesOnDB[$category->getId()] = str_replace(" ", "", $category->getName());
        }

        $entryList = [];
        foreach ($categories as $category) {
            $entryList[$category->getId()] = EntryList::listByRaceAndCategory($verification->getYearId(), $verification->getRaceId(), $category->getId());
        }

        $drivers = Driver::findAll(Driver::class);
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }



        $questions = Questions::findQuestionsByRaceAndYear($verification->getYearId(), $verification->getRaceId());

        $this->show('admin/verification/add', ['years' => $years, 'racesById' => $racesById, 'entryList' => $entryList, 'categories' => $categories, 'categoriesOnDB' => $categoriesOnDB, 'driversById' => $driversById, 'currentYear' => $verification->getYearId(), 'currentRace' => $verification->getRaceId(), 'questions' => $questions, 'verification' => $verification]);

    
    }

    public function update($id) {
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
    
            $verification = Verification::find($id, Verification::class);

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
    
            $update = $verification->update();
    
            if ($update) {
    
                global $router;
    
                header("Location: {$router->generate('verification-validation', ['id' => $verification->getId()])}");
                exit;
    
            } else {
                exit ("erreur");
            }
        }
    }

    public function list($year) {

        $verifications = Verification::findByYear($year);

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

        $drivers = Driver::findAll(Driver::class);
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }

        $years = Year::findAll(Year::class);

        $this->show('admin/verification/list', ['verifications' => $verifications, 'year' => $year, 'races' => $racesById, 'categories' => $categoriesById, 'years' => $years, 'driversById' => $driversById]);
    }
}