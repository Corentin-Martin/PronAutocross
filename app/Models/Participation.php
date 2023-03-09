<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Participation extends CoreGame {

    private $player_id;
    private $verification_id;

    public function getPlayerId(){ return $this->player_id; }
    public function setPlayerId($player_id): self { $this->player_id = $player_id; return $this; }

    public function getVerificationId(){ return $this->verification_id; }
    public function setVerificationId($verification_id): self { $this->verification_id = $verification_id; return $this; }

    public function play($playerId, $msId, $tcId, $sgId, $bcId, $jsId, $mtId, $b16Id, $ssId, $sbId, $b1Id, $b2Id, $raceId, $yearId) {

        $this->setPlayerId($playerId);
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

        $sql = "INSERT INTO `participation` (`player_id`, `maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`, `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`) VALUES (
            '{$this->getPlayerId()}',
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
            '{$this->getRaceId()}'),
            '{$this->getYearId()}')";

        $pdoStatement = $pdo->exec($sql);

        if ($pdoStatement === 1) {
            exit("Participation validée");
        } else {
            exit("Erreur !");
        }
    }

    public function showAllParticipations($yearId, $raceId) {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM participation WHERE year_id='$yearId' AND race_id='$raceId'");

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Participation::class);
    }

    public function showAllForADriver($yearId, $raceId, $driverId) {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM participation WHERE year_id='$yearId' AND race_id='$raceId' AND (maxiSprint='$driverId' OR tourismeCup='$driverId' OR sprintGirls='$driverId' OR buggyCup='$driverId' OR juniorSprint='$driverId' OR maxiTourisme='$driverId' OR buggy1600='$driverId' OR superSprint='$driverId' OR superBuggy='$driverId') ");

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Participation::class);
    }

}