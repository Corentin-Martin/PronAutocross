<?php

namespace App\Models;

class Category extends CoreModel {
    
    private $name;

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

}