<?php

class Score extends CoreGame {
    
    private $total;
    private $player_id;
    private $participation_id;

    public function getTotal(){ return $this->total; }
    public function setTotal($total): self { $this->total = $total; return $this; }

    public function getPlayerId(){ return $this->player_id; }
    public function setPlayerId($player_id): self { $this->player_id = $player_id; return $this; }

    public function getParticipationId(){ return $this->participation_id; }
    public function setParticipationId($participation_id): self { $this->participation_id = $participation_id; return $this; }
}