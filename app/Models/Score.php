<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Score extends CoreGame {
    
    private $total;
    private $player_id;
    private $participation_id;
    private $place;

    public function getTotal(){ return $this->total; }
    public function setTotal($total): self { $this->total = $total; return $this; }

    public function getPlayerId(){ return $this->player_id; }
    public function setPlayerId($player_id): self { $this->player_id = $player_id; return $this; }

    public function getParticipationId(){ return $this->participation_id; }
    public function setParticipationId($participation_id): self { $this->participation_id = $participation_id; return $this; }

    public function getPlace(){ return $this->place; }
    public function setPlace($place): self { $this->place = $place; return $this; }

    public function createOrUpdate() {

        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `score` SET `maxiSprint`= :maxiSprint, `tourismeCup` = :tourismeCup, `sprintGirls` = :sprintGirls, `buggyCup` = :buggyCup, `juniorSprint` = :juniorSprint, `maxiTourisme` = :maxiTourisme, `buggy1600` = :buggy1600, `superSprint` = :superSprint, `superBuggy` = :superBuggy, `bonus1` = :bonus1, `bonus2` = :bonus2, `race_id` = :raceId, `year_id` = :yearId, `participation_id` = :participationId, `total` = :total, `player_id` = :playerId, `updated_at` = NOW() WHERE id = :id";
        } else {
            $sql = "INSERT INTO `score` 
            (`maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`,
            `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`, `participation_id`, `total`, `player_id`, `created_at`) 
            VALUES 
            ( :maxiSprint, :tourismeCup, :sprintGirls, :buggyCup, :juniorSprint, :maxiTourisme, :buggy1600, :superSprint, :superBuggy, :bonus1, :bonus2, :raceId, :yearId, :participationId, :total, :playerId, NOW())";
        }
        
        $query = $pdo->prepare($sql);


        $query->bindValue(":maxiSprint",        $this->maxiSprint,          PDO::PARAM_STR);
        $query->bindValue(":tourismeCup",       $this->tourismeCup,         PDO::PARAM_STR);
        $query->bindValue(":sprintGirls",       $this->sprintGirls,         PDO::PARAM_STR);
        $query->bindValue(":buggyCup",          $this->buggyCup,            PDO::PARAM_STR);
        $query->bindValue(":juniorSprint",      $this->juniorSprint,        PDO::PARAM_STR);
        $query->bindValue(":maxiTourisme",      $this->maxiTourisme,        PDO::PARAM_STR);
        $query->bindValue(":buggy1600",         $this->buggy1600,           PDO::PARAM_STR);
        $query->bindValue(":superSprint",       $this->superSprint,         PDO::PARAM_STR);
        $query->bindValue(":superBuggy",        $this->superBuggy,          PDO::PARAM_STR);
        $query->bindValue(":bonus1",            $this->bonus1,              PDO::PARAM_STR);
        $query->bindValue(":bonus2",            $this->bonus2,              PDO::PARAM_STR);
        $query->bindValue(":raceId",            $this->race_id,             PDO::PARAM_INT);
        $query->bindValue(":yearId",            $this->year_id,             PDO::PARAM_INT);
        $query->bindValue(":participationId",   $this->participation_id,    PDO::PARAM_INT);
        $query->bindValue(":total",             $this->total,               PDO::PARAM_STR);
        $query->bindValue(":playerId",          $this->player_id,           PDO::PARAM_INT);

        if ($this->id > 0) {

        $query->bindValue(":id",                $this->id,                  PDO::PARAM_INT);

        }

        $query->execute();

        if ($query->rowCount() === 1) {

        if (is_null($this->id)) {

            $this->id = $pdo->lastInsertId();
        }
            return true;

        } else {
            return false;
        }
    }

    /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return Score[]
     */
    static public function sortingByRace($year, $raceId) {

        $pdo = Database::getPDO();

        $sql = "SELECT score.*, player.pseudo FROM score JOIN player ON player.id = score.player_id WHERE score.year_id= :yearId AND score.race_id= :raceId ORDER BY score.total DESC, player.pseudo ASC";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",          $year,        PDO::PARAM_INT);
        $query->bindValue(":raceId",          $raceId,      PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Score::class);
    }

    /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return Score
     */
    static public function findForGeneral($year, $raceId, $playerId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM score WHERE year_id= :yearId AND race_id= :raceId AND player_id= :playerId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",       $year,           PDO::PARAM_INT);
        $query->bindValue(":raceId",       $raceId,         PDO::PARAM_INT);
        $query->bindValue(":playerId",     $playerId,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchObject(Score::class);
    }

    /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return Score[]
     */
    static public function findAllScoresbyPlayerId($playerId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM score WHERE player_id= :playerId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":playerId", $playerId, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Score::class);
    }

    public function updatePlace() {

        $pdo = Database::getPDO();

        $sql =  "UPDATE `score` SET `place`= :place WHERE id = :id";
        
        
        $query = $pdo->prepare($sql);

        $query->bindValue(":place",          $this->place,           PDO::PARAM_INT);
        $query->bindValue(":id",                $this->id,           PDO::PARAM_INT);


        $query->execute();

        return ($query->rowCount() === 1);

    }




}