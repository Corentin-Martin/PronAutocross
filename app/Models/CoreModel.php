<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class CoreModel {

    protected $id;
    
    public function getId(){ return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    public function findAll($className) {
        $pdo = Database::getPDO();

        $tableOnDB = lcfirst(substr($className, 11)); //11 comme App\Models


        $pdoStatement = $pdo->query("SELECT * FROM $tableOnDB");

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, $className);
    }

    public function find($id, $className) {
        $pdo = Database::getPDO();

        $tableOnDB = lcfirst(substr($className, 11));

        $pdoStatement = $pdo->query("SELECT * FROM $tableOnDB WHERE id=$id");

        return $pdoStatement->fetchObject($className);
    }


}