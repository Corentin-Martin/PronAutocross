<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Verification extends CoreGame {

    private $maxiSprint2;
    private $maxiSprint3;
    private $maxiSprint4;
    private $maxiSprint5;
    private $tourismeCup2;
    private $tourismeCup3;
    private $tourismeCup4;
    private $tourismeCup5;
    private $sprintGirls2;
    private $sprintGirls3;
    private $sprintGirls4;
    private $sprintGirls5;
    private $buggyCup2;
    private $buggyCup3;
    private $buggyCup4;
    private $buggyCup5;
    private $juniorSprint2;
    private $juniorSprint3;
    private $juniorSprint4;
    private $juniorSprint5;
    private $maxiTourisme2;
    private $maxiTourisme3;
    private $maxiTourisme4;
    private $maxiTourisme5;
    private $buggy16002;
    private $buggy16003;
    private $buggy16004;
    private $buggy16005;
    private $superSprint2;
    private $superSprint3;
    private $superSprint4;
    private $superSprint5;
    private $superBuggy2;
    private $superBuggy3;
    private $superBuggy4;
    private $superBuggy5;

    public function getMaxiSprint2(){ return $this->maxiSprint2; }
    public function setMaxiSprint2($maxiSprint2): self { $this->maxiSprint2 = $maxiSprint2; return $this; }

    public function getMaxiSprint3(){ return $this->maxiSprint3; }
    public function setMaxiSprint3($maxiSprint3): self { $this->maxiSprint3 = $maxiSprint3; return $this; }

    public function getMaxiSprint4(){ return $this->maxiSprint4; }
    public function setMaxiSprint4($maxiSprint4): self { $this->maxiSprint4 = $maxiSprint4; return $this; }

    public function getMaxiSprint5(){ return $this->maxiSprint5; }
    public function setMaxiSprint5($maxiSprint5): self { $this->maxiSprint5 = $maxiSprint5; return $this; }

    public function getTourismeCup2(){ return $this->tourismeCup2; }
    public function setTourismeCup2($tourismeCup2): self { $this->tourismeCup2 = $tourismeCup2; return $this; }

    public function getTourismeCup3(){ return $this->tourismeCup3; }
    public function setTourismeCup3($tourismeCup3): self { $this->tourismeCup3 = $tourismeCup3; return $this; }

    public function getTourismeCup4(){ return $this->tourismeCup4; }
    public function setTourismeCup4($tourismeCup4): self { $this->tourismeCup4 = $tourismeCup4; return $this; }

    public function getTourismeCup5(){ return $this->tourismeCup5; }
    public function setTourismeCup5($tourismeCup5): self { $this->tourismeCup5 = $tourismeCup5; return $this; }

    public function getSprintGirls2(){ return $this->sprintGirls2; }
    public function setSprintGirls2($sprintGirls2): self { $this->sprintGirls2 = $sprintGirls2; return $this; }

    public function getSprintGirls3(){ return $this->sprintGirls3; }
    public function setSprintGirls3($sprintGirls3): self { $this->sprintGirls3 = $sprintGirls3; return $this; }

    public function getSprintGirls4(){ return $this->sprintGirls4; }
    public function setSprintGirls4($sprintGirls4): self { $this->sprintGirls4 = $sprintGirls4; return $this; }

    public function getSprintGirls5(){ return $this->sprintGirls5; }
    public function setSprintGirls5($sprintGirls5): self { $this->sprintGirls5 = $sprintGirls5; return $this; }

    public function getBuggyCup2(){ return $this->buggyCup2; }
    public function setBuggyCup2($buggyCup2): self { $this->buggyCup2 = $buggyCup2; return $this; }

    public function getBuggyCup3(){ return $this->buggyCup3; }
    public function setBuggyCup3($buggyCup3): self { $this->buggyCup3 = $buggyCup3; return $this; }

    public function getBuggyCup4(){ return $this->buggyCup4; }
    public function setBuggyCup4($buggyCup4): self { $this->buggyCup4 = $buggyCup4; return $this; }

    public function getBuggyCup5(){ return $this->buggyCup5; }
    public function setBuggyCup5($buggyCup5): self { $this->buggyCup5 = $buggyCup5; return $this; }

    public function getJuniorSprint2(){ return $this->juniorSprint2; }
    public function setJuniorSprint2($juniorSprint2): self { $this->juniorSprint2 = $juniorSprint2; return $this; }

    public function getJuniorSprint3(){ return $this->juniorSprint3; }
    public function setJuniorSprint3($juniorSprint3): self { $this->juniorSprint3 = $juniorSprint3; return $this; }

    public function getJuniorSprint4(){ return $this->juniorSprint4; }
    public function setJuniorSprint4($juniorSprint4): self { $this->juniorSprint4 = $juniorSprint4; return $this; }

    public function getJuniorSprint5(){ return $this->juniorSprint5; }
    public function setJuniorSprint5($juniorSprint5): self { $this->juniorSprint5 = $juniorSprint5; return $this; }

    public function getMaxiTourisme2(){ return $this->maxiTourisme2; }
    public function setMaxiTourisme2($maxiTourisme2): self { $this->maxiTourisme2 = $maxiTourisme2; return $this; }

    public function getMaxiTourisme3(){ return $this->maxiTourisme3; }
    public function setMaxiTourisme3($maxiTourisme3): self { $this->maxiTourisme3 = $maxiTourisme3; return $this; }

    public function getMaxiTourisme4(){ return $this->maxiTourisme4; }
    public function setMaxiTourisme4($maxiTourisme4): self { $this->maxiTourisme4 = $maxiTourisme4; return $this; }

    public function getMaxiTourisme5(){ return $this->maxiTourisme5; }
    public function setMaxiTourisme5($maxiTourisme5): self { $this->maxiTourisme5 = $maxiTourisme5; return $this; }

    public function getBuggy16002(){ return $this->buggy16002; }
    public function setBuggy16002($buggy16002): self { $this->buggy16002 = $buggy16002; return $this; }

    public function getBuggy16003(){ return $this->buggy16003; }
    public function setBuggy16003($buggy16003): self { $this->buggy16003 = $buggy16003; return $this; }

    public function getBuggy16004(){ return $this->buggy16004; }
    public function setBuggy16004($buggy16004): self { $this->buggy16004 = $buggy16004; return $this; }

    public function getBuggy16005(){ return $this->buggy16005; }
    public function setBuggy16005($buggy16005): self { $this->buggy16005 = $buggy16005; return $this; }

    public function getSuperSprint2(){ return $this->superSprint2; }
    public function setSuperSprint2($superSprint2): self { $this->superSprint2 = $superSprint2; return $this; }

    public function getSuperSprint3(){ return $this->superSprint3; }
    public function setSuperSprint3($superSprint3): self { $this->superSprint3 = $superSprint3; return $this; }

    public function getSuperSprint4(){ return $this->superSprint4; }
    public function setSuperSprint4($superSprint4): self { $this->superSprint4 = $superSprint4; return $this; }

    public function getSuperSprint5(){ return $this->superSprint5; }
    public function setSuperSprint5($superSprint5): self { $this->superSprint5 = $superSprint5; return $this; }

    public function getSuperBuggy2(){ return $this->superBuggy2; }
    public function setSuperBuggy2($superBuggy2): self { $this->superBuggy2 = $superBuggy2; return $this; }

    public function getSuperBuggy3(){ return $this->superBuggy3; }
    public function setSuperBuggy3($superBuggy3): self { $this->superBuggy3 = $superBuggy3; return $this; }

    public function getSuperBuggy4(){ return $this->superBuggy4; }
    public function setSuperBuggy4($superBuggy4): self { $this->superBuggy4 = $superBuggy4; return $this; }

    public function getSuperBuggy5(){ return $this->superBuggy5; }
    public function setSuperBuggy5($superBuggy5): self { $this->superBuggy5 = $superBuggy5; return $this; }

    public function createOrUpdate() {

        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `verification` SET `maxiSprint`= :maxiSprint, `maxiSprint2`= :maxiSprint2, `maxiSprint3`= :maxiSprint3, `maxiSprint4`= :maxiSprint4, `maxiSprint5`= :maxiSprint5, `tourismeCup` = :tourismeCup, `tourismeCup2` = :tourismeCup2, `tourismeCup3` = :tourismeCup3, `tourismeCup4` = :tourismeCup4, `tourismeCup5` = :tourismeCup5, `sprintGirls` = :sprintGirls, `sprintGirls2` = :sprintGirls2, `sprintGirls3` = :sprintGirls3, `sprintGirls4` = :sprintGirls4, `sprintGirls5` = :sprintGirls5, `buggyCup` = :buggyCup, `buggyCup2` = :buggyCup2, `buggyCup3` = :buggyCup3, `buggyCup4` = :buggyCup4, `buggyCup5` = :buggyCup5, `juniorSprint` = :juniorSprint, `juniorSprint2` = :juniorSprint2, `juniorSprint3` = :juniorSprint3, `juniorSprint4` = :juniorSprint4, `juniorSprint5` = :juniorSprint5, `maxiTourisme` = :maxiTourisme, `maxiTourisme2` = :maxiTourisme2, `maxiTourisme3` = :maxiTourisme3, `maxiTourisme4` = :maxiTourisme4, `maxiTourisme5` = :maxiTourisme5, `buggy1600` = :buggy1600, `buggy16002` = :buggy16002, `buggy16003` = :buggy16003, `buggy16004` = :buggy16004, `buggy16005` = :buggy16005, `superSprint` = :superSprint, `superSprint2` = :superSprint2, `superSprint3` = :superSprint3, `superSprint4` = :superSprint4, `superSprint5` = :superSprint5, `superBuggy` = :superBuggy, `superBuggy2` = :superBuggy2, `superBuggy3` = :superBuggy3, `superBuggy4` = :superBuggy4, `superBuggy5` = :superBuggy5, `bonus1` = :bonus1, `bonus2` = :bonus2, `race_id` = :raceId, `year_id` = :yearId, `updated_at` = NOW() WHERE id = :id";
        } else {
            $sql = "INSERT INTO `verification` 
            (`maxiSprint`,`maxiSprint2`, `maxiSprint3`, `maxiSprint4`, `maxiSprint5`,  `tourismeCup`, `tourismeCup2`, `tourismeCup3`, `tourismeCup4`, `tourismeCup5`,  `sprintGirls`, `sprintGirls2`, `sprintGirls3`, `sprintGirls4`, `sprintGirls5`,  `buggyCup`, `buggyCup2`, `buggyCup3`, `buggyCup4`, `buggyCup5`, `juniorSprint`, `juniorSprint2`, `juniorSprint3`, `juniorSprint4`, `juniorSprint5`, `maxiTourisme`, `maxiTourisme2`, `maxiTourisme3`, `maxiTourisme4`, `maxiTourisme5`, `buggy1600`, `buggy16002`, `buggy16003`, `buggy16004`, `buggy16005`, `superSprint`, `superSprint2`, `superSprint3`, `superSprint4`, `superSprint5`, `superBuggy`, `superBuggy2`, `superBuggy3`, `superBuggy4`, `superBuggy5`, `bonus1`, `bonus2`, `race_id`, `year_id`, `created_at`) 
            VALUES 
            ( :maxiSprint, :maxiSprint2, :maxiSprint3, :maxiSprint4, :maxiSprint5, :tourismeCup, :tourismeCup2, :tourismeCup3, :tourismeCup4, :tourismeCup5, :sprintGirls, :sprintGirls2, :sprintGirls3, :sprintGirls4, :sprintGirls5, :buggyCup, :buggyCup2, :buggyCup3, :buggyCup4, :buggyCup5, :juniorSprint, :juniorSprint2, :juniorSprint3, :juniorSprint4, :juniorSprint5, :maxiTourisme, :maxiTourisme2, :maxiTourisme3, :maxiTourisme4, :maxiTourisme5, :buggy1600, :buggy16002, :buggy16003, :buggy16004, :buggy16005, :superSprint, :superSprint2, :superSprint3, :superSprint4, :superSprint5, :superBuggy, :superBuggy2, :superBuggy3, :superBuggy4, :superBuggy5, :bonus1, :bonus2, :raceId, :yearId, NOW())";
        }
        
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

        for ($i = 2; $i < 6; $i++) {
            $query->bindValue(":maxiSprint$i",    $this->{"maxiSprint$i"},      PDO::PARAM_INT);
            $query->bindValue(":tourismeCup$i",    $this->{"tourismeCup$i"},      PDO::PARAM_INT);
            $query->bindValue(":sprintGirls$i",    $this->{"sprintGirls$i"},      PDO::PARAM_INT);
            $query->bindValue(":buggyCup$i",    $this->{"buggyCup$i"},      PDO::PARAM_INT);
            $query->bindValue(":juniorSprint$i",    $this->{"juniorSprint$i"},      PDO::PARAM_INT);
            $query->bindValue(":maxiTourisme$i",    $this->{"maxiTourisme$i"},      PDO::PARAM_INT);
            $query->bindValue(":buggy1600$i",    $this->{"buggy1600$i"},      PDO::PARAM_INT);
            $query->bindValue(":superSprint$i",    $this->{"superSprint$i"},      PDO::PARAM_INT);
            $query->bindValue(":superBuggy$i",    $this->{"superBuggy$i"},      PDO::PARAM_INT);
        }

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

    static public function lastVerif($yearId) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `verification` WHERE year_id = :yearId ORDER BY id DESC LIMIT 1";

        $query = $pdo->prepare($sql);
        $query->bindValue(":yearId",     $yearId,      PDO::PARAM_INT);

        $query->execute();

        return $query->fetchObject(Verification::class);
    }

}