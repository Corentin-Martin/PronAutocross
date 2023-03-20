<?php

namespace App\Controllers\Users;

use App\Controllers\CoreController;
use App\Models\GeneralScore;
use App\Models\Player;

class UserLogController extends CoreController
{
    public function inscription($id = null) {

        if ($id) {
            $player = Player::find($id);
        } else {
            $player = null;
        }

        $this->show('user/inscription', ['player' => $player]);
    }

    public function createOrUpdate($id = null) {

        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
        $firstname = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_SPECIAL_CHARS);
        $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);

        $errorList = [];

        if (!$pseudo || !$firstname|| !$lastname || !$email || !$password) {
            $errorList[] = "Tous les champs sont obligatoires.";
        }

        if ($password !== $passwordConfirm) {
            $errorList[] = "Attention, les mots de passe ne sont pas identiques.";
        }

        if (strlen($password) < 8) {
            $errorList[] = "Votre mot de passe doit contenir au moins 8 caractères.";
        }

        if (empty($errorList)) {

            if ($id) {
                $player = Player::find($id);
            } else {
                $player = new Player();
            }
    
            $player->setPseudo($pseudo);
            $player->setFirstName($firstname);
            $player->setLastName($lastname);
            $player->setMail($email);
            $player->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $player->setRole($role);
    
            if ($id) {
                $player->setId($id);
            } 

            if($player->createOrUpdate()) {

                if (!$id) {
                    $general = new GeneralScore();

                    $general->setPlayerId($player->getId());
                    $general->setYearId(date('Y'));
                    
                    $general->createOrUpdate();
                }

                header("Location: /");
                exit;

            } else {
                $errorList[] = "Une erreur est survenue, veuillez réessayer";
            }
        }

        $this->show('user/inscription', ["errorList" => $errorList, 'player' => null]);

    }

    public function login() {

        $this->show('user/login');
    }

    public function connexion() {

        $mail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

        $errorList = [];

        if ($mail === null || $mail === false || $password === null || $password === false || strlen($password) < 8) {
            $errorList[] = "Identifiants incorrects";
        }

        if (empty($errorList)){

          $user = Player::findByMail($mail);
  
          if ($user === false){

            $errorList[] = "Identifiants incorrects";

          } else {

            if( password_verify( $password, $user->getPassword() ) )
            {

              $_SESSION['user'] = $user;
  
              if ($user->getRole() === 'admin') {
                header( "Location: {$this->router->generate('admin')}");
                exit;
              } elseif ($user->getRole() === 'editor') {
                header( "Location: {$this->router->generate('admin')}");
                exit;
              } else {
                header( "Location: {$this->router->generate('user-dashboard')}");
                exit;
              }

            }
            else 
            {
              $errorList[] = "Identifiants incorrects";
            }          
          }        
        }

        $this->show('user/login', ['errorList' => $errorList]);
    }

    public function logout() {
        unset($_SESSION['user']);

        header( "Location: {$this->router->generate('home')}" );
        exit();
    }
}