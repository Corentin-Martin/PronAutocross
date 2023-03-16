<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

abstract class CoreGame extends CoreModel {

    protected $maxiSprint;
    protected $tourismeCup;
    protected $sprintGirls;
    protected $buggyCup;
    protected $juniorSprint;
    protected $maxiTourisme;
    protected $buggy1600;
    protected $superSprint;
    protected $superBuggy;
    protected $bonus1;
    protected $bonus2;
    protected $race_id;
    protected $year_id;

    public function getMaxiSprint(){ return $this->maxiSprint; }
    public function setMaxiSprint($maxiSprint): self { $this->maxiSprint = $maxiSprint; return $this; }

    public function getTourismeCup(){ return $this->tourismeCup; }
    public function setTourismeCup($tourismeCup): self { $this->tourismeCup = $tourismeCup; return $this; }

    public function getSprintGirls(){ return $this->sprintGirls; }
    public function setSprintGirls($sprintGirls): self { $this->sprintGirls = $sprintGirls; return $this; }

    public function getBuggyCup(){ return $this->buggyCup; }
    public function setBuggyCup($buggyCup): self { $this->buggyCup = $buggyCup; return $this; }

    public function getJuniorSprint(){ return $this->juniorSprint; }
    public function setJuniorSprint($juniorSprint): self { $this->juniorSprint = $juniorSprint; return $this; }

    public function getMaxiTourisme(){ return $this->maxiTourisme; }
    public function setMaxiTourisme($maxiTourisme): self { $this->maxiTourisme = $maxiTourisme; return $this; }

    public function getBuggy1600(){ return $this->buggy1600; }
    public function setBuggy1600($buggy1600): self { $this->buggy1600 = $buggy1600; return $this; }

    public function getSuperSprint(){ return $this->superSprint; }
    public function setSuperSprint($superSprint): self { $this->superSprint = $superSprint; return $this; }

    public function getSuperBuggy(){ return $this->superBuggy; }
    public function setSuperBuggy($superBuggy): self { $this->superBuggy = $superBuggy; return $this; }

    public function getBonus1(){ return $this->bonus1; }
    public function setBonus1($bonus1): self { $this->bonus1 = $bonus1; return $this; }

    public function getBonus2(){ return $this->bonus2; }
    public function setBonus2($bonus2): self { $this->bonus2 = $bonus2; return $this; }

    public function getRaceId(){ return $this->race_id; }
    public function setRaceId($race_id): self { $this->race_id = $race_id; return $this; }

    public function getYearId(){ return $this->year_id; }
    public function setYearId($year_id): self { $this->year_id = $year_id; return $this; }

    public function addOrUpdate($table) {

        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `$table` SET `maxiSprint`= :maxiSprint, `tourismeCup` = :tourismeCup, `sprintGirls` = :sprintGirls, `buggyCup` = :buggyCup, `juniorSprint` = :juniorSprint, `maxiTourisme` = :maxiTourisme, `buggy1600` = :buggy1600, `superSprint` = :superSprint, `superBuggy` = :superBuggy, `bonus1` = :bonus1, `bonus2` = :bonus2, `race_id` = :raceId, `year_id` = :yearId WHERE id = :id";
        } else {
            $sql = "INSERT INTO `$table` 
            (`maxiSprint`, `tourismeCup`, `sprintGirls`, `buggyCup`, `juniorSprint`, `maxiTourisme`, `buggy1600`, `superSprint`,
            `superBuggy`, `bonus1`, `bonus2`, `race_id`, `year_id`) 
            VALUES 
            ( :maxiSprint, :tourismeCup, :sprintGirls, :buggyCup, :juniorSprint, :maxiTourisme, :buggy1600, :superSprint, :superBuggy, :bonus1, :bonus2, :raceId, :yearId)";
        }
        
        $query = $pdo->prepare($sql);

        if ($table === 'questions') {
            $arg = PDO::PARAM_STR;
        } else {
            $arg = PDO::PARAM_INT;
        }

        $query->bindValue(":maxiSprint",    $this->maxiSprint,      $arg);
        $query->bindValue(":tourismeCup",   $this->tourismeCup,     $arg);
        $query->bindValue(":sprintGirls",   $this->sprintGirls,     $arg);
        $query->bindValue(":buggyCup",      $this->buggyCup,        $arg);
        $query->bindValue(":juniorSprint",  $this->juniorSprint,    $arg);
        $query->bindValue(":maxiTourisme",  $this->maxiTourisme,    $arg);
        $query->bindValue(":buggy1600",     $this->buggy1600,       $arg);
        $query->bindValue(":superSprint",   $this->superSprint,     $arg);
        $query->bindValue(":superBuggy",    $this->superBuggy,      $arg);
        $query->bindValue(":bonus1",        $this->bonus1,          PDO::PARAM_STR);
        $query->bindValue(":bonus2",        $this->bonus2,          PDO::PARAM_STR);
        $query->bindValue(":raceId",        $this->race_id,         PDO::PARAM_INT);
        $query->bindValue(":yearId",        $this->year_id,         PDO::PARAM_INT);

        if ($this->id > 0) {

        $query->bindValue(":id",            $this->id,              PDO::PARAM_INT);

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
}