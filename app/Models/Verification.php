<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Verification extends CoreGame {

    /**
     * Undocumented function
     *
     * @return Verification
     */
    static public function showByRaceId($raceId, $yearId) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM verification WHERE race_id= :raceId AND year_id= :yearId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",     $yearId,      PDO::PARAM_INT);
        $query->bindValue(":raceId",     $raceId,      PDO::PARAM_INT);

        $query->execute();

        return $query->fetchObject(Verification::class);
    }

}