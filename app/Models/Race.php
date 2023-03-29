<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Race extends CoreModel {
    
    private $name;
    private $date;
    private $poster;
    private $year_id;

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

    public function getDate(){ return $this->date; }
    public function setDate($date): self { $this->date = $date; return $this; }

    public function getPoster(){ return $this->poster; }
    public function setPoster($poster): self { $this->poster = $poster; return $this; }

    public function getYearId(){ return $this->year_id; }
    public function setYearId($year_id): self { $this->year_id = $year_id; return $this; }

    public function createOrUpdate() {
        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = 
            "UPDATE `race` SET `name`= :name, `date` = :date, `poster` = :poster, `year_id` = :yearId, `updated_at` = NOW() WHERE id = :id";
        } else {
            $sql = "INSERT INTO `race` (`name`, `date`, `poster`, `year_id`, `created_at`) VALUES ( :name, :date, :poster, :yearId, NOW())";
        } 

        $query = $pdo->prepare($sql);

        $query->bindValue(":name",        $this->name,          PDO::PARAM_STR);
        $query->bindValue(":date",        $this->date,          PDO::PARAM_STR);
        $query->bindValue(":poster",      $this->poster,        PDO::PARAM_STR);
        $query->bindValue(":yearId",      $this->year_id,       PDO::PARAM_INT);

        if ($this->id > 0) {

        $query->bindValue(":id",          $this->id,            PDO::PARAM_INT);

        }
    
        $query->execute();

        if ($query->rowCount() === 1) {

        if (is_null($this->id)) {

            $this->id = $pdo->lastInsertId();
        }
            return true;

        } else {
            return false;
        }
    }


}