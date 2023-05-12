<?php

namespace App\Controllers\Users;

use App\Controllers\CoreController;
use App\Models\GeneralScore;
use App\Models\Participation;
use App\Models\Player;
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

        $player = Player::find($playerId);
        $friends = $player->showFriends();

        $allFriends = [];

        if (!empty($friends)) {
            foreach ($friends as $friend) {
                $generalforFriend = GeneralScore::findGeneralForPlayer($friend->getId());

                $newFriend = [];
                $newFriend['pseudo'] = $friend->getPseudo();
                $newFriend['place'] = $generalforFriend->getPlace();
                $newFriend['total'] = $generalforFriend->getTotal();
                $newFriend['id'] = $friend->getId();
                $allFriends[] = $newFriend;
            }
        }

        $sortBy = array_column($allFriends, 'place');
        array_multisort($sortBy, SORT_ASC, $allFriends);

        $this->show('user/dashboard', ['scores' => $scores, 'general' => $generalforPlayer, 'participations' => $participations, 'racesById' => $racesById, 'friends' => $allFriends]);
    }

    public function charts() {

        $scores = Score::findAllScoresbyPlayerId($_SESSION['user']->getId());
        
        $places = [];
        foreach ($scores as $score) {
            $places[] = $score->getPlace();
        }
        $placesJson = json_encode($places);

        $players = Player::findAll();
        $nbPlayers = count($players);

        $allRaces = Race::findAll();
        $races = [];
        foreach ($allRaces as $race) {
            $races[] = $race->getName();
        }
        $racesJson = json_encode($races);

        $this->show('user/charts', ['nbPlayers' => $nbPlayers, 'racesJson' => $racesJson, 'placesJson' => $placesJson]);
    }

    public function addFriends() {
        $players = Player::findOrderBy('pseudo');

        foreach ($players as $player) {
            if ($player->getId() == $_SESSION['user']->getId()) {

                $toDestroy = array_search($player, $players);
                array_splice($players, $toDestroy, 1);
            }

            if(Player::checkIfFriend($_SESSION['user']->getId(), $player->getId())) {
                $toDestroy = array_search($player, $players);
                array_splice($players, $toDestroy, 1);
            }
        }

        $this->show('user/addfriends', ['players' =>  $players]);
    }

    public function createFriends() {

        $errorList = [];

        if (empty($_POST)) {
            $errorList[] = 'Vous devez sélectionner au moins un utilisateur';
        }

        if (empty($errorList)) {
            foreach ($_POST as $newFriendId) {
                $player = Player::find($_SESSION['user']->getId());

                $player->createFriend($newFriendId);

            }

            header("Location: {$this->router->generate('user-dashboard')}");
            exit;

        }

        $players = Player::findOrderBy('pseudo');

        $this->show('user/addfriends', ['players' =>  $players, 'errorList' => $errorList]);
    }

    public function deleteFriend($friendId, $token) {
        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

        if (hex2bin($token) !== $sessionToken) {

            header( "Location: {$this->router->generate('error403')}" );
            exit;

        } else {
            unset($_SESSION['token']);
        }

        $player = Player::find($_SESSION['user']->getId());

        if ($player->deleteFriend($friendId)) {

            header("Location:  {$this->router->generate('user-dashboard')}");
            exit;

        } else {
            exit ("erreur");
        }
    }

    public function friendDashboard($friendId) {
        $player = Player::find($friendId);

        $races = Race::findByYear(date('Y'));
        $racesById = [];
        foreach ($races as $race) {
            $racesById[$race->getId()] = $race;
        }

        $scores = Score::findAllScoresbyPlayerId($friendId);
        
        $places = [];
        foreach ($scores as $score) {
            $places[] = $score->getPlace();
        }
        $placesJson = json_encode($places);

        $players = Player::findAll();
        $nbPlayers = count($players);

        $allRaces = Race::findAll();
        $races = [];
        foreach ($allRaces as $race) {
            $races[] = $race->getName();
        }
        $racesJson = json_encode($races);

        $generalforPlayer = GeneralScore::findGeneralForPlayer($friendId);

        $this->show('user/frienddashboard', ['nbPlayers' => $nbPlayers, 'racesJson' => $racesJson, 'placesJson' => $placesJson, 'player' => $player, 'scores' => $scores, 'general' => $generalforPlayer, 'racesById' => $racesById]);
    }
    
}