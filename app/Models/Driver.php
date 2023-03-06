<?php

namespace App\Models;

class Driver extends CoreUser {

    private $number;
    private $vehicle;
    private $rate;
    private $category_id;

    public function getNumber(){ return $this->number; }
    public function setNumber($number): self { $this->number = $number; return $this; }

    public function getVehicle(){ return $this->vehicle; }
    public function setVehicle($vehicle): self { $this->vehicle = $vehicle; return $this; }

    public function getRate(){ return $this->rate; }
    public function setRate($rate): self { $this->rate = $rate; return $this; }

    public function getCategoryId(){ return $this->category_id; }
    public function setCategoryId($category_id): self { $this->category_id = $category_id; return $this; }
}