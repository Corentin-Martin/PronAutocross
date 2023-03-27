<?php

namespace App\Controllers\Admin;

use App\Models\Driver;
use App\Models\EntryList;
use App\Models\Participation;
use App\Models\Race;
use App\Models\Rate;

class AdminRateController extends AdminCoreController
{

    public function edit($id) {

        $races = Race::findByYear(date('Y'));

        $this->show('admin/rate/edit', ['races' => $races]);
    }

    public function update($raceId) {
    $participations = count(Participation::showAllParticipations(date('Y'), $raceId));

    $drivers = Driver::findAll();

    foreach ($drivers as $driver) {

        $entry = EntryList::findDriverParticipation(date('Y'), $raceId, $driver->getId());

        if ($entry) {
            $driverVotes = count(Participation::showAllForADriver(date('Y'), $raceId, $driver->getId()));

            if ($driverVotes === 0) {
                $newRate = 20;
            } else {
                $percentage = $driverVotes * 100 / $participations;
    
                $newRate = 30 / $percentage;
        
                if ($newRate > 20) {
                    $newRate = 20;
                } elseif ($newRate <= 1) {
                    $newRate = 1.01;
                }
            }

            $driverRate = Rate::findRateByDriverId($driver->getId(), date('Y'));
    
            $rate2 = $driverRate->getRate2();
    
            $averageRate = ($newRate + $rate2) / 2;

            $coeff = [
                0 => 9,
                1 => 1.01,
                2 => 1.25,
                3 => 1.50,
                4 => 1.70,
                5 => 1.80,
                6 => 2.30,
                7 => 2.50,
                8 => 3.30,
                9 => 3.90,
                10 => 4.20,
            ];

            $rateWithPlace = round((($averageRate + $coeff[$driver->getPlace()]) / 2), 2);
    
            $driverRate->setRate1($rate2);
            $driverRate->setRate2($newRate);
            $driverRate->setOverall($rateWithPlace);
            
            $driverRate->createOrUpdate();
        }

    }

    header("Location: {$this->router->generate('driver-list', ['categoryId' => 1, 'action' => 'number'])}");
    exit;
    }

}