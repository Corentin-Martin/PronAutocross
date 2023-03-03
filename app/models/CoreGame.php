<?php

class CoreGame {

    protected $id;
    protected $maxiSprint;
    protected $tourismeCup;
    protected $sprintGirls;
    protected $buggyCup;
    protected $juniorSprint;
    protected $maxiTourisme;
    protected $buggy1600;
    protected $superSprint;
    protected $superBuggy;
    protected $bonus1;
    protected $bonus2;
    protected $race_id;

    public function getId(){ return $this->id; }
    public function setId($id): self { $this->id = $id; return $this; }

    public function getMaxiSprint(){ return $this->maxiSprint; }
    public function setMaxiSprint($maxiSprint): self { $this->maxiSprint = $maxiSprint; return $this; }

    public function getTourismeCup(){ return $this->tourismeCup; }
    public function setTourismeCup($tourismeCup): self { $this->tourismeCup = $tourismeCup; return $this; }

    public function getSprintGirls(){ return $this->sprintGirls; }
    public function setSprintGirls($sprintGirls): self { $this->sprintGirls = $sprintGirls; return $this; }

    public function getBuggyCup(){ return $this->buggyCup; }
    public function setBuggyCup($buggyCup): self { $this->buggyCup = $buggyCup; return $this; }

    public function getJuniorSprint(){ return $this->juniorSprint; }
    public function setJuniorSprint($juniorSprint): self { $this->juniorSprint = $juniorSprint; return $this; }

    public function getMaxiTourisme(){ return $this->maxiTourisme; }
    public function setMaxiTourisme($maxiTourisme): self { $this->maxiTourisme = $maxiTourisme; return $this; }

    public function getBuggy1600(){ return $this->buggy1600; }
    public function setBuggy1600($buggy1600): self { $this->buggy1600 = $buggy1600; return $this; }

    public function getSuperSprint(){ return $this->superSprint; }
    public function setSuperSprint($superSprint): self { $this->superSprint = $superSprint; return $this; }

    public function getSuperBuggy(){ return $this->superBuggy; }
    public function setSuperBuggy($superBuggy): self { $this->superBuggy = $superBuggy; return $this; }

    public function getBonus1(){ return $this->bonus1; }
    public function setBonus1($bonus1): self { $this->bonus1 = $bonus1; return $this; }

    public function getBonus2(){ return $this->bonus2; }
    public function setBonus2($bonus2): self { $this->bonus2 = $bonus2; return $this; }

    public function getRaceId(){ return $this->race_id; }
    public function setRaceId($race_id): self { $this->race_id = $race_id; return $this; }
}