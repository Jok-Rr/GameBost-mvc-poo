<?php

namespace App\Model;

require_once("model/Manager.php");

class PlayerManager extends Manager
{
    public function playerAdd($player_email, $player_nickname)
    {
        $db = $this->dbConnect();
        $playerAdd = $db->prepare('INSERT INTO player(email, nickname) VALUES(?, ?)');
        $playerAddReturn = $playerAdd->execute(array($player_email, $player_nickname));

        return $playerAddReturn;
    }

    public function playerList()
    {
        $db = $this->dbConnect();
        $playerList = $db->query('SELECT * FROM player');

        return $playerList;
    }
}
