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

            $category = new Category();
            $insertion = $category->insert($name);

            if ($insertion) {
                global $router;
                header("Location: {$router->generate('category-list')}");
            } else {
                exit("erreur");
            }
        }
        
    }

    public function list() {

        $categories = Category::findAll(Category::class);

        $this->show('admin/category/list', ['categories' => $categories]);
    }
}