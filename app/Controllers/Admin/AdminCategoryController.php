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

            $errorList = [];

            if (empty($name) || empty($running_order)) {
                $errorList[] = "Tous les champs sont obligatoires.";
            }

            if ($id) {
                $category = Category::find($id);
            } else {
                $category = new Category();  
            }

            if (empty($errorList)) {

                $category->setName($name);
                $category->setRunningOrder($running_order);
    
                if($id) {
                    $category->setId($id);
                }
    
                if ($category->createOrUpdate()) {
                    header("Location: {$this->router->generate('category-list')}");
                } else {
                    $errorList[] = "Erreur lors de l'enregistrement.";
                }
            }

            $this->show('admin/category/add', ['category' => $category, 'errorList' => $errorList]);


        } else {
            header("Location: {$this->router->generate('error403')}");
            exit; 
        }
        
    }

    public function list() {

        $categories = Category::findAll();

        $this->show('admin/category/list', ['categories' => $categories]);
    }

    public function delete($id, $token) {
        
        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';


        if (hex2bin($token) !== $sessionToken) {

            header( "Location: {$this->router->generate('error403')}" );
            exit;

        } else {
            unset($_SESSION['token']);
        }

        $category = Category::find($id);

        if ($category->delete()) {

            header("Location: {$this->router->generate('category-list')}");
            exit;

        } else {
            $errorList = [];
            $errorList[] = "Une erreur est survenue lors de la suppression.";

            $categories = Category::findAll();

            $this->show('admin/category/list', ['categories' => $categories, 'errorList' => $errorList]);
        }
        
    }
}