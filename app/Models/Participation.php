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

    public function create(){

        $pdo = Database::getPDO();

        $sql = "INSERT INTO `participation` 
        (`maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`,
        `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`, `player_id`, `created_at`) 
        VALUES 
        ( :maxiSprint, :tourismeCup, :sprintGirls, :buggyCup, :juniorSprint, :maxiTourisme, :buggy1600, :superSprint, :superBuggy, :bonus1, :bonus2, :raceId, :yearId, :playerId, NOW())";

        
        $query = $pdo->prepare($sql);

        $query->bindValue(":maxiSprint",    $this->maxiSprint,      PDO::PARAM_INT);
        $query->bindValue(":tourismeCup",   $this->tourismeCup,     PDO::PARAM_INT);
        $query->bindValue(":sprintGirls",   $this->sprintGirls,     PDO::PARAM_INT);
        $query->bindValue(":buggyCup",      $this->buggyCup,        PDO::PARAM_INT);
        $query->bindValue(":juniorSprint",  $this->juniorSprint,    PDO::PARAM_INT);
        $query->bindValue(":maxiTourisme",  $this->maxiTourisme,    PDO::PARAM_INT);
        $query->bindValue(":buggy1600",     $this->buggy1600,       PDO::PARAM_INT);
        $query->bindValue(":superSprint",   $this->superSprint,     PDO::PARAM_INT);
        $query->bindValue(":superBuggy",    $this->superBuggy,      PDO::PARAM_INT);
        $query->bindValue(":bonus1",        $this->bonus1,          PDO::PARAM_STR);
        $query->bindValue(":bonus2",        $this->bonus2,          PDO::PARAM_STR);
        $query->bindValue(":raceId",        $this->race_id,         PDO::PARAM_INT);
        $query->bindValue(":yearId",        $this->year_id,         PDO::PARAM_INT);
        $query->bindValue(":playerId",      $this->player_id,       PDO::PARAM_INT);

        $query->execute();

        if ($query->rowCount() === 1) {

            $this->id = $pdo->lastInsertId();
            return true;

        } else {
            return false;
        }
    }

    /**
     * Undocumented function
     *
     * @return Participation[]
     */
    static public function showAllParticipations($yearId, $raceId) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM participation WHERE year_id= :yearId AND race_id= :raceId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":raceId",        $raceId,         PDO::PARAM_INT);
        $query->bindValue(":yearId",        $yearId,         PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Participation::class);
    }

    /**
     * Undocumented function
     *
     * @return Participation[]
     */
    static public function showAllForADriver($yearId, $raceId, $driverId) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM participation WHERE year_id= :yearId AND race_id= :raceId AND (maxiSprint= :driverId OR tourismeCup= :driverId OR sprintGirls= :driverId OR buggyCup= :driverId OR juniorSprint= :driverId OR maxiTourisme= :driverId OR buggy1600= :driverId OR superSprint= :driverId OR superBuggy= :driverId) ";

        $query = $pdo->prepare($sql);

        $query->bindValue(":raceId",        $raceId,         PDO::PARAM_INT);
        $query->bindValue(":yearId",        $yearId,         PDO::PARAM_INT);
        $query->bindValue(":driverId",      $driverId,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Participation::class);
    }

        /**
     * Undocumented function
     *
     * @return Participation
     */
    static public function checkForAPlayer($yearId, $raceId, $playerId) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM participation WHERE year_id= :yearId AND race_id= :raceId AND player_id= :playerId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":raceId",        $raceId,         PDO::PARAM_INT);
        $query->bindValue(":yearId",        $yearId,         PDO::PARAM_INT);
        $query->bindValue(":playerId",      $playerId,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchObject(Participation::class);
    }

    /**
     * Undocumented function
     *
     * @return Participation[]
     */
    static public function showAllForAPlayer($yearId, $playerId) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM participation WHERE year_id= :yearId AND player_id= :playerId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",        $yearId,         PDO::PARAM_INT);
        $query->bindValue(":playerId",      $playerId,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Participation::class);
    }

}