<?php

namespace App\Models;

use App\Utils\Database;

class Category extends CoreModel {
    
    private $name;
    private $running_order;

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

    public function getRunningOrder(){ return $this->running_order; }
    public function setRunningOrder($running_order): self { $this->running_order = $running_order; return $this; }

    public function insert($name, $running_order) {

        $this->setName($name);
        $this->setRunningOrder($running_order);

        $pdo = Database::getPDO();

        $sql = "INSERT INTO category (`name`, `running_order`) VALUES ('{$this->getName()}', {$this->getRunningOrder()})";

        $insertedRow = $pdo->exec($sql);

        if ($insertedRow === 1) {
            return true;
        } else {
            return false;
        }
        
    }




}