<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Questions extends CoreGame {

    /**
     * Undocumented function
     *
     * @return Questions
     */
    static public function findQuestionsByRaceAndYear($yearId, $raceId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM questions WHERE year_id = :yearId AND race_id= :raceId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",   $yearId,   PDO::PARAM_INT);
        $query->bindValue(":raceId",   $raceId,   PDO::PARAM_INT);

        $query->execute();

        return $query->fetchObject(Questions::class);
    }

}