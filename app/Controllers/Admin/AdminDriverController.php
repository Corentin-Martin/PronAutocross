<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\Rate;

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

        $rateByDriverId = [];
        foreach ($drivers as $driver) {
            $rate = Rate::findRateByDriverId($driver->getId(), date('Y'));
            $rateByDriverId[$driver->getId()] = $rate;
        }

        $this->show('admin/driver/list', ['drivers' => $drivers, 'categoriesById' => $categoriesById, 'action' => $action, 'categoryId' => $categoryId, 'rate' => $rateByDriverId]);
    }

    public function addOrEdit($id = null) {
        $categories = Category::findAll();

        if ($id) {
            $driver = Driver::find($id);
        } else {
            $driver = null;
        }

        $this->show('admin/driver/add', ['categories' => $categories, 'driver' => $driver]);
    }

    public function createOrUpdate($id = null) {
        if (isset($_POST)) {
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
            $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT);
            $vehicle = filter_input(INPUT_POST, 'vehicle', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
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

            if ($id) {
            $driver->setId($id);
            } 

            if ($driver->createOrUpdate()) {

                if (is_null($id)) {
                    $rate = new Rate();

                    $rate->setRate1(10);
                    $rate->setRate2(10);
                    $rate->setOverall(10);
                    $rate->setDriverId($driver->getId());
                    $rate->setYearId(date('Y'));

                    if ($rate->createOrUpdate()) {
                        header("Location: {$this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number'])}");
                        exit; 
                    } else {
                        echo "Erreur";
                        exit;
                    }
                } else {
                    header("Location: {$this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number'])}");
                    exit; 
                }
                
            } else {
                echo "<p> Erreur, pilote non ajouté </p>";
                exit;
            }

        } else {
            header("Location: {$this->router->generate('driver-home')}");
            exit; 
        }
    }

   

    public function delete($id) {

        $driver = Driver::find($id);

        $categoryId = $driver->getCategoryId();

        if ($driver->delete()) {

            header("Location: {$this->router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'id'])}");
            exit;

        } else {
            exit ("erreur");
        }
        
    }


}