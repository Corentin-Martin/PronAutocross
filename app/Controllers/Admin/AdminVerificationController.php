<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\GeneralScore;
use App\Models\Participation;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Score;
use App\Models\Verification;
use App\Models\Year;

class AdminVerificationController extends AdminCoreController
{
    public function home() {
        $this->show('admin/verification/home');
    }

    public function addOrEdit($raceId = null, $id = null) {


        if ($id) {
            $verification = Verification::find($id);
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
                $entryList[$category->getId()] = Driver::listByRaceAndCategory($raceId, $category->getId());
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

    public function createOrUpdate($raceId = null, $id = null) {

        if (isset($_POST)) {

            $MaxiSprint = [];
            $TourismeCup = [];
            $SprintGirls = [];
            $BuggyCup = [];
            $JuniorSprint = [];
            $MaxiTourisme = [];
            $Buggy1600 = [];
            $SuperSprint = [];
            $SuperBuggy = [];

            for ($i = 1; $i <6; $i++) {
                $MaxiSprint[$i] = filter_input(INPUT_POST, "MaxiSprint$i", FILTER_VALIDATE_INT);
                $TourismeCup[$i] = filter_input(INPUT_POST, "TourismeCup$i", FILTER_VALIDATE_INT);
                $SprintGirls[$i] = filter_input(INPUT_POST, "SprintGirls$i", FILTER_VALIDATE_INT);
                $BuggyCup[$i] = filter_input(INPUT_POST, "BuggyCup$i", FILTER_VALIDATE_INT);
                $JuniorSprint[$i] = filter_input(INPUT_POST, "JuniorSprint$i", FILTER_VALIDATE_INT);
                $MaxiTourisme[$i] = filter_input(INPUT_POST, "MaxiTourisme$i", FILTER_VALIDATE_INT);
                $Buggy1600[$i] = filter_input(INPUT_POST, "Buggy1600$i", FILTER_VALIDATE_INT);
                $SuperSprint[$i] = filter_input(INPUT_POST, "SuperSprint$i", FILTER_VALIDATE_INT);
                $SuperBuggy[$i] = filter_input(INPUT_POST, "SuperBuggy$i", FILTER_VALIDATE_INT);
            }

            $bonus1 = filter_input(INPUT_POST, 'bonus1', FILTER_SANITIZE_SPECIAL_CHARS);
            $bonus2 = filter_input(INPUT_POST, 'bonus2', FILTER_SANITIZE_SPECIAL_CHARS);
            $raceId = filter_input(INPUT_POST, 'raceId', FILTER_VALIDATE_INT);
            $yearId = filter_input(INPUT_POST, 'yearId', FILTER_VALIDATE_INT);

            if ($id) {
                $verification = Verification::find($id);
            } else {
                $verification = new Verification();
            }

            $verification->setMaxiSprint($MaxiSprint[1]);
            $verification->setTourismeCup($TourismeCup[1]);
            $verification->setSprintGirls($SprintGirls[1]);
            $verification->setBuggyCup($BuggyCup[1]);
            $verification->setJuniorSprint($JuniorSprint[1]);
            $verification->setMaxiTourisme($MaxiTourisme[1]);
            $verification->setBuggy1600($Buggy1600[1]);
            $verification->setsuperSprint($SuperSprint[1]);
            $verification->setSuperBuggy($SuperBuggy[1]);

            for ($i = 2; $i <6; $i++) {
                $verification->{"setMaxiSprint$i"}($MaxiSprint[$i]);
                $verification->{"setTourismeCup$i"}($TourismeCup[$i]);
                $verification->{"setSprintGirls$i"}($SprintGirls[$i]);
                $verification->{"setBuggyCup$i"}($BuggyCup[$i]);
                $verification->{"setJuniorSprint$i"}($JuniorSprint[$i]);
                $verification->{"setMaxiTourisme$i"}($MaxiTourisme[$i]);
                $verification->{"setBuggy1600$i"}($Buggy1600[$i]);
                $verification->{"setsuperSprint$i"}($SuperSprint[$i]);
                $verification->{"setSuperBuggy$i"}($SuperBuggy[$i]);
            }

            $verification->setBonus1($bonus1);
            $verification->setBonus2($bonus2);
            $verification->setRaceId($raceId);
            $verification->setYearId($yearId);

            if ($verification->createOrUpdate()) {

                header("Location: {$this->router->generate('verification-validation', ['id' => $verification->getId()])}");
                exit;

            } else {
                exit ("erreur");
            }
        } else {
            header("Location: {$this->router->generate('error403')}");
            exit; 
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

                    $getter = "get$categoryOnVerif";
                    $setter = "set$categoryOnVerif";

                    for ($i = 1; $i < 6; $i++) {
                        ($i == 1) ? ($cible = '') : ($cible = $i);

                        if ($verification->{$getter.$cible}() === $participation->$getter()) {
                            $driver = Driver::find($verification->{$getter.$cible}());

                            $pointsToAdd = 10 * $driver->getOverall();
                            $score->$setter($pointsToAdd);
                            break;
                        } else {
                            $score->$setter(0);
                        }
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

            $allGeneral = GeneralScore::sortingGeneralToUpdatePlaces(date('Y'));

            $place=2;
            $increment=1;
            $preceding = null;

            foreach ($allGeneral as $general) {
                $generalForAPlayer = GeneralScore::findGeneralForPlayer($general->getPlayerId());

                if (is_null($preceding) || $preceding === $general->getTotal()) {
                    $place--;
                    $generalForAPlayer->setPlace($place);
                } else {
                    $generalForAPlayer->setPlace($increment);
                    $place = $increment;
                }

                $place++;
                $increment++;
                $preceding = $general->getTotal();

                $generalForAPlayer->updatePlace();
            }

            $scores = Score::sortingByRace(date('Y'), $raceId);

            $place=2;
            $increment=1;
            $preceding = null;

            foreach ($scores as $score) {
                $scorePlace = Score::findForGeneral(date('Y'), $raceId, $score->getPlayerId());

                if (is_null($preceding) || $preceding === $score->getTotal()) {
                    $place--;
                    $scorePlace->setPlace($place);
                } else {
                    $scorePlace->setPlace($increment);
                    $place = $increment;
                }

                $place++;
                $increment++;
                $preceding = $score->getTotal();

                $scorePlace->updatePlace();
            }
            

            header("Location: {$this->router->generate('results', ['year' => $yearId, 'id' => $raceId])}");
            exit;
                
            
        } else {
            header("Location: {$this->router->generate('error403')}");
            exit; 
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

    public function delete($id, $token) {

        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

        if (hex2bin($token) !== $sessionToken) {

            header( "Location: {$this->router->generate('error403')}" );
            exit;

        } else {
            unset($_SESSION['token']);
        }

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