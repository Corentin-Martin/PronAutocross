<?php

namespace App\Controllers\Admin;

use App\Models\Category;

class AdminCategoryController extends AdminCoreController
{

    public function add() {

        global $router;

        // TO DO TRAITER FORMULAIRE DE VALIDATION


        $this->show('admin/category/add');
    }

    public function list() {

        $categories = Category::findAll(Category::class);

        $this->show('admin/category/list', ['categories' => $categories]);
    }
}