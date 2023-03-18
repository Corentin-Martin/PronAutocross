<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Rate extends CoreModel
{
    private $rate1;
    private $rate2;
    private $overall;
    private $driver_id;
    private $year_id;

    public function getRate1(){ return $this->rate1; }
    public function setRate1($rate1): self { $this->rate1 = $rate1; return $this; }

    public function getRate2(){ return $this->rate2; }
    public function setRate2($rate2): self { $this->rate2 = $rate2; return $this; }

    public function getOverall(){ return $this->overall; }
    public function setOverall($overall): self { $this->overall = $overall; return $this; }

    public function getDriverId(){ return $this->driver_id; }
    public function setDriverId($driver_id): self { $this->driver_id = $driver_id; return $this; }

    public function getYearId(){ return $this->year_id; }
    public function setYearId($year_id): self { $this->year_id = $year_id; return $this; }

    public function createOrUpdate() {
        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `rate` SET `rate1`= :rate1, `rate2` = :rate2, `overall` = :overall, `driver_id` = :driverId, `year_id` = :yearId WHERE id = :id";
        } else {
            $sql = "INSERT INTO `rate` (`rate1`, `rate2`, `overall`, `driver_id`, `year_id`) VALUES ( :rate1, :rate2, :overall, :driverId, :yearId)";
        } 

        $query = $pdo->prepare($sql);

        $query->bindValue(":rate1",       $this->rate1,        PDO::PARAM_STR);
        $query->bindValue(":rate2",       $this->rate2,        PDO::PARAM_STR);
        $query->bindValue(":overall",     $this->overall,      PDO::PARAM_STR);
        $query->bindValue(":driverId",    $this->driver_id,    PDO::PARAM_INT);
        $query->bindValue(":yearId",      $this->year_id,      PDO::PARAM_INT);

        if ($this->id > 0) {

        $query->bindValue(":id",          $this->id,           PDO::PARAM_INT);

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


    // public function calculRate($yearId, $raceId, $driverId) {

    //     $this->findRateByDriverId($driverId, $yearId);

    //     $participations = count(Participation::showAllParticipations($yearId, $raceId));

    //     $driverVotes = count(Participation::showAllForADriver($yearId,$raceId,$driverId));

    //     $percentage = $driverVotes * 100 / $participations;

    //     $rate = 70 / $percentage;

    //     if ($rate > 20) 
    //     {
    //         $rate = 20;
    //     } 
    //     else if ($rate <= 1) 
    //     {
    //         $rate = 1.01;
    //     }

    //     $this->setRate1($this->getRate2());
    //     $this->setRate2($rate);

    //     $averageRate = ($this->getRate1() + $this->getRate2()) / 2;

    //     $this->setOverall($averageRate);

    //     return $this;


    // }

    // public function updateRate($yearId, $raceId) {
    //     $drivers = Driver::findAll(Driver::class);

    //     foreach ($drivers as $driver) {
    //         $this->setDriverId($driver->getId());
    //         $this->setYearId($yearId);

    //         $this->calculRate($yearId, $raceId, $this->getDriverId());

    //         $pdo = Database::getPDO();

    //         $sql = "UPDATE rate SET `rate1` = '{$this->getRate1()}' , `rate2` = '{$this->getRate2()}' , `overall` = '{$this->getOverall()}' WHERE `driver_id` = '{$this->getDriverId()}' AND `year_id` = '{$this->getYearId()}'";

    //         $pdoStatement = $pdo->exec($sql);
    //     }
    // }

    // public function findRateByDriverId($driverId, $yearId) {

    //     $pdo = Database::getPDO();

    //     $sql = "SELECT * FROM rate WHERE year_id='$yearId' AND driver_id='$driverId'";

    //     $pdoStatement = $pdo->query($sql);

    //     $driver = $pdoStatement->fetchObject(Rate::class);

    //     $this->setRate1($driver->getRate1());
    //     $this->setRate2($driver->getRate2());


    // }

    /**
     * Undocumented function
     *
     * @return Rate
     */
    static public function findRateByDriverId($driverId, $yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM rate WHERE year_id='$yearId' AND driver_id='$driverId'";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId",       $yearId,        PDO::PARAM_INT);
        $query->bindValue(":driverId",     $driverId,      PDO::PARAM_INT);

        $query->execute();

        return $query->fetchObject(Rate::class);

    }

}