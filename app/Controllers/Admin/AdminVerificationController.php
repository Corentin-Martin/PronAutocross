<?php

namespace App\Controllers\Admin;

use App\Models\Verification;

class AdminVerificationController extends AdminCoreController
{

    public function add() {

        global $router;

        // TO DO TRAITER FORMULAIRE DE VALIDATION


        $this->show('admin/verification/add');
    }

    public function home() {
        $this->show('admin/verification/home');
    }

    public function list($year, $id) {

        $verification = Verification::showByRaceId($id, $year);

        $this->show('admin/verification/list', ['verification' => $verification]);
    }
}