<?php

namespace App\Controllers\Admin;

use App\Models\Race;

class AdminRaceController extends AdminCoreController
{

    public function add() {

        global $router;

        // TO DO TRAITER FORMULAIRE DE VALIDATION


        $this->show('admin/race/add');
    }

    public function list() {

        $races = Race::findAll(Race::class);

        $this->show('admin/race/list', ['races' => $races]);
    }
}