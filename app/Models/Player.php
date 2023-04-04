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
            $sql = "UPDATE player SET `pseudo` = :pseudo,  `firstName` = :firstName, `lastName` = :lastName, `mail` = :mail, `password` = :password, `picture` = :picture,`role` = :role, `updated_at` = NOW() WHERE id = :id";
        } else {
            $sql = "INSERT INTO player (`pseudo`, `firstName`, `lastName`, `mail`, `password`, `picture`, `role`, `created_at`) VALUES (
                :pseudo, :firstName, :lastName, :mail, :password, :picture, :role, NOW())";
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

    /**
     * Undocumented function
     *
     * @return Player
     */
    static public function findByMail($mail) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `player` WHERE mail = :mail";

        $query = $pdo->prepare($sql);

        $query->bindValue(":mail",        $mail,          PDO::PARAM_STR);

        $query->execute();

        return $query->fetchObject(Player::class);
    }

    static public function findByPseudo($pseudo) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `player` WHERE pseudo = :pseudo";

        $query = $pdo->prepare($sql);

        $query->bindValue(":pseudo",        $pseudo,          PDO::PARAM_STR);

        $query->execute();

        return $query->fetchObject(Player::class);
        
    }

    /**
     * Undocumented function
     *
     * @param [type] $order
     * @return Player[]
     */
    static public function findOrderBy($order) {
        $pdo = Database::getPDO();

        $sql = "SELECT * FROM `player` ORDER BY $order";

        $query = $pdo->prepare($sql);

        $query->execute();

        return $query->fetchAll(PDO::FETCH_CLASS, Player::class);
        
    }

}

