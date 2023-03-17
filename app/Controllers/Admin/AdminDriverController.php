<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;


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

    public function add() {

        $categories = Category::findAll();

        $this->show('admin/driver/add', ['categories' => $categories]);
    }

    public function create() {

        if (isset($_POST)) {

            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
            $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT);
            $vehicle = filter_input(INPUT_POST, 'vehicle', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
            $picture = isset($_POST['picture']) ? filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS) : 'assets/images/damier-picto.png';
        
        $driver = new Driver();

        $driver->setFirstName($firstName);
        $driver->setLastName($lastName);
        $driver->setNumber($number);
        $driver->setVehicle($vehicle);
        $driver->setCategoryId($categoryId);
        $driver->setStatus($status);
        $driver->setPicture($picture);
        
        if ($driver->createOrUpdate()) {

            // TO DO APPELER RATE CREATE
            global $router;
            header("Location: {$router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number'])}");
            exit; 
        } else {
            echo "<p> Erreur, pilote non ajouté </p>";
        }
        
        }
    }

    public function edit($driverId) {

        $driver = Driver::find($driverId);

        // $driversToEdit = Driver::edit($thingToUpdate, $table, $driverId);

        $categories = Category::findAll();
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $this->show('admin/driver/edit', ['driver' => $driver, 'categoriesById' => $categoriesById]);
    }

    public function makeEdit($driverId) {

        if (isset($_POST)) {
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
            $number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT);
            $vehicle = filter_input(INPUT_POST, 'vehicle', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
            $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT);
            $picture = isset($_POST['picture']) ? filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS) : 'assets/images/damier-picto.png';

            $driverModel = new Driver();
            $DriverEdited = $driverModel->edit($firstName, $lastName, $number, $vehicle, $categoryId, $status, $picture, $driverId);

            // TO DO REGARDER POURQUOI LA REQUETE BLOQUE !
        
        if ($DriverEdited === 1) {
            global $router;
            header("Location: {$router->generate('driver-list', ['categoryId' => $categoryId, 'action' => 'number'])}");
            exit; 
        } else {
            echo "<p> Erreur, pilote non édité </p>";
        }
        
        }
    }


}