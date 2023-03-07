<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Player extends CoreUser {

    private $pseudo;
    private $mail;
    private $password;
    private $points;
    private $role;

    public function getPseudo(){ return $this->pseudo; }
    public function setPseudo($pseudo): self { $this->pseudo = $pseudo; return $this; }

    public function getMail(){ return $this->mail; }
    public function setMail($mail): self { $this->mail = $mail; return $this; }

    public function getPassword(){ return $this->password; }
    public function setPassword($password): self { $this->password = $password; return $this; }

    public function getPoints(){ return $this->points; }
    public function setPoints($points): self { $this->points = $points; return $this; }

    public function getRole(){ return $this->role; }
    public function setRole($role): self { $this->role = $role; return $this; }

    public function addPoints($playerId, $points) {

        $pdo = Database::getPDO();

        $sql = "UPDATE player SET points = $points WHERE id = $playerId";

        return $pdoStatement = $pdo->exec($sql);


    }

        /**
     * Tri les scores des participants pour une course
     *
     * @param int $raceId // L'id de la course
     * @return Score[]
     */
    public function sortingGeneral() {

        $pdo = Database::getPDO();

            $sql = "SELECT * FROM `player` ORDER BY `points` DESC, `pseudo` ASC";

            $pdoStatement = $pdo->query($sql);

        return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Score::class);
    }
}