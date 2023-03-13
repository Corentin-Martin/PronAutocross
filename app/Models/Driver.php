<?php

namespace App\Models;

use App\Models\Rate;
use App\Utils\Database;
use PDO;

class Driver extends CoreUser {

    private $number;
    private $vehicle;
    private $category_id;
    private $status;

    public function getNumber(){ return $this->number; }
    public function setNumber($number): self { $this->number = $number; return $this; }

    public function getVehicle(){ return $this->vehicle; }
    public function setVehicle($vehicle): self { $this->vehicle = $vehicle; return $this; }

    public function getCategoryId(){ return $this->category_id; }
    public function setCategoryId($category_id): self { $this->category_id = $category_id; return $this; }

    public function getStatus(){ return $this->status; }
    public function setStatus($status): self { $this->status = $status; return $this; }

    public function newDriver($firstName, $lastName, $number, $vehicle, $categoryId, $status, $year, $picture) {

        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setNumber($number);
        $this->setVehicle($vehicle);
        $this->setCategoryId($categoryId);
        $this->setStatus($status);
        $this->setPicture($picture);

        $pdo = Database::getPDO();

        $sql = "INSERT INTO driver (`firstName`, `lastName`, `number`, `vehicle`, `category_id`, `status`, `picture`) VALUES ('{$this->getFirstName()}', '{$this->getLastName()}', '{$this->getNumber()}', '{$this->getVehicle()}', '{$this->getCategoryId()}', '{$this->getStatus()}', '{$this->getPicture()}')";

        $pdoStatement = $pdo->exec($sql);

        $driverId = $pdo->lastInsertId();

        $rateModel = new Rate();
        return $rateModel->makeRate($driverId, $year);

    }

    public function findAllByCategory($categoryId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE category_id = '$categoryId'";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Driver::class);

    }

    public function findAllByCategoryAndStatus1($categoryId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE category_id = '$categoryId' AND `status` = 1";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Driver::class);

    }

    public function findAllByCategoryAndStatus0($categoryId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE category_id = '$categoryId' AND `status` = 0";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Driver::class);

    }

    public function update($thingToUpdate, $table, $driverId) {

        $pdo = Database::getPDO();

        $sql = "UPDATE driver SET $table = '$thingToUpdate' WHERE id = '$driverId'";

        $pdoStatement = $pdo->exec($sql);

        if ($pdoStatement === 1) {
            exit("Modification effectuée, {$table} a maintenant la valeur {$thingToUpdate} pour le pilote ayant l'id {$driverId}");
        } else {
            exit("Erreur !");
        }
    }

}