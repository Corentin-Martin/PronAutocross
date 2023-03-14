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

    public function makeRate($driverId, $yearId) {

        $this->setDriverId($driverId);
        $this->setYearId($yearId);
        $this->setRate1(10);
        $this->setRate2(10);
        $this->setOverall(10);

        $pdo = Database::getPDO();

        $sql = "INSERT INTO rate (`rate1`, `rate2`, `overall`, `driver_id`, `year_id`) VALUES (
            '{$this->getRate1()}',
            '{$this->getRate2()}',
            '{$this->getOverall()}',
            '{$this->getDriverId()}',
            '{$this->getYearId()}')";

        return $pdoStatement = $pdo->exec($sql);
    }



    public function calculRate($yearId, $raceId, $driverId) {

        $this->findRateByDriverId($driverId, $yearId);

        $participationModel = new Participation();
        $participations = count($participationModel->showAllParticipations($yearId, $raceId));

        $driverVotes = count($participationModel->showAllForADriver($yearId,$raceId,$driverId));

        $percentage = $driverVotes * 100 / $participations;

        $rate = 70 / $percentage;

        if ($rate > 20) 
        {
            $rate = 20;
        } 
        else if ($rate <= 1) 
        {
            $rate = 1.01;
        }

        $this->setRate1($this->getRate2());
        $this->setRate2($rate);

        $averageRate = ($this->getRate1() + $this->getRate2()) / 2;

        $this->setOverall($averageRate);

        return $this;


    }

    public function updateRate($yearId, $raceId) {
        $drivers = Driver::findAll(Driver::class);

        foreach ($drivers as $driver) {
            $this->setDriverId($driver->getId());
            $this->setYearId($yearId);

            $this->calculRate($yearId, $raceId, $this->getDriverId());

            $pdo = Database::getPDO();

            $sql = "UPDATE rate SET `rate1` = '{$this->getRate1()}' , `rate2` = '{$this->getRate2()}' , `overall` = '{$this->getOverall()}' WHERE `driver_id` = '{$this->getDriverId()}' AND `year_id` = '{$this->getYearId()}'";

            $pdoStatement = $pdo->exec($sql);
        }
    }

    public function findRateByDriverId($driverId, $yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM rate WHERE year_id='$yearId' AND driver_id='$driverId'";

        $pdoStatement = $pdo->query($sql);

        $driver = $pdoStatement->fetchObject(Rate::class);

        $this->setRate1($driver->getRate1());
        $this->setRate2($driver->getRate2());


    }

    static public function findRateByDriverIdForScore($driverId, $yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM rate WHERE year_id='$yearId' AND driver_id='$driverId'";

        $pdoStatement = $pdo->query($sql);

        $driver = $pdoStatement->fetchObject(Rate::class);

        return $driver;

    }

    public function findAllRatesByYear($yearId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM rate WHERE year_id='$yearId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Rate::class);


    }
    
}