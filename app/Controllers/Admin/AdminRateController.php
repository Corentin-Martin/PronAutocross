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
    
                $newRate = 70 / $percentage;
        
                if ($newRate > 20) {
                    $newRate = 20;
                } elseif ($newRate <= 1) {
                    $newRate = 1.01;
                }
            }

            $driverRate = Rate::findRateByDriverId($driver->getId(), date('Y'));
    
            $rate2 = $driverRate->getRate2();
    
            $averageRate = ($newRate + $rate2) / 2;
    
            $driverRate->setRate1($rate2);
            $driverRate->setRate2($newRate);
            $driverRate->setOverall($averageRate);
            
            $driverRate->createOrUpdate();
        }

    }

    global $router;

    header("Location: {$router->generate('driver-list', ['categoryId' => 1, 'action' => 'number'])}");
    exit;
    }

}