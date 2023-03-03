<?php

class CoreUser extends CoreModel {

    protected $id;
    protected $firstName;
    protected $lastName;
    protected $picture;

    public function getId(){ return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    public function getFirstName(){ return $this->firstName; }
    public function setFirstName($firstName): self { $this->firstName = $firstName; return $this; }

    public function getLastName(){ return $this->lastName; }
    public function setLastName($lastName): self { $this->lastName = $lastName; return $this; }

    public function getPicture(){ return $this->picture; }
    public function setPicture($picture): self { $this->picture = $picture; return $this; }
}