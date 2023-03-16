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

    static public function findAllByCategoryAndStatus($categoryId, $status) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE category_id = :categoryId AND `status` = :status";

        $query = $pdo->prepare($sql);

        $query->bindValue(":categoryId",        $categoryId,         PDO::PARAM_INT);
        $query->bindValue(":status",        $status,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Driver::class);

    }

    // public function findAllByCategoryAndStatus0($categoryId) {

    //     $pdo = Database::getPDO();

    //     $sql = "SELECT * FROM driver WHERE category_id = '$categoryId' AND `status` = 0";

    //     $pdoStatement = $pdo->query($sql);

    //     return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Driver::class);

    // }

    public function edit($firstName, $lastName, $number, $vehicle, $picture, $categoryId, $status, $driverId) {

        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setNumber($number);
        $this->setVehicle($vehicle);
        $this->setCategoryId($categoryId);
        $this->setStatus($status);
        $this->setPicture($picture);
        $this->setId($driverId); 

        $pdo = Database::getPDO();

        $sql = "UPDATE `driver` 
        SET 
        `firstName` = '{$this->getFirstName()}',
        `lastName` = '{$this->getLastName()}',
        `number` = {$this->getNumber()},
        `vehicle` = '{$this->getVehicle()}',
        `picture` = '{$this->getPicture()}',
        `category_id` = {$this->getCategoryId()},
        `status` = {$this->getStatus()} 
        WHERE `driver`.`id` = {$this->getId()}
        ";

        $editedRow = $pdo->exec($sql);

        if ($editedRow === 1) {
            return true;
        } else {
            return false;
        }
    }

    static public function sortAllByForCategory($categoryId, $name) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE `category_id` = '$categoryId' ORDER BY $name ASC";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

    }

    static public function sortAllBy($name) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver ORDER BY $name ASC";

        $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

    }

}