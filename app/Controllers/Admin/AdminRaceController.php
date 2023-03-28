<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Race;
use App\Models\Year;

class AdminRaceController extends AdminCoreController
{

    public function home() {


        $this->show('admin/race/home' );
    }

    public function addOrEdit($id = null) {

        if ($id) {
            $race = Race::find($id);
        } else {
            $race = null;
        }

        $years = Year::findAll();


        $this->show('admin/race/add', ['years' => $years, 'race' => $race]);
    }

    public function createOrUpdate($id = null) {


        if (isset($_POST)) {

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
            $poster = isset($_POST['poster']) ? filter_input(INPUT_POST, 'poster', FILTER_SANITIZE_SPECIAL_CHARS) : 'assets/images/genericposter.png';

            if ($id) {
                $race = Race::find($id);
            } else {
                $race = new Race();  
            }

            $race->setName($name);
            $race->setDate($date);
            $race->setPoster($poster);
            $race->setYearId($year);

            if($id) {
                $race->setId($id);
            }


            if ($race->createOrUpdate()) {
                header("Location: {$this->router->generate('race-list', ['year' => $year])}");
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

    public function delete($id, $token) {

        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

        if (hex2bin($token) !== $sessionToken) {

            header( "Location: {$this->router->generate('error403')}" );
            exit;

        } else {
            unset($_SESSION['token']);
        }

        $race = Race::find($id);

        $year = $race->getYearId();

        if ($race->delete()) {

            header("Location: {$this->router->generate('race-list', ['year' => $year])}");
            exit;

        } else {
            exit ("erreur");
        }
        
    }
}