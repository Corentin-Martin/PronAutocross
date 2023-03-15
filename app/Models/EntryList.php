<?php

namespace App\Models;

use App\Models\Driver;
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

    static public function make($POST) {

        foreach (array_slice(array_keys($POST), 2) as $driverId) {
            $driver = Driver::find($driverId, Driver::class);

            if ($driver) {

                $pdo = Database::getPDO();

                $sql = "INSERT INTO entry_list (`race_id`, `category_id`, `driver_id`, `year_id`) VALUES ('{$POST['race']}', '{$driver->getCategoryId()}', '{$driver->getId()}', '{$POST['year']}')";

                $pdoStatement = $pdo->exec($sql);
            }

        }
    }

    static public function listByRaceAndCategory($yearId, $raceId, $categoryId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM entry_list WHERE race_id = '$raceId' AND category_id = '$categoryId' AND year_id = '$yearId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, EntryList::class);
    }

    static public function listByRace($yearId, $raceId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM entry_list WHERE race_id = '$raceId' AND year_id = '$yearId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, EntryList::class);
    }
}