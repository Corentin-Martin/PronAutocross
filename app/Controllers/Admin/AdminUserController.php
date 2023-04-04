<?php

namespace App\Controllers\Admin;

use App\Models\Participation;
use App\Models\Player;
use App\Models\Race;

class AdminUserController extends AdminCoreController
{
    public function home() {
        $this->show('admin/user/home');
    }

    public function list($action) {
        $users = Player::findOrderBy($action);

        $total = count(Player::findAll());

        $this->show('admin/user/list', ['users' => $users, 'total' => $total]);
    }

    public function edit($id) {
        $player = Player::find($id);

        $this->show('admin/user/edit', ['player' => $player]);
    }

    public function update($id) {
        if (isset($_POST)) {
            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
            $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
            $mail = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);

            $errorList = [];

            if (empty($pseudo) || empty($firstName) || empty($lastName) || empty($mail) || empty($role)) {
                $errorList[] = "Tous les champs sont obligatoires.";
            }

            if (empty($errorList)) {
                $player = Player::find($id);
    
                $player->setPseudo($pseudo);
                $player->setFirstName($firstName);
                $player->setLastName($lastName);
                $player->setMail($mail);
                $player->setRole($role);
    
                if ($player->createOrUpdate()) {
    
                    header("Location: {$this->router->generate('adminuser-list', ['action' => 'id'])}");
                    exit; 
    
                } else {
                    $errorList[] = "Erreur lors de l'enregistrement.";
                }
            } 

            $player = Player::find($id);

            $this->show('admin/user/edit', ['player' => $player, 'errorList' => $errorList]);

        } else {
            header("Location: {$this->router->generate('error403')}");
            exit; 
        }
    }

    public function delete($id, $token) {

        $sessionToken = isset($_SESSION['token']) ? $_SESSION['token'] : '';

        if (hex2bin($token) !== $sessionToken) {

            header( "Location: {$this->router->generate('error403')}" );
            exit;

        } else {
            unset($_SESSION['token']);
        }

        $player = Player::find($id);

        if ($player->delete()) {

            header("Location: {$this->router->generate('adminuser-list', ['action' => 'id'])}");
            exit;

        } else {
            exit ("erreur");
        }
        
    }

    public function showParticipations($raceId) {

        $races = Race::findByYear(date('Y'));

        $race = Race::find($raceId);
        $participations = Participation::showAllParticipations(date('Y'), $raceId);

        $total = count($participations);

        $players = Player::findAll();
        $playersById = [];
        foreach ($players as $player) {
            $playersById[$player->getId()] = $player;
        }

        $this->show('admin/user/participations', ['participations' => $participations, 'players' => $playersById, 'currentRace' => $race, 'total' => $total, 'races' => $races]);
    }
}