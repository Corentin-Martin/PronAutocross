<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Race extends CoreModel {
    
    private $name;
    private $date;
    private $poster;
    private $year_id;

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

    public function getDate(){ return $this->date; }
    public function setDate($date): self { $this->date = $date; return $this; }

    public function getPoster(){ return $this->poster; }
    public function setPoster($poster): self { $this->poster = $poster; return $this; }

    public function getYearId(){ return $this->year_id; }
    public function setYearId($year_id): self { $this->year_id = $year_id; return $this; }

    public function insertRace($name, $date, $poster = null, $year_id) {

        $this->setName($name);
        $this->setDate($date);
        $this->setPoster($poster);
        $this->setYearId($year_id);

        $pdo = Database::getPDO();

        $sql = "INSERT INTO race (`name`, `date`, `poster`, `year_id`) VALUES ('{$this->getName()}', '{$this->getDate()}', '{$this->getPoster()}', '{$this->getYearId()}')";

        return $pdoStatement = $pdo->exec($sql);
    }

    static public function findbyYear($yearId) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM race WHERE year_id = '$yearId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Race::class);
    }


}