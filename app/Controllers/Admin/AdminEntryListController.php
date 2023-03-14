<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;

class AdminEntryListController extends AdminCoreController
{

    public function add() {

        global $router;

        $categories = Category::findAll(Category::class);

        $driverModel = new Driver();

        if (!empty($_GET['year'])) {
            $entrylist = EntryList::make($_GET);

            header("Location: {$router->generate('entrylist')}");
            exit; 
        } 


        $this->show('admin/entrylist/add', ['categories' => $categories, 'driverModel' => $driverModel]);
    }

    public function home() {
        $this->show('admin/entrylist/home');
    }

    public function list($year, $id) {

        $entrylist = EntryList::listByRace($year, $id);

        $this->show('admin/entrylist/list', ['entrylist' => $entrylist]);
    }
}