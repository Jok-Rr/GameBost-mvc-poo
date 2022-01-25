<?php

namespace App\Model;

require_once("model/Manager.php");

class ContestManager extends Manager
{



    public function contestAdd($game_id, $start_date)
    {
        $db = $this->dbConnect();
        $contestAdd = $db->prepare('INSERT INTO contest(game_id, start_date) VALUES(?, ?)');
        $contestAddReturn = $contestAdd->execute(array($game_id, $start_date));

        return $contestAddReturn;
    }



    public function contestPlayerDelete($player_id, $contest_id)
    {
        $db = $this->dbConnect();
        $contestDelete = $db->query('DELETE FROM player_contest WHERE player_id = ' . $player_id . ' AND contest_id =' . $contest_id);

        return $contestDelete;
    }




    public function contestPlayerAdd($player_id, $contest_id)
    {
        $db = $this->dbConnect();
        $contestAdd = $db->prepare('INSERT INTO player_contest(player_id, contest_id) VALUES(?, ?)');
        $contestAddReturn = $contestAdd->execute(array($player_id, $contest_id));

        return $contestAddReturn;
    }



    public function contestDelete($contest_id)
    {
        $db = $this->dbConnect();
        $contestDelete = $db->query('DELETE FROM contest WHERE contest.id = ' . $contest_id );

        return $contestDelete;
    }

    
    public function contestAddWinner($player_id, $contest_id){
        $db = $this->dbConnect();
        $contestAdd = $db->prepare('UPDATE contest SET winner_id=?  WHERE id = ' . $contest_id);
        $contestAddWinner = $contestAdd->execute(array($player_id));

        return $contestAddWinner;
    }

    public function contestList()
    {

        $db = $this->dbConnect();
        $contestList = $db->query('SELECT contest.id, game.title, game.id as game_id, COUNT(player_contest.id) as nombre_joueur, start_date, player.nickname as player_winner, contest.winner_id
        FROM contest
        LEFT JOIN player_contest on contest.id = player_contest.contest_id 
        INNER JOIN game on contest.game_id = game.id
        LEFT JOIN player on contest.winner_id = player.id
        GROUP by contest.id
        ORDER BY start_date ASC');
        return $contestList;
    }



    public function contestSingleView($id)
    {
        $db = $this->dbConnect();
        $contestDetail = $db->query('SELECT contest.id, player.nickname as winner_name, game.title, start_date, player.nickname, player.email, COUNT(player_contest.id) as nombre_joueur 
        FROM contest 
        LEFT JOIN player_contest on contest.id = player_contest.contest_id 
        INNER JOIN game on contest.game_id = game.id
        LEFT JOIN player on contest.winner_id = player.id WHERE contest.id = ' . $id);
        return $contestDetail;
    }



    public function contestPlayerList($id)
    {
        $db = $this->dbConnect();
        $contestPlayerList = $db->query('SELECT * FROM player_contest 
        INNER JOIN player ON player_contest.player_id = player.id
        RIGHT JOIN contest ON player_contest.contest_id = contest.id
        WHERE contest_id = ' . $id);
        return $contestPlayerList;
    }
}
