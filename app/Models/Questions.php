<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Questions extends CoreGame {
    
    public function addQuestions($ms, $tc, $sg, $bc, $js, $mt, $b16, $ss, $sb, $b1, $b2, $raceId, $yearId) {

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
            '{$this->getRaceId()}',
            '{$this->getYearId()}'))";

        $pdoStatement = $pdo->exec($sql);

        if ($pdoStatement === 1) {
            exit("Vérification insérée en BDD");
        } else {
            exit("Erreur !");
        }
    }

    public function findQuestionsByRaceAndYear($yearId, $raceId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM questions WHERE year_id = '$yearId' AND race_id='$raceId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchObject(Questions::class);
    }
}