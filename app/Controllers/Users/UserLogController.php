<?php

namespace App\Controllers\Users;

use App\Controllers\CoreController;
use App\Models\GeneralScore;
use App\Models\Player;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

        if (is_null($id)) {
            if (Player::findByMail($email)) {
                $errorList[] = "Un compte est déjà enregistré à cette adresse mail.";
            }
    
            if (Player::findByPseudo($pseudo)) {
                $errorList[] = "Pseudo déjà utilisé.";
            }
        }


        if (empty($errorList)) {

            if ($id) {
                $player = Player::find($id);
            } else {
                $player = new Player();
            }
    
            $player->setPseudo(rtrim($pseudo));
            $player->setFirstName(rtrim($firstname));
            $player->setLastName(rtrim($lastname));
            $player->setMail($email);
            $player->setPassword(password_hash(rtrim($password), PASSWORD_DEFAULT));
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

                $_SESSION['user'] = $player;
                header("Location: {$this->router->generate('user-dashboard')}");
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
        $passwordWithoutEmptySpace = rtrim($password);

        $errorList = [];

        if ($mail === null || $mail === false || $password === null || $password === false || strlen($password) < 8) {
            $errorList[] = "Identifiants incorrects";
        }

        if (empty($errorList)){

          $user = Player::findByMail($mail);
  
          if ($user === false){

            $errorList[] = "Identifiants incorrects";

          } else {

            if( password_verify( $passwordWithoutEmptySpace, $user->getPassword()) )
            {

              $_SESSION['user'] = $user;
  
              if ($user->getRole() === 'admin') {
                header( "Location: {$this->router->generate('admin')}");
                exit;
              } elseif ($user->getRole() === 'editor') {
                header( "Location: {$this->router->generate('user-dashboard')}");
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
        unset($_SESSION['token']);

        header( "Location: {$this->router->generate('home')}" );
        exit();
    }

    public function forgetPassword() {

        $this->show('user/forgetpassword');

    }

    public function sendMailForPassword() {

        $errorList = [];
        $okList = [];

        $player = Player::findByMail($_POST['email']);

        if ($player) {

            $token = uniqid();  

            $player->insertToken($token);

            $mail = new PHPMailer(true);

            try {
                $configData = parse_ini_file(__DIR__ . '/../../config.ini');
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.pronautocross.fr';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $configData['MAIL_USERNAME'];                     //SMTP username
                $mail->Password   = $configData['MAIL_PASSWORD'];                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('no-reply@pronautocross.fr', 'PronAutocross - Recuperation de mot de passe');
                $mail->addAddress($player->getMail());     //Add a recipient

                $link = "http://www.pronautocross.fr/user/recup-password/" . $token;

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->CharSet = "UTF-8";
                $mail->Subject = "Votre demande de récupération de mot de passe - Pron'Autocross";
                $mail->Body    = "<p> Bonjour {$player->getPseudo()}, </p> <p> Vous avez effectué une demande de réinitialisation de mot de passe. Pour la poursuivre et créer un nouveau mot de passe, <a href='{$link}'>cliquez ici</a>.</p> <p> Si cette demande ne vient pas de vous, veuillez ignorer cet email. </p>";
                $mail->AltBody = "Bonjour {$player->getPseudo()}. Vous avez effectué une demande de réinitialisation de mot de passe. Pour la poursuivre et créer un nouveau mot de passe, rendez-vous sur http://www.pronautocross.fr/user/recup-password/{$token} . Si cette demande ne vient pas de vous, veuillez ignorer cet email.";

                $mail->send();

                $okList[] = "Rendez-vous dans votre boite mail pour poursuivre la réinitialisation de votre mot de passe ! (Pensez à regarder dans vos spams si votre boite de réception est vide).";

            } catch (Exception $e) {

                $errorList[] = "Une erreur s'est produite, veuillez réessayer.";
            }

        } else {
            $errorList[] = "Cette adresse mail ne correspond à aucun compte.";
        }

        if (!empty($errorList)) {
            $this->show('user/forgetpassword', ["errorList" => $errorList]);
        }

        if (!empty($okList)) {
            $this->show('user/forgetpassword', ["okList" => $okList]);
        }
        
    }

    public function redefinePassword($token) {
        $errorList = [];

        $player = Player::findByToken($token);

        if($player) {

            $tokenDate = strtotime('+3 hours', strtotime($player->getPasswordAskedDate()));
            $todayDate = time();
            $tokenValid = true;

            if ($tokenDate < $todayDate) {
                $tokenValid = false;
                $errorList[] = "Votre demande de réinitialisation de mot de passe a expiré. Veuillez recommencer.";
            }



        } else {
            $player = null;
            $tokenValid = false;
            $errorList[] = "Une erreur est survenue, impossible de réinitialiser le mot de passe.";
        }

        if (!empty($_POST)) {
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
            $passwordConfirm = filter_input(INPUT_POST, 'passwordConfirm', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($password !== $passwordConfirm) {
                $errorList[] = "Attention, les mots de passe ne sont pas identiques.";
            }
    
            if (strlen($password) < 8) {
                $errorList[] = "Votre mot de passe doit contenir au moins 8 caractères.";
            }

            if (empty($errorList)) {
                $player->setPassword(password_hash(rtrim($password), PASSWORD_DEFAULT));
                $player->setPasswordToken(null);
                $player->setPasswordAskedDate(null);

                if($player->createOrUpdate()) {

                    $_SESSION['user'] = $player;
                    header("Location: {$this->router->generate('user-dashboard')}");
                    exit;
    
                } else {
                    $errorList[] = "Une erreur est survenue, veuillez réessayer";
                }


            }
        }
        $this->show('user/reinitpassword', ["player" => $player, "errorList" => $errorList, 'tokenValid' => $tokenValid]);
    }
}