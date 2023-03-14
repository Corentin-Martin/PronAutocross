<?php

namespace App\Models;

use App\Utils\Database;

class Category extends CoreModel {
    
    private $name;

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

    public function insert($name) {

        $this->setName($name);

        $pdo = Database::getPDO();

        $sql = "INSERT INTO category (`name`) VALUES ('{$this->getName()}')";

        $insertedRow = $pdo->exec($sql);

        if ($insertedRow === 1) {
            return true;
        } else {
            return false;
        }
        
    }


}