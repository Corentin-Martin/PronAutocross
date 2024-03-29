<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class GeneralScore extends CoreModel
{
    private $player_id;
    private $year_id;
    private $total;
    private $place;

    public function getPlayerId(){ return $this->player_id; }
    public function setPlayerId($player_id): self { $this->player_id = $player_id; return $this; }

    public function getYearId(){ return $this->year_id; }
    public function setYearId($year_id): self { $this->year_id = $year_id; return $this; }

    public function getTotal(){ return $this->total; }
    public function setTotal($total): self { $this->total = $total; return $this; }

    public function getPlace(){ return $this->place; }
    public function setPlace($place): self { $this->place = $place; return $this; }

    public function createOrUpdate() {
        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `general_score` SET `player_id`= :playerId, `year_id` = :yearId, `total` = :total, `updated_at` = NOW() WHERE id = :id";
        } else {
            $sql = "INSERT INTO `general_score` (`player_id`, `year_id`, `total`, `place`, `created_at`) VALUES (:playerId, :yearId, 0, 0, NOW())";
        }

        $query = $pdo->prepare($sql);

        $query->bindValue(":playerId",   $this->player_id,   PDO::PARAM_INT);
        $query->bindValue(":yearId",     $this->year_id,     PDO::PARAM_INT);

        if ($this->id > 0) {

        $query->bindValue(":id",         $this->id,          PDO::PARAM_INT);
        $query->bindValue(":total",      $this->total,       PDO::PARAM_STR);

        }
    
        $query->execute();
    
        if ($query->rowCount() === 1) 
        {
            if (is_null($this->id)) { $this->id = $pdo->lastInsertId();}
            return true;
        } else 
        {
            return false;
        }
    }

    /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return GeneralScore[]
     */
    static public function sortingGeneral($yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT general_score.*, player.pseudo FROM `general_score` JOIN `player` ON player.id = general_score.player_id WHERE general_score.year_id = :yearId AND place > 0 ORDER BY general_score.total DESC, player.pseudo ASC";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",   $yearId,   PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, GeneralScore::class);
    }

    /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return GeneralScore[]
     */
    static public function sortingGeneralToUpdatePlaces($yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT general_score.*, player.pseudo FROM `general_score` JOIN `player` ON player.id = general_score.player_id WHERE general_score.year_id = :yearId ORDER BY general_score.total DESC, player.pseudo ASC";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",   $yearId,   PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, GeneralScore::class);
    }


    /**
     * Undocumented function
     *
     * @return GeneralScore
     */
    static public function findGeneralForPlayer($playerId, $yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `general_score` WHERE player_id = :playerId AND year_id = :yearId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":playerId",   $playerId,   PDO::PARAM_INT);
        $query->bindValue(":yearId",     $yearId,     PDO::PARAM_INT);

        $query->execute();

        return $query->fetchObject(GeneralScore::class);
    }

    public function updatePlace() {
        $pdo = Database::getPDO();

        $sql = "UPDATE `general_score` SET `place`= :place WHERE id = :id";

        $query = $pdo->prepare($sql);

        $query->bindValue(":place",         $this->place,   PDO::PARAM_INT);
        $query->bindValue(":id",         $this->id,          PDO::PARAM_INT);
    
        $query->execute();
    
        return ($query->rowCount() === 1);

    }



}