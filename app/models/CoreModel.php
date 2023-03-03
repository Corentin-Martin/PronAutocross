<?php

class CoreModel {

    public function findAll($table) {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM $table");

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, ucfirst($table));
    }

    public function find($id, $table) {
        $pdo = Database::getPDO();

        $pdoStatement = $pdo->query("SELECT * FROM $table WHERE id=$id");

        return $pdoStatement->fetchObject(ucfirst($table));
    }
}