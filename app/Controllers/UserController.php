<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\EntryList;
use App\Models\Questions;

class UserController extends CoreController
{

    public function play($year, $raceId) {

        $entryModel = new EntryList();

        $categoryModel = new Category();
        $categories = $categoryModel->findAll(Category::class);

        $questionsModel = new Questions();
        $questions = $questionsModel->findQuestionsByRaceAndYear($year,$raceId);

        $entrylist = [];
        $categoriesById = [];
        foreach ($categories as $category) {
            $entrylist[$category->getId()] = $entryModel->listByRaceAndCategory($year, $raceId, $category->getId());
            $categoriesById[$category->getId()] = $category;
        }

        $this->show('user/play', ['entrylist' => $entrylist, 'categories' => $categoriesById, 'questions' => $questions, 'raceId' => $raceId, 'year' => $year]);
    }
}