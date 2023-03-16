<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Questions extends CoreGame {

    public function newAdd() {
        $pdo = Database::getPDO();

        $sql = "INSERT INTO `questions` 
        (`maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`,
         `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`) 
         VALUES 
         ( :maxiSprint, :tourismeCup, :sprintGirls, :buggyCup, :juniorSprint, :maxiTourisme, :buggy1600, :superSprint, :superBuggy, :bonus1, :bonus2, :raceId, :yearId)";

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
    
    public function add($ms, $tc, $sg, $bc, $js, $mt, $b16, $ss, $sb, $b1, $b2, $raceId, $yearId) {

        $this->setMaxiSprint($ms);
        $this->setTourismeCup($tc);
        $this->setSprintGirls($sg);
        $this->setBuggyCup($bc);
        $this->setJuniorSprint($js);
        $this->setMaxiTourisme($mt);
        $this->setBuggy1600($b16);
        $this->setsuperSprint($ss);
        $this->setSuperBuggy($sb);
        $this->setBonus1($b1);
        $this->setBonus2($b2);
        $this->setRaceId($raceId);
        $this->setYearId($yearId);

        $pdo = Database::getPDO();

        $sql = "INSERT INTO `questions` (`maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`, `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`) VALUES (
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
            {$this->getRaceId()},
            {$this->getYearId()})";

        return $pdoStatement = $pdo->exec($sql);
        
    }

    static public function findQuestionsByRaceAndYear($yearId, $raceId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM questions WHERE year_id = '$yearId' AND race_id='$raceId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject(Questions::class);
    }

    static public function findQuestionsByYear($yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM questions WHERE year_id = '$yearId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Questions::class);
    }

    public function delete() {
        $pdo = Database::getPDO();

        $sql = 
        "DELETE FROM questions WHERE id = :id";

        $query = $pdo->prepare($sql);

        $query->bindValue(":id", $this->id, PDO::PARAM_INT);

        $query->execute();

        if ($query->rowCount() === 1) {

            return true;

        } else {
            return false;
        }
    }
}