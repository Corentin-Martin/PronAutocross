<?php

namespace App\Controllers\Admin;

use App\Models\Category;

class AdminCategoryController extends AdminCoreController
{

    public function add() {



        $this->show('admin/category/add');
    }

    public function create() {

        if (isset($_POST) && !empty($_POST['name'])) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $running_order = filter_input(INPUT_POST, 'running_order', FILTER_VALIDATE_INT);

            $category = new Category();

            $category->setName($name);
            $category->setRunningOrder($running_order);

            if ($category->createOrUpdate()) {
                global $router;
                header("Location: {$router->generate('category-list')}");
            } else {
                exit("erreur");
            }
        }
        
    }

    public function list() {

        $categories = Category::findAll();

        $this->show('admin/category/list', ['categories' => $categories]);
    }
}