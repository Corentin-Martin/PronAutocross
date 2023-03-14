<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class GeneralScore extends CoreModel
{
    private $player_id;
    private $year_id;
    private $total;

    public function getPlayerId(){ return $this->player_id; }
    public function setPlayerId($player_id): self { $this->player_id = $player_id; return $this; }

    public function getYearId(){ return $this->year_id; }
    public function setYearId($year_id): self { $this->year_id = $year_id; return $this; }

    public function getTotal(){ return $this->total; }
    public function setTotal($total): self { $this->total = $total; return $this; }

    static public function createGeneral($playerId, $yearId, $total = 0) {

        $pdo = Database::getPDO();

        $sql = "INSERT INTO general_score (`player_id`, `year_id`, `total`) VALUES ('$playerId', '$yearId', '$total')";

        return $pdoStatement = $pdo->exec($sql);

    }

    static public function updateTotal($yearId, $playerId, $points) {

        $pdo = Database::getPDO();

        $sql = "UPDATE general_score SET total = $points WHERE player_id = $playerId AND year_id = $yearId";

        return $pdoStatement = $pdo->exec($sql);

    }

            /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return Score[]
     */
    public function sortingGeneral($yearId) {

        $pdo = Database::getPDO();

            $sql = "SELECT general_score.*, player.pseudo FROM `general_score` JOIN `player` ON player.id = general_score.player_id WHERE general_score.year_id = $yearId ORDER BY general_score.total DESC, player.pseudo ASC";

            $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, GeneralScore::class);
    }

    public function findGeneralForPlayer($playerId) {

        $pdo = Database::getPDO();

            $sql = "SELECT * FROM `general_score` WHERE player_id = '$playerId'";

            $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject(GeneralScore::class);
    }


}