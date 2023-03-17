<?php

namespace App\Controllers\Admin;

use App\Models\Race;
use App\Models\Year;

class AdminRaceController extends AdminCoreController
{

    public function home() {


        $this->show('admin/race/home' );
    }

    public function add() {


        $years = Year::findAll();


        $this->show('admin/race/add', ['years' => $years]);
    }

    public function create() {


        if (isset($_POST)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
            $poster = isset($_POST['poster']) ? filter_input(INPUT_POST, 'poster', FILTER_SANITIZE_SPECIAL_CHARS) : 'assets/images/genericposter.png';

            $raceModel = new Race();
            $insertion = $raceModel->insertRace($name, $date, $poster, $year);

            if ($insertion === 1) {
                global $router;
                header("Location: {$router->generate('race-list', ['year' => $year])}");
                exit; 
            } else {
                echo "<p> Erreur, épreuve non ajoutée </p>";
            }
    

        }

    }

    public function list($year) {

        $races = Race::findByYear($year);

        $years = Year::findAll();

        $this->show('admin/race/list', ['races' => $races, 'currentYear' => $year, 'years' => $years]);
    }
}