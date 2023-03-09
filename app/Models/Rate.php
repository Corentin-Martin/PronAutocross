<?php

namespace App\Models;

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

    public function makeRate($yearId, $raceId, $driverId) {

        $participationModel = new Participation();
        $participations = count($participationModel->showAllParticipations($yearId, $raceId));

        $driverVotes = count($participationModel->showAllForADriver($yearId,$raceId,$driverId));

        return $percentage = $driverVotes * 100 / $participations;


    }
}