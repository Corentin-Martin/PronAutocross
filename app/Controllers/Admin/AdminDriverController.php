<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;


class AdminDriverController extends AdminCoreController
{

    public function home() {

        $this->show('admin/driver/home');
    }

    public function list($id, $action) {

        $drivers = Driver::sortAllByForCategory($id,$action);

        $this->show('admin/driver/list', ['drivers' => $drivers]);
    }

    public function add() {

        $categories = Category::findAll(Category::class);

        if (!empty($_GET['firstName'])) {

            $firstName = filter_input(INPUT_GET, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_GET, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
            $number = filter_input(INPUT_GET, 'number', FILTER_VALIDATE_INT);
            $vehicle = filter_input(INPUT_GET, 'vehicle', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);
            $status = filter_input(INPUT_GET, 'status', FILTER_VALIDATE_INT);
            $picture = isset($_GET['picture']) ? filter_input(INPUT_GET, 'picture', FILTER_SANITIZE_SPECIAL_CHARS) : 'assets/images/damier-picto.png';
            $year = filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT);
        
        $driverModel = new Driver();
        $newDriver = $driverModel->newDriver($firstName, $lastName, $number, $vehicle, $categoryId, $status, $year, $picture);
        
        if ($newDriver === 1) {
            global $router;
            header("Location: {$router->generate('driver-add')}");
            exit; 
        } else {
            echo "<p> Erreur, pilote non ajouté </p>";
        }
        
        }


        $this->show('admin/driver/add', ['categories' => $categories]);
    }

    public function edit($driverId) {

        $driver = Driver::find($driverId, Driver::class);

        // $driversToEdit = Driver::edit($thingToUpdate, $table, $driverId);

        $this->show('admin/driver/edit', ['driver' => $driver]);
    }
}