<?php

namespace App\Models;

use App\Utils\Database;

class Verification extends CoreGame {

    public function verif($msId, $tcId, $sgId, $bcId, $jsId, $mtId, $b16Id, $ssId, $sbId, $b1Id, $b2Id, $raceId, $yearId) {

        $this->setMaxiSprint($msId);
        $this->setTourismeCup($tcId);
        $this->setSprintGirls($sgId);
        $this->setBuggyCup($bcId);
        $this->setJuniorSprint($jsId);
        $this->setMaxiTourisme($mtId);
        $this->setBuggy1600($b16Id);
        $this->setsuperSprint($ssId);
        $this->setSuperBuggy($sbId);
        $this->setBonus1($b1Id);
        $this->setBonus2($b2Id);
        $this->setRaceId($raceId);
        $this->setYearId($yearId);

        $pdo = Database::getPDO();

        $sql = "INSERT INTO `verification` (`maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`, `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`) VALUES (
            '{$this->getMaxiSprint()}', 
            '{$this->getTourismeCup()}', 
            '{$this->getSprintGirls()}',
            '{$this->getBuggyCup()}', 
            '{$this->getJuniorSprint()}', 
            '{$this->getMaxiTourisme()}', 
            '{$this->getBuggy1600()}', 
            '{$this->getSuperSprint()}', 
            '{$this->getSuperBuggy()}', 
            '{$this->getBonus1()}', 
            '{$this->getBonus2()}', 
            '{$this->getRaceId()}',
            '{$this->getYearId()}')";

        $pdoStatement = $pdo->exec($sql);

        if ($pdoStatement === 1) {
            exit("Vérification insérée en BDD");
        } else {
            exit("Erreur !");
        }
    }

    public function showByRaceId($raceId, $yearId) {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM verification WHERE race_id='$raceId' AND year_id='$yearId'");

        return $pdoStatement->fetchObject(Verification::class);
    }

}