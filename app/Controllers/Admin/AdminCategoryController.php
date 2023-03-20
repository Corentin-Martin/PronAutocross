<?php

namespace App\Controllers\Admin;

use App\Models\Category;

class AdminCategoryController extends AdminCoreController
{

    public function addOrEdit($id = null) {

        if ($id) {
            $category = Category::find($id);
        } else {
            $category = null;
        }

        $this->show('admin/category/add', ['category' => $category]);
    }

    public function createOrUpdate($id = null) {

        if (isset($_POST)) {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $running_order = filter_input(INPUT_POST, 'running_order', FILTER_VALIDATE_INT);

            if ($id) {
                $category = Category::find($id);
            } else {
                $category = new Category();  
            }

            $category->setName($name);
            $category->setRunningOrder($running_order);

            if($id) {
                $category->setId($id);
            }

            if ($category->createOrUpdate()) {
                header("Location: {$this->router->generate('category-list')}");
            } else {
                exit("erreur");
            }
        } else {
            header("Location: {$this->router->generate('category-list')}");
            exit; 
        }
        
    }

    public function list() {

        $categories = Category::findAll();

        $this->show('admin/category/list', ['categories' => $categories]);
    }

    public function delete($id) {

        $category = Category::find($id);

        if ($category->delete()) {

            header("Location: {$this->router->generate('category-list')}");
            exit;

        } else {
            exit ("erreur");
        }
        
    }
}