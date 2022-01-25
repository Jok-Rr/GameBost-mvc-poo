<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\PlayerManager;
use App\Model\ContestManager;

use Exception;

// Chargement des classes
require_once('model/GameManager.php');
require_once('model/PlayerManager.php');
require_once('model/ContestManager.php');
require_once('function.php');

class FrontController
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

    public function homeView()
    {
        $time = new \DateTime();
        $playerList = $this->playerManager->playerList();
        $gameList = $this->gameManager->gameList();
        $contestList = $this->contestManager->contestList();
        require('view/frontEnd/homeView.php');
    }

    public function gameAddView()
    {
        require('view/frontEnd/gameAddView.php');
    }

    public function playerAddView()
    {
        require('view/frontEnd/playerAddView.php');
    }

    public function contestAddView()
    {
        $gameList = $this->gameManager->gameList();
        require('view/frontEnd/contestAddView.php');
    }

    public function contestSingleView(){
        $time = new \DateTime();
        $playerList = $this->playerManager->playerList();
        $gameList = $this->gameManager->gameMinMaxPlayer($_GET["game_id"]);
        $contestDetail = $this->contestManager->contestSingleView($_GET["id"]);
        $contestDetailFetchAll = $contestDetail->fetchAll();
        $contestPLayerList = $this->contestManager->contestPlayerList($_GET["id"]);
        $contestPlayerNbr = $contestPLayerList->rowCount();
        require('view/frontEnd/contestSingleView.php');
    }
}
