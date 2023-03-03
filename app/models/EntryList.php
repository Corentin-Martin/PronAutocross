<?php

class EntryList {
    
    private $id;
    private $race_id;
    private $category_id;
    private $driver_id;

    public function getId(){ return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    public function getRaceId(){ return $this->race_id; }
    public function setRaceId($race_id): self { $this->race_id = $race_id; return $this; }

    public function getCategoryId(){ return $this->category_id; }
    public function setCategoryId($category_id): self { $this->category_id = $category_id; return $this; }

    public function getDriverId(){ return $this->driver_id; }
    public function setDriverId($driver_id): self { $this->driver_id = $driver_id; return $this; }
}