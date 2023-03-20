<?php

namespace App\Controllers\Users;

use App\Models\Category;
use App\Models\Driver;
use App\Models\EntryList;
use App\Models\Questions;
use App\Models\Race;
use App\Models\Rate;

class UserParticipationController extends UserCoreController
{

    public function add($year, $raceId) {

        $race = Race::find($raceId);

        if ($race->getDate() < date('Y-m-d H:i:s')) {
            exit ("Date dépassée");
            // TO DO, REDIRECTION QUAND DATE DEPASSEE
        }

        $categories = Category::findAll();

        $questions = Questions::findQuestionsByRaceAndYear($year,$raceId);

        $entrylist = [];
        $categoriesById = [];
        foreach ($categories as $category) {
            $entriesForACategory = EntryList::listByRaceAndCategory($year, $raceId, $category->getId());

            $categoryEntries = [];
            foreach ($entriesForACategory as $entry) {
                $model = [];
                $model['driver'] = Driver::find($entry->getDriverId());
                $model['rate'] = Rate::findRateByDriverId($entry->getDriverId(), $year)->getOverall();
                $categoryEntries[$entry->getDriverId()] = $model;
            }

            $entrylist[$category->getId()] = $categoryEntries;

            $categoriesById[$category->getId()] = $category;
        }

        $this->show('user/play', ['race' => $race, 'categories' => $categories, 'questions' => $questions, 'categoriesById' => $categoriesById, 'entrylist' => $entrylist]);
    }

    public function create($year, $raceId) {

    }
}
