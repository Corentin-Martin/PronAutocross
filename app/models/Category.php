<?php

class Category extends CoreModel {
    
    private $id;
    private $name;
    private $table = 'category';


    public function getId(){ return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

}