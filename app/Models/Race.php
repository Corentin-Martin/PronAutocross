<?php

namespace App\Models;

class Race extends CoreModel {
    
    private $name;
    private $date;
    private $poster;

    public function getName(){ return $this->name; }
    public function setName($name): self { $this->name = $name; return $this; }

    public function getDate(){ return $this->date; }
    public function setDate($date): self { $this->date = $date; return $this; }

    public function getPoster(){ return $this->poster; }
    public function setPoster($poster): self { $this->poster = $poster; return $this; }
}