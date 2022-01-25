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

    public function gameList()
    {
        $db = $this->dbConnect();
        $gameList = $db->query('SELECT * FROM game');

        return $gameList;
    }

    public function gameMinMaxPlayer($id)
    {
        $db = $this->dbConnect();
        $gameMinMaxPlayer = $db->prepare('SELECT * FROM game where id = ' . $id);
        $gameMinMaxPlayer->execute();
        $result = $gameMinMaxPlayer->fetchAll();

        return $result;
    }
}
