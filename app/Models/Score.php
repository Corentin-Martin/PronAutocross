<?php

namespace App\Models;

use App\Models\Verification;
use App\Models\Participation;
use App\Utils\Database;
use PDO;

class Score extends CoreGame {
    
    private $total;
    private $player_id;
    private $participation_id;

    public function getTotal(){ return $this->total; }
    public function setTotal($total): self { $this->total = $total; return $this; }

    public function getPlayerId(){ return $this->player_id; }
    public function setPlayerId($player_id): self { $this->player_id = $player_id; return $this; }

    public function getParticipationId(){ return $this->participation_id; }
    public function setParticipationId($participation_id): self { $this->participation_id = $participation_id; return $this; }

    public function calcul($raceId) {

        $participationModel = new Participation();
        $participations = $participationModel->showAllParticipations($raceId);

        foreach ($participations as $participation) {

            $verifModel = new Verification();
            $verif = $verifModel->show($raceId);

            if ($verif->getMaxiSprint() === $participation->getMaxiSprint()) {
                $this->setMaxiSprint(10);
            } else {
                $this->setMaxiSprint(0);
            }

            $this->setPlayerId($participation->getPlayerId());
            $this->setParticipationId($participation->getId());
            $this->setRaceId($participation->getRaceId());
            
            $total = $this->getMaxiSprint();

            $this->setTotal($total);

            $pdo = Database::getPDO();

            $sql = "INSERT INTO `score` (
                `player_id`,
                `maxiSprint`,
                `tourismeCup`,
                `sprintGirls`,
                `buggyCup`,
                `juniorSprint`, 
                `maxiTourisme`,
                `buggy1600`,
                `superSprint`,
                `superBuggy`, 
                `bonus1`,
                `bonus2`,
                `total`,
                `race_id`,
                `participation_id`) 
                VALUES (
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
                '{$this->getTotal()}', 
                '{$this->getRaceId()}',
                '{$this->getParticipationId()}'
                )";
    
            $pdoStatement = $pdo->exec($sql);
        }
    }

    public function sortingDesc($raceId) {

        $pdo = Database::getPDO();

            $sql = "SELECT * FROM `score` WHERE race_id=$raceId ORDER BY `total` DESC";

            $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Score::class);
    }


}