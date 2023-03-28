<?php

namespace App\Controllers\Users;

use App\Controllers\CoreController;
use App\Models\GeneralScore;
use App\Models\Participation;
use App\Models\Race;
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

        $csrfTokenToCheck = [
            'user-update',
          ];
  
          if (in_array($match['name'], $csrfTokenToCheck)) {
              
              $postToken = isset($_POST['token']) ? $_POST['token'] : '';
              $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';
  
              if ($postToken !== $sessionToken || empty($postToken)) {
  
                header( "Location: {$this->router->generate('error403')}" );
                exit;
  
              } else {
                  unset($_SESSION['token']);
              }
          }
    }

    public function dashboard() {

        $playerId = $_SESSION['user']->getId();
        
        $races = Race::findByYear(date('Y'));
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $scores = Score::findAllScoresbyPlayerId($playerId);

        $generalforPlayer = GeneralScore::findGeneralForPlayer($playerId);

        $participations = Participation::showAllForAPlayer(date('Y'), $playerId);
       

        $this->show('user/dashboard', ['scores' => $scores, 'general' => $generalforPlayer, 'participations' => $participations, 'racesById' => $racesById]);
    }
}