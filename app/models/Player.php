<?php

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
}