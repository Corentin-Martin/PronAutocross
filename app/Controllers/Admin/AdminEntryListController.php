<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\Race;

class AdminEntryListController extends AdminCoreController
{

    public function add() {

        $categories = Category::findAll(Category::class);

        $driverModel = new Driver();

        $this->show('admin/entrylist/add', ['categories' => $categories, 'driverModel' => $driverModel]);
    }

    public function create() {

        if (isset($_POST)) {
            $entrylist = EntryList::make($_POST);
            global $router;
            header("Location: {$router->generate('entrylist-home')}");
            exit; 
        } 
    }

    public function home() {
        global $router; 
        $this->show('admin/entrylist/home');
    }

    public function list($year, $id) {

        global $router;

        $categories = Category::findAll(Category::class);
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $races = Race::findAll(Race::class);
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $drivers = Driver::findAll(Driver::class);
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }


        $entrylist = EntryList::listByRace($year, $id);

        $this->show('admin/entrylist/list', ['entrylist' => $entrylist, 'category' => $categoriesById, 'driver' => $driversById, 'race' => $racesById, 'year' => $year, 'raceId' => $id]);
    }
}