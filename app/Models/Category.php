<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {
    
    private $name;
    private $running_order;

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

    public function getRunningOrder(){ return $this->running_order; }
    public function setRunningOrder($running_order): self { $this->running_order = $running_order; return $this; }

    public function createOrUpdate() {

        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `category` SET `name`= :name, `running_order` = :running_order WHERE id = :id";
        } else {
            $sql = "INSERT INTO `category` (`name`, `running_order`) VALUES (:name, :running_order)";
        }



        $query = $pdo->prepare($sql);

        $query->bindValue(":name",            $this->name,           PDO::PARAM_STR);
        $query->bindValue(":running_order",   $this->running_order,  PDO::PARAM_INT);

        if ($this->id > 0) {

        $query->bindValue(":id",              $this->id,             PDO::PARAM_INT);

        }

        $query->execute();

        if ($query->rowCount() === 1) 
        {
            if (is_null($this->id)) { $this->id = $pdo->lastInsertId();}
            return true;
        } else 
        {
            return false;
        }
    }


}