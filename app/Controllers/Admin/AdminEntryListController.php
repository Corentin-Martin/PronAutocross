<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\Race;
use App\Models\Year;

class AdminEntryListController extends AdminCoreController
{

    public function add() {

        $categories = Category::findAll();

        $availablePrio = [];
        $availableInvit = [];
        foreach ($categories as $category) {
            $driversPrio = Driver::findByCategoryAndStatus($category->getId(), 1);
            $driversInvit = Driver::findByCategoryAndStatus($category->getId(), 0);

            $availablePrio[$category->getId()] = $driversPrio;
            $availableInvit[$category->getId()] = $driversInvit;
        }

        $this->show('admin/entrylist/add', ['categories' => $categories, 'prioritaires' => $availablePrio, 'invites' => $availableInvit]);
    }

    public function create() {
        if (isset($_POST)) {
            $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
            $raceId = filter_input(INPUT_POST, 'race', FILTER_VALIDATE_INT);

            foreach (array_slice(array_keys($_POST), 2) as $driverId) {
                $driver = Driver::find($driverId);

                if ($driver) {
                    $newEntry = new EntryList();

                    $newEntry->setYearId($year);
                    $newEntry->setRaceId($raceId);
                    $newEntry->setCategoryId($driver->getCategoryId());
                    $newEntry->setDriverId($driver->getId());

                    $newEntry->create();
                }
            }
            global $router;
            header("Location: {$router->generate('entrylist-home')}");
            exit;
        }
    }

    public function deletelist($year, $raceId) {

        $entries = new EntryList();

        $count = $entries->deleteList($year, $raceId);

        if ($count > 0) {

            global $router;
            header("Location :  {$router->generate('entrylist-home')}");
            exit;

        } else {
            exit ("erreur");
        }
    }

    public function deleteentry($id) {

        $entry = EntryList::find($id);

        if ($entry->delete()) {

            global $router;
            header("Location :  {$router->generate('entrylist-home')}");
            exit;

            // TO DO ATTENTION ERREUR MAIS EXEC OK

        } else {
            exit ("erreur");
        }
    }

    public function home() {
        $this->show('admin/entrylist/home');
    }

    public function list($year, $id) {

        global $router;

        $years = Year::findAll();

        $categories = Category::findAll();
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        $races = Race::findByYear($year);
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $drivers = Driver::findAll();
        $driversById = [];
        foreach ($drivers as $driver) {
            $driversById[$driver->getId()] = $driver;
        }


        $entrylist = EntryList::listByRace($year, $id);

        $this->show('admin/entrylist/list', ['entrylist' => $entrylist, 'category' => $categoriesById, 'driver' => $driversById, 'races' => $racesById, 'currentYear' => $year, 'years' => $years, 'raceId' => $id]);
    }
}