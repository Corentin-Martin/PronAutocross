<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Player extends CoreUser {

    private $pseudo;
    private $mail;
    private $password;
    private $role;

    public function getPseudo(){ return $this->pseudo; }
    public function setPseudo($pseudo): self { $this->pseudo = $pseudo; return $this; }

    public function getMail(){ return $this->mail; }
    public function setMail($mail): self { $this->mail = $mail; return $this; }

    public function getPassword(){ return $this->password; }
    public function setPassword($password): self { $this->password = $password; return $this; }

    public function getRole(){ return $this->role; }
    public function setRole($role): self { $this->role = $role; return $this; }

    public function createOrUpdate() {
        $pdo = Database::getPDO();

        if ($this->id > 0) {
            $sql = "UPDATE player SET `pseudo` = :pseudo,  `firstName` = :firstName, `lastName` = :lastName, `mail` = :mail, `password` = :password, `picture` = :picture,`role` = :role WHERE id = :id";
        } else {
            $sql = "INSERT INTO player (`pseudo`, `firstName`, `lastName`, `mail`, `password`, `picture`, `role`) VALUES (
                :pseudo, :firstName, :lastName, :mail, :password, :picture, :role)";
        }

        $query = $pdo->prepare($sql);

        $query->bindValue(":pseudo",        $this->pseudo,          PDO::PARAM_STR);
        $query->bindValue(":firstName",        $this->firstName,          PDO::PARAM_STR);
        $query->bindValue(":lastName",        $this->lastName,          PDO::PARAM_STR);
        $query->bindValue(":mail",        $this->mail,          PDO::PARAM_STR);
        $query->bindValue(":password",        $this->password,          PDO::PARAM_STR);
        $query->bindValue(":picture",        $this->picture,          PDO::PARAM_STR);
        $query->bindValue(":role",        $this->role,          PDO::PARAM_STR);

        if ($this->id > 0) {

            $query->bindValue(":id",            $this->id,              PDO::PARAM_INT);
    
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

    public function findByPseudo($pseudo) {
        $pdo = Database::getPDO();


        $pdoStatement = $pdo->query("SELECT id FROM player WHERE pseudo = '$pseudo'");

        return $pdoStatement->fetchObject(Player::class);
    }

}

