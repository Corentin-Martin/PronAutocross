<?php

namespace App\Models;

use App\Models\Verification;
use App\Models\Category;
use App\Models\Rate;
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

    /**
     * Undocumented function
     *
     * @param int $raceId // L'id de la course
     * @return void
     */
    public function calcul($yearId, $raceId) {

        $participations = Participation::showAllParticipations($yearId, $raceId);

        foreach ($participations as $participation) {

            $verif = Verification::showByRaceId($raceId, $yearId);

            $categories = Category::findAll(Category::class);

            foreach ($categories as $category) {
                $categoryOnVerif = str_replace(" ", "", $category->getName());

                if ($verif->{'get'.$categoryOnVerif}() === $participation->{'get'.$categoryOnVerif}()) {

                    $rate = Rate::findRateByDriverIdForScore($verif->{'get'.$categoryOnVerif}(), $yearId);
                    
                    $pointsToAdd = 10 * $rate->getOverall();
                    $this->{'set'.$categoryOnVerif}($pointsToAdd);
    
                } else {
                    $this->{'set'.$categoryOnVerif}()(0);
                }

            }

            if ($verif->getBonus1() === $participation->getBonus1()) {

                $this->setBonus1(20);
                
            } else {
                $this->setBonus1(0);
            }

            if ($verif->getBonus2() === $participation->getBonus2()) {

                $this->setBonus2(20);
                
            } else {
                $this->setBonus2(0);
            }

            $this->setPlayerId($participation->getPlayerId());
            $this->setParticipationId($participation->getId());
            $this->setRaceId($participation->getRaceId());
            $this->setYearId($participation->getYearId());
            
            $total =  $this->getMaxiSprint() +
            $this->getTourismeCup() +
            $this->getSprintGirls() +
            $this->getBuggyCup() +
            $this->getJuniorSprint() +
            $this->getMaxiTourisme() +
            $this->getBuggy1600() +
            $this->getSuperSprint() +
            $this->getSuperBuggy() +
            $this->getBonus1() +
            $this->getBonus2();

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
                `participation_id`,
                `year_id`) 
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
                '{$this->getParticipationId()}',
                '{$this->getYearId()}'
                )";
    
            $pdoStatement = $pdo->exec($sql);

            $general = GeneralScore::updateTotal($this->getYearId(), $this->getPlayerId(), $this->getTotal());
        }
    }

    /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return Score[]
     */
    public function sortingByRace($year, $raceId) {

        $pdo = Database::getPDO();

            $sql = "SELECT score.*, player.pseudo FROM score JOIN player ON player.id = score.player_id WHERE score.year_id='$year' AND score.race_id='$raceId' ORDER BY score.total DESC, player.pseudo ASC";

            $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Score::class);
    }

    /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return Score[]
     */
    public function findForGeneral($year, $raceId, $playerId) {

        $pdo = Database::getPDO();

            $sql = "SELECT * FROM score WHERE year_id='$year' AND race_id='$raceId' AND player_id='$playerId'";

            $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject(Score::class);
    }

    public function findAllScoresbyPlayerId($playerId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM score WHERE player_id='$playerId'";

        $pdoStatement = $pdo->query($sql);

    return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Score::class);
    }


}