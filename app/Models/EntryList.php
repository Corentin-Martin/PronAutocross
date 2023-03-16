<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class EntryList extends CoreModel {
    
    private $race_id;
    private $category_id;
    private $driver_id;
    private $year_id;

    public function getRaceId(){ return $this->race_id; }
    public function setRaceId($race_id): self { $this->race_id = $race_id; return $this; }

    public function getCategoryId(){ return $this->category_id; }
    public function setCategoryId($category_id): self { $this->category_id = $category_id; return $this; }

    public function getDriverId(){ return $this->driver_id; }
    public function setDriverId($driver_id): self { $this->driver_id = $driver_id; return $this; }

    public function getYearId(){ return $this->year_id; }
    public function setYearId($year_id): self { $this->year_id = $year_id; return $this; }

    public function add() {

        $pdo = Database::getPDO();

        $sql = "INSERT INTO entry_list (`race_id`, `category_id`, `driver_id`, `year_id`) VALUES (:raceId, :categoryId, :driverId, :yearId)";

        $query = $pdo->prepare($sql);

        $query->bindValue(":raceId",        $this->race_id,       PDO::PARAM_INT);
        $query->bindValue(":categoryId",    $this->category_id,   PDO::PARAM_INT);
        $query->bindValue(":driverId",      $this->driver_id,     PDO::PARAM_INT);
        $query->bindValue(":yearId",        $this->year_id,       PDO::PARAM_INT);

        $query->execute();

        return ($query->rowCount() === 1);

    }

    static public function listByRaceAndCategory($yearId, $raceId, $categoryId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM entry_list WHERE race_id = :raceId AND category_id = :categoryId AND year_id = :yearId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":raceId",        $raceId,       PDO::PARAM_INT);
        $query->bindValue(":categoryId",    $categoryId,   PDO::PARAM_INT);
        $query->bindValue(":yearId",        $yearId,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, EntryList::class);
    }

    static public function listByRace($yearId, $raceId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM entry_list WHERE race_id = :raceId AND year_id = :yearId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":raceId",        $raceId,       PDO::PARAM_INT);
        $query->bindValue(":yearId",        $yearId,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, EntryList::class);
    }

    public function deleteList($year, $raceId){

        $pdo = Database::getPDO();

        $sql = "DELETE FROM entry_list WHERE `race_id` = :raceId AND `year_id` = :yearId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",        $year,         PDO::PARAM_INT);
        $query->bindValue(":raceId",        $raceId,       PDO::PARAM_INT);

        $query->execute();

        return $query->rowCount();

    }

    public function deleteEntry(){

        $pdo = Database::getPDO();

        $sql = "DELETE FROM entry_list WHERE id = :id";

        $query = $pdo->prepare($sql);

        $query->bindValue(":id",        $this->id,         PDO::PARAM_INT);

        $query->execute();

        return ($query->rowCount() === 1);

    }
}