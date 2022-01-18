<?php

namespace App\Model;

require_once("model/Manager.php");

class GameManager extends Manager
{
    public function gameAdd($game_title, $game_min_players, $game_max_players)
    {
        $db = $this->dbConnect();
        $gameAdd = $db->prepare('INSERT INTO game(title, min_players, max_players) VALUES(?, ?, ?)');
        $gameAddReturn = $gameAdd->execute(array($game_title, $game_min_players, $game_max_players));

        return $gameAddReturn;
    }

}
