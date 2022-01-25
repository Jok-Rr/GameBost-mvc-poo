<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\PlayerManager;
use App\Model\ContestManager;

use Exception;

require_once('model/GameManager.php');
require_once('model/PlayerManager.php');
require_once('model/ContestManager.php');
require_once('function.php');

class BackController
{
    private $gameManager;
    private $playerManager;
    private $contestManager;

    function __construct()
    {
        $this->gameManager = new GameManager();
        $this->playerManager = new PlayerManager();
        $this->contestManager = new ContestManager();
    }

    //! Funct pour ajouter un jeux dans la base.
    public function gameAdd()
    {
        $error = false;

        //! Si l'on a un formulaire
        if (isset($_POST["submit"])) {

            //! Si les donnée sont initier.
            if (isset($_POST['game_title']) && isset($_POST['game_min_players']) && isset($_POST['game_max_players'])) {

                $game_title = $_POST['game_title'];
                $game_min_players = (int)$_POST['game_min_players'];
                $game_max_players = (int)$_POST['game_max_players'];
            }

            //! Vérifications de la conformité des données.
            if (empty($game_title) || strlen($game_title) > 50) {
                $error = true;
            } elseif (empty($game_min_players) || gettype($game_min_players) != 'integer') {
                $error = true;
            } elseif (empty($game_max_players) || gettype($game_min_players) != 'integer') {
                $error = true;
            }

            //! Si pas d'erreur on enregistrer dans la base et redirection.
            if ($error === false) {
                $this->gameManager->gameAdd($game_title, $game_min_players, $game_max_players);

                header('Location: index.php?ok');
            } else {
                header('Location: index.php?nook');
            }
        } else {
            header('Location: index.php');
        }
    }


    public function playerAdd()
    {
        $error = false;

        //! Si l'on a un formulaire
        if (isset($_POST["submit"])) {

            //! Si les donnée sont initier.
            if (isset($_POST['player_email']) && isset($_POST['player_nickname'])) {

                $player_email = $_POST['player_email'];
                $player_nickname = $_POST['player_nickname'];
            }

            //! Vérifications de la conformité des données.
            if (empty($player_email) || strlen($player_email) > 50 || !filter_var($player_email, FILTER_VALIDATE_EMAIL)) {
                $error = true;
            } elseif (empty($player_nickname) || strlen($player_nickname) > 50) {
                $error = true;
            }

            //! Si pas d'erreur on enregistrer dans la base et redirection.
            if ($error === false) {
                $this->playerManager->playerAdd($player_email, $player_nickname);

                header('Location: index.php?ok');
            } else {
                header('Location: index.php?nook');
            }
        } else {
            header('Location: index.php');
        }
    }

    public function contestAdd()
    {
        $error = false;

        //! Si l'on a un formulaire
        if (isset($_POST["submit"])) {

            //! Si les donnée sont initier.
            if (isset($_POST['contest_game']) && isset($_POST['start_date'])) {

                $game_id = (int)$_POST['contest_game'];
                $start_date = $_POST['start_date'];
            }

            //! Vérifications de la conformité des données.
            if (empty($game_id) || gettype($game_id) != 'integer') {
                $error = true;
            } elseif (empty($start_date) || !isValidDate($start_date)) {
                $error = true;
            }

            //! Si pas d'erreur on enregistrer dans la base et redirection.
            if ($error === false) {
                $this->contestManager->contestAdd($game_id, $start_date);

                header('Location: index.php?ok');
            } else {
                header('Location: index.php?nook');
            }
        } else {
            header('Location: index.php');
        }
    }

    public function contestDelete()
    {
        $error = false;

        //! Si l'on a un formulaire
        if (isset($_GET)) {

            //! Si les donnée sont initier.
            if (isset($_GET['contest_id'])) {

                $contest_id = (int)$_GET['contest_id'];
            }

            //! Vérifications de la conformité des données.
            if (empty($contest_id) || gettype($contest_id) != 'integer') {
                $error = true;
            }

            //! Si pas d'erreur on enregistrer dans la base et redirection.
            if ($error === false) {
                $this->contestManager->contestDelete($contest_id);

                header('Location: index.php?ok');
            } else {
                header('Location: index.php?nook');
            }
        } else {
            header('Location: index.php');
        }
    }

    public function contestAddPlayer()
    {
        $error = false;
        //! Si l'on a un formulaire
        if (isset($_POST["submit"])) {

            //! Si les donnée sont initier.
            if (isset($_POST['player_id']) && isset($_POST['contest_id']) && isset($_POST['game_id'])) {

                $player_id = (int)$_POST['player_id'];
                $contest_id = (int)$_POST['contest_id'];
                $game_id = (int)$_POST['game_id'];
            }

            //! Vérifications de la conformité des données.
            if (empty($player_id) || gettype($player_id) != 'integer') {
                $error = true;
            } elseif (empty($contest_id) || gettype($contest_id) != 'integer') {
                $error = true;
            }

            //! Si pas d'erreur on enregistrer dans la base et redirection.
            if ($error === false) {
                $this->contestManager->contestPlayerAdd($player_id, $contest_id);

                header('Location: index.php?action=contestSingleView&id=' . $contest_id . '&game_id=' . $game_id);
            } else {
                header('Location: index.php?action=contestSingleView&id=' . $contest_id . '&game_id=' . $game_id);
            }
        } else {
            header('Location: index.php');
        }
    }

    public function contestDeletePlayer()
    {
        $error = false;
        //! Si l'on a un formulaire
        if (isset($_GET)) {

            //! Si les donnée sont initier.
            if (isset($_GET['player_id']) && isset($_GET['contest_id']) && isset($_GET['game_id'])) {
                $player_id = (int)$_GET['player_id'];
                $contest_id = (int)$_GET['contest_id'];
                $game_id = (int)$_GET['game_id'];
            }

            //! Vérifications de la conformité des données.
            if (empty($player_id) || gettype($player_id) != 'integer') {
                $error = true;
            } elseif (empty($contest_id) || gettype($contest_id) != 'integer') {
                $error = true;
            }

            //! Si pas d'erreur on enregistrer dans la base et redirection.
            if ($error === false) {
                $this->contestManager->contestPlayerDelete($player_id, $contest_id);

                header('Location: index.php?action=contestSingleView&id=' . $contest_id . '&game_id=' . $game_id);
            } else {
                header('Location: index.php?action=contestSingleView&id=' . $contest_id . '&game_id=' . $game_id);
            }
        } else {
            header('Location: index.php');
        }
    }

    public function contestAddWinner()
    {
        $error = false;
        //! Si l'on a un formulaire
        if (isset($_GET)) {

            

            //! Si les donnée sont initier.
            if (isset($_GET['player_id']) && isset($_GET['contest_id']) && isset($_GET['game_id'])) {
                $player_id = (int)$_GET['player_id'];
                $contest_id = (int)$_GET['contest_id'];
                $game_id = (int)$_GET['game_id'];
            }

            //! Vérifications de la conformité des données.
            if (empty($player_id) || gettype($player_id) != 'integer') {
                $error = true;
            } elseif (empty($contest_id) || gettype($contest_id) != 'integer') {
                $error = true;
            }

            //! Si pas d'erreur on enregistrer dans la base et redirection.
            if ($error === false) {
                $this->contestManager->contestAddWinner($player_id, $contest_id);

                header('Location: index.php?action=contestSingleView&id=' . $contest_id . '&game_id=' . $game_id);
            } else {
                header('Location: index.php?action=contestSingleView&id=' . $contest_id . '&game_id=' . $game_id);
            }
        } else {
            header('Location: index.php');
        }
    }
}
