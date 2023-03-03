<?php

class Participation extends CoreGame {

    private $player_id;
    private $verification_id;

    public function getPlayerId(){ return $this->player_id; }
    public function setPlayerId($player_id): self { $this->player_id = $player_id; return $this; }

    public function getVerificationId(){ return $this->verification_id; }
    public function setVerificationId($verification_id): self { $this->verification_id = $verification_id; return $this; }
}