<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Verification extends CoreGame {

    public function verif() {

        $pdo = Database::getPDO();

        $sql = 
        "INSERT INTO 
        `verification` (`maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`, `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`) 
        VALUES ( :maxiSprint, :tourismeCup, :sprintGirls, :buggyCup, :juniorSprint, :maxiTourisme, :buggy1600, :superSprint, :superBuggy, :bonus1, :bonus2, :raceId, :yearId)";

        $query = $pdo->prepare($sql);

        $query->bindValue(":maxiSprint", $this->maxiSprint, PDO::PARAM_INT);
        $query->bindValue(":tourismeCup", $this->tourismeCup, PDO::PARAM_INT);
        $query->bindValue(":sprintGirls", $this->sprintGirls, PDO::PARAM_INT);
        $query->bindValue(":buggyCup", $this->buggyCup, PDO::PARAM_INT);
        $query->bindValue(":juniorSprint", $this->juniorSprint, PDO::PARAM_INT);
        $query->bindValue(":maxiTourisme", $this->maxiTourisme, PDO::PARAM_INT);
        $query->bindValue(":buggy1600", $this->buggy1600, PDO::PARAM_INT);
        $query->bindValue(":superSprint", $this->superSprint, PDO::PARAM_INT);
        $query->bindValue(":superBuggy", $this->superBuggy, PDO::PARAM_INT);
        $query->bindValue(":bonus1", $this->bonus1, PDO::PARAM_STR);
        $query->bindValue(":bonus2", $this->bonus2, PDO::PARAM_STR);
        $query->bindValue(":raceId", $this->race_id, PDO::PARAM_INT);
        $query->bindValue(":yearId", $this->year_id, PDO::PARAM_INT);

        $query->execute();

        if ($query->rowCount() === 1) {

            $this->id = $pdo->lastInsertId();
            return true;

        } else {
            return false;
        }

    }

    public function update() {
        $pdo = Database::getPDO();

        $sql = 
        "UPDATE verification SET `maxiSprint`= :maxiSprint, `tourismeCup` = :tourismeCup, `sprintGirls` = :sprintGirls, `buggyCup` = :buggyCup, `juniorSprint` = :juniorSprint, `maxiTourisme` = :maxiTourisme, `buggy1600` = :buggy1600, `superSprint` = :superSprint, `superBuggy` = :superBuggy, `bonus1` = :bonus1, `bonus2` = :bonus2 WHERE id = :id";

        $query = $pdo->prepare($sql);

        $query->bindValue(":maxiSprint", $this->maxiSprint, PDO::PARAM_INT);
        $query->bindValue(":tourismeCup", $this->tourismeCup, PDO::PARAM_INT);
        $query->bindValue(":sprintGirls", $this->sprintGirls, PDO::PARAM_INT);
        $query->bindValue(":buggyCup", $this->buggyCup, PDO::PARAM_INT);
        $query->bindValue(":juniorSprint", $this->juniorSprint, PDO::PARAM_INT);
        $query->bindValue(":maxiTourisme", $this->maxiTourisme, PDO::PARAM_INT);
        $query->bindValue(":buggy1600", $this->buggy1600, PDO::PARAM_INT);
        $query->bindValue(":superSprint", $this->superSprint, PDO::PARAM_INT);
        $query->bindValue(":superBuggy", $this->superBuggy, PDO::PARAM_INT);
        $query->bindValue(":bonus1", $this->bonus1, PDO::PARAM_STR);
        $query->bindValue(":bonus2", $this->bonus2, PDO::PARAM_STR);
        $query->bindValue(":id", $this->id, PDO::PARAM_INT);

        $query->execute();

        if ($query->rowCount() === 1) {

            return true;

        } else {
            return false;
        }
        
    }

    static public function showByRaceId($raceId, $yearId) {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM verification WHERE race_id='$raceId' AND year_id='$yearId'");

        return $pdoStatement->fetchObject(Verification::class);
    }

    static public function findByYear($yearId) {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM verification WHERE year_id='$yearId'");

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Verification::class);
    }

}