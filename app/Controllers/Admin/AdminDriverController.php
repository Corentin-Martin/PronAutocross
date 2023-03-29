<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\Participation;
use App\Models\Race;

class AdminDriverController extends AdminCoreController
{

    public function home() {

        $this->show('admin/driver/home');
    }

    public function list($categoryId, $action) {

        $drivers = Driver::sortAllByForCategory($categoryId,$action);

        $categories = Category::findAll();
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $this->show('admin/driver/list', ['drivers' => $drivers, 'categoriesById' => $categoriesById, 'action' => $action, 'categoryId' => $categoryId]);
    }

    public function addOrEdit($id = null) {
        $categories = Category::findAll();

        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        if ($id) {
            $driver = Driver::find($id);
        } else {
            $driver = null;
        }

        $this->show('admin/driver/add', ['categories' => $categoriesById, 'driver' => $driver]);
    }

    public function createOrUpdate($id = null) {
        if (isset($_POST)) {
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
            $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT);
            $vehicle = filter_input(INPUT_POST, 'vehicle', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
            $place = filter_input(INPUT_POST, 'place', FILTER_VALIDATE_INT);
            $rate1 = filter_input(INPUT_POST, 'rate1', FILTER_VALIDATE_FLOAT);
            $rate2 = filter_input(INPUT_POST, 'rate2', FILTER_VALIDATE_FLOAT);
            $overall = filter_input(INPUT_POST, 'overall', FILTER_VALIDATE_FLOAT);
            $picture = isset($_POST['picture']) ? filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS) : 'assets/images/damier-picto.png';

            if ($id) {
                $driver = Driver::find($id);
            } else {
                $driver = new Driver();
            }

            $driver->setFirstName($firstName);
            $driver->setLastName($lastName);
            $driver->setNumber($number);
            $driver->setVehicle($vehicle);
            $driver->setCategoryId($categoryId);
            $driver->setStatus($status);
            $driver->setPicture($picture);
            $driver->setPlace($place);
            $driver->setRate1($rate1);
            $driver->setRate2($rate2);
            $driver->setOverall($overall);

            if ($id) {
            $driver->setId($id);
            } 

            if ($driver->createOrUpdate()) {

                header("Location: {$this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number'])}");
                exit; 

            } else {
                echo "<p> Erreur, pilote non ajouté </p>";
                exit;
            }

        } else {
            header("Location: {$this->router->generate('driver-home')}");
            exit; 
        }
    }

    public function delete($id, $token) {
        
        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';


        if (hex2bin($token) !== $sessionToken) {

            header( "Location: {$this->router->generate('error403')}" );
            exit;

        } else {
            unset($_SESSION['token']);
        }

        $driver = Driver::find($id);

        $categoryId = $driver->getCategoryId();

        if ($driver->delete()) {

            header("Location: {$this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'id'])}");
            exit;

        } else {
            exit ("erreur");
        }
        
    }

    public function editPlaces() {

        $categories = Category::findAll();

        $drivers = [];

        foreach ($categories as $category) {
            $drivers[$category->getId()] = Driver::findAllByCategory($category->getId());
        }

        $this->show('admin/driver/standings', ['categories' => $categories, 'drivers' => $drivers]);
    }

    public function updatePlaces() {

        $errorList = [];

        foreach ($_POST['place'] as $categoryId => $content) {

            $uniqueCategory = array_unique($content);

            if (count($uniqueCategory) !== $content) {
                $category = Category::find($categoryId);
                $errorList[] = 'Attention, un pilote est en double en ' . $category->getName() . " !";
            }
        }

        if (empty($errorList)) {

            $drivers = Driver::findAll();
            foreach ($drivers as $driver) {
                $driver->setPlace(0);
                $driver->createOrUpdate();
            }

            foreach ($_POST['place'] as $category) {
                foreach ($category as $place => $driverId) {

                    if ($driverId !== '') {
                        $driver = Driver::find($driverId);
                        $driver->setPlace($place);
                        $driver->createOrUpdate();
                    }
                }
            }

            header("Location: {$this->router->generate('driver-editPlaces')}");
            exit;
        }

        $categories = Category::findAll();

        $drivers = [];

        foreach ($categories as $category) {
            $drivers[$category->getId()] = Driver::findAllByCategory($category->getId());
        }

        $this->show('admin/driver/standings', ['categories' => $categories, 'drivers' => $drivers, 'errorList' => $errorList]);

    }

    public function editRates($id) {

        $races = Race::findByYear(date('Y'));

        $this->show('admin/driver/editRates', ['races' => $races]);
    }

    public function updateRates($raceId) {
        $participations = count(Participation::showAllParticipations(date('Y'), $raceId));

        $drivers = Driver::findAll();

        foreach ($drivers as $driver) {

            $entry = EntryList::findDriverParticipation(date('Y'), $raceId, $driver->getId());

            if ($entry) {
                $driverVotes = count(Participation::showAllForADriver(date('Y'), $raceId, $driver->getId()));

                if ($driverVotes === 0) {
                    $newRate = 20;
                } else {
                    $percentage = $driverVotes * 100 / $participations;
        
                    $newRate = 30 / $percentage;
            
                    if ($newRate > 20) {
                        $newRate = 20;
                    } elseif ($newRate <= 1) {
                        $newRate = 1.01;
                    }
                }
        
                $rate2 = $driver->getRate2();
        
                $averageRate = ($newRate + $rate2) / 2;

                $coeff = [
                    0 => 9,
                    1 => 1.01,
                    2 => 1.25,
                    3 => 1.50,
                    4 => 1.70,
                    5 => 1.80,
                    6 => 2.30,
                    7 => 2.50,
                    8 => 3.30,
                    9 => 3.90,
                    10 => 4.20,
                ];

                $rateWithPlace = round((($averageRate + $coeff[$driver->getPlace()]) / 2), 2);
        
                $driver->setRate1($rate2);
                $driver->setRate2($newRate);
                $driver->setOverall($rateWithPlace);
                
                $driver->createOrUpdate();
            }

        }

        header("Location: {$this->router->generate('driver-list', ['categoryId' => 1, 'action' => 'number'])}");
        exit;
    }
}