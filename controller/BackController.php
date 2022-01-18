<?php

namespace App\Controller;

use App\Model\GameManager;

use Exception;

require_once('model/GameManager.php');

class BackController
{
    private $gameManager;

    function __construct()
    {
        $this->gameManager = new GameManager();
        //$this->playerManager = new CommentManager();
        //$this->contestManager = new CommentManager();
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
        }else{
            header('Location: index.php?action=gameAddView');
        }
    }
}
