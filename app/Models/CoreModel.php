<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

abstract class CoreModel {

    protected $id;
    
    public function getId(){ return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    /**
     * Undocumented function
     *
     * @return static::class[]
     */
    static public function findAll() {
        $pdo = Database::getPDO();

        if (static::class === EntryList::class) {
            $classname = 'entry_list';
        } else if (static::class === GeneralScore::class) {
            $classname = 'general_score';
        } else {
            $classname = lcfirst(substr(static::class, 11));
        }

        $sql = "SELECT * FROM $classname";

        $query = $pdo->query($sql);

        return $query->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    /**
     * Undocumented function
     *
     * @return static::class
     */
    static public function find($id) {
        $pdo = Database::getPDO();

        if (static::class === EntryList::class) {
            $classname = 'entry_list';
        } else if (static::class === GeneralScore::class) {
            $classname = 'general_score';
        } else {
            $classname = lcfirst(substr(static::class, 11));
        }

        $sql = "SELECT * FROM $classname WHERE id=$id";

        $query = $pdo->query($sql);

        return $query->fetchObject(static::class);
    }

    /**
     * Undocumented function
     *
     * @return static::class[]
     */
    static public function findByYear($yearId) {

        $pdo = Database::getPDO();

        if (static::class === EntryList::class) {
            $classname = 'entry_list';
        } else if (static::class === GeneralScore::class) {
            $classname = 'general_score';
        } else {
            $classname = lcfirst(substr(static::class, 11));
        }

        $sql = "SELECT * FROM $classname WHERE year_id = :yearId";

        $query = $pdo->prepare($sql);

        $query->bindValue(":yearId", $yearId, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function delete() {
        $pdo = Database::getPDO();

        if (get_class($this) === EntryList::class) {
            $classname = 'entry_list';
        } else if (static::class === GeneralScore::class) {
            $classname = 'general_score';
        } else {
            $classname = lcfirst(substr(static::class, 11));
        }

        $sql = 
        "DELETE FROM $classname WHERE id = :id";

        $query = $pdo->prepare($sql);

        $query->bindValue(":id", $this->id, PDO::PARAM_INT);

        $query->execute();

        return ($query->rowCount() === 1);

    }


}