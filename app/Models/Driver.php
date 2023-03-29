<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Driver extends CoreUser {

    private $number;
    private $vehicle;
    private $category_id;
    private $status;
    private $place;
    private $rate1;
    private $rate2;
    private $overall;

    public function getNumber(){ return $this->number; }
    public function setNumber($number): self { $this->number = $number; return $this; }

    public function getVehicle(){ return $this->vehicle; }
    public function setVehicle($vehicle): self { $this->vehicle = $vehicle; return $this; }

    public function getCategoryId(){ return $this->category_id; }
    public function setCategoryId($category_id): self { $this->category_id = $category_id; return $this; }

    public function getStatus(){ return $this->status; }
    public function setStatus($status): self { $this->status = $status; return $this; }

    public function getPlace(){ return $this->place; }
    public function setPlace($place): self { $this->place = $place; return $this; }

    public function getRate1(){ return $this->rate1; }
    public function setRate1($rate1): self { $this->rate1 = $rate1; return $this; }

    public function getRate2(){ return $this->rate2; }
    public function setRate2($rate2): self { $this->rate2 = $rate2; return $this; }

    public function getOverall(){ return $this->overall; }
    public function setOverall($overall): self { $this->overall = $overall; return $this; }

    public function createOrUpdate() {
        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `driver` SET `firstName`= :firstName, `lastName` = :lastName, `number` = :number, `vehicle` = :vehicle, `category_id` = :categoryId, `status` = :status, `picture` = :picture, `place` = :place, `rate1` = :rate1, `rate2` = :rate2, `overall` = :overall, `updated_at` = NOW() WHERE id = :id";
        } else {
            $sql = "INSERT INTO `driver` (`firstName`, `lastName`, `number`, `vehicle`, `category_id`, `status`, `picture`, `place`, `rate1`, `rate2`, `overall`, `created_at`) VALUES (:firstName, :lastName, :number, :vehicle, :categoryId, :status, :picture, :place, :rate1, :rate2, :overall, NOW())";
        }

        $query = $pdo->prepare($sql);

        $query->bindValue(":firstName",  $this->firstName,   PDO::PARAM_STR);
        $query->bindValue(":lastName",   $this->lastName,    PDO::PARAM_STR);
        $query->bindValue(":number",     $this->number,      PDO::PARAM_INT);
        $query->bindValue(":vehicle",    $this->vehicle,     PDO::PARAM_STR);
        $query->bindValue(":categoryId", $this->category_id, PDO::PARAM_INT);
        $query->bindValue(":status",     $this->status,      PDO::PARAM_INT);
        $query->bindValue(":place",      $this->place,       PDO::PARAM_INT);
        $query->bindValue(":picture",    $this->picture,     PDO::PARAM_STR);
        $query->bindValue(":rate1",       $this->rate1,        PDO::PARAM_STR);
        $query->bindValue(":rate2",       $this->rate2,        PDO::PARAM_STR);
        $query->bindValue(":overall",     $this->overall,      PDO::PARAM_STR);

        if ($this->id > 0) {

        $query->bindValue(":id",         $this->id,          PDO::PARAM_INT);
    
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

    /**
     * Undocumented function
     *
     * @return static::class[]
     */
    static public function findAllByCategory($categoryId) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE category_id = :categoryId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":categoryId",  $categoryId,   PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Driver::class);

    }

    /**
     * Undocumented function
     *
     * @return static::class[]
     */
    static public function findByCategoryAndStatus($categoryId, $status) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE category_id = :categoryId AND `status` = :status";

        $query = $pdo->prepare($sql);

        $query->bindValue(":categoryId",    $categoryId,   PDO::PARAM_INT);
        $query->bindValue(":status",        $status,       PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Driver::class);

    }

    /**
     * Undocumented function
     *
     * @return static::class[]
     */
    static public function sortAllByForCategory($categoryId, $order) {

        $pdo = Database::getPDO();

        $sql = "SELECT * FROM driver WHERE `category_id` = :categoryId ORDER BY $order";

        $query = $pdo->prepare($sql);

        $query->bindValue(":categoryId",   $categoryId,  PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, self::class);

    }

}