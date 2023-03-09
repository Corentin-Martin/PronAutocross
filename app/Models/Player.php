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

    public function create($pseudo, $firstName, $lastName, $mail, $password, $picture = "", $role = "") {
    $this->setPseudo($pseudo);
    $this->setFirstName($firstName);
    $this->setLastName($lastName);
    $this->setMail($mail);
    $this->setPassword($password);
    $this->setPicture($picture);
    $this->setRole($role);

    $pdo = Database::getPDO();

    $sql = "INSERT INTO player (`pseudo`, `firstName`, `lastName`, `mail`, `password`, `picture`, `role`) VALUES (
        '{$this->getPseudo()}',
        '{$this->getFirstName()}',
        '{$this->getLastName()}',
        '{$this->getMail()}',
        '{$this->getPassword()}',
        '{$this->getPicture()}',
        '{$this->getRole()}')";

    return $pdoStatement = $pdo->exec($sql);
    }

    public function createComplet($pseudo, $firstName, $lastName, $mail, $password, $picture = "", $role = "") {

        $this->create($pseudo, $firstName, $lastName, $mail, $password, $picture = "", $role = "");

        $player = $this->findByPseudo($this->getPseudo());

        $generalModel = new GeneralScore();

        $generalModel->createGeneral($player->getId(), 2023);

    }


    public function findByPseudo($pseudo) {
        $pdo = Database::getPDO();


        $pdoStatement = $pdo->query("SELECT id FROM player WHERE pseudo = '$pseudo'");

        return $pdoStatement->fetchObject(Player::class);
    }



}

