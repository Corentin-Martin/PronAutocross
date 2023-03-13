<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\Rate;

class AdminController extends CoreController
{

    public function entrylist() {

        global $router;

        $categoryModel = new Category();
        $categories = $categoryModel->findAll(Category::class);

        $entryModel = new EntryList();

        $driverModel = new Driver();

        if (!empty($_GET['year'])) {
            $entryModel->make($_GET);

            header("Location: {$router->generate('entrylist')}");
            exit; 
        } 


        $this->show('admin/entrylist', ['categories' => $categories, 'driverModel' => $driverModel]);
    }

    public function driver() {

        $categoryModel = new Category();
        $categories = $categoryModel->findAll(Category::class);

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
            header("Location: {$router->generate('driver')}");
            exit; 
        } else {
            echo "<p> Erreur, pilote non ajouté </p>";
        }
        
        }


        $this->show('admin/driver', ['categories' => $categories]);
    }
}