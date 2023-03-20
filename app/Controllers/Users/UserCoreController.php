<?php

namespace App\Controllers\Users;

use App\Controllers\CoreController;
use App\Models\Category;
use App\Models\EntryList;
use App\Models\GeneralScore;
use App\Models\Participation;
use App\Models\Questions;
use App\Models\Rate;
use App\Models\Score;

class UserCoreController extends CoreController
{
    protected $router;
    protected $match;
    protected $dispatcher;
    
    public function __construct($router, $match, $dispatcher) {
        $this->router = $router;
        $this->match = $match;
        $this->dispatcher = $dispatcher;

        if($this->checkAuthorization(['admin', 'member', 'editor']) === false) {
            header("Location: {$this->router->generate('home')}");
            exit;
        };
    }

    public function recap() {

       

        $this->show('user/recap');
    }

    public function dashboard() {

        $playerId = $_SESSION['user']->getId();

       $scores = Score::findAllScoresbyPlayerId($playerId);

       $generalforPlayer = GeneralScore::findGeneralForPlayer($playerId);
       

        $this->show('user/dashboard', ['scores' => $scores, 'general' => $generalforPlayer]);
    }
}