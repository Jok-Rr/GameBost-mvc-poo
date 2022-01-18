<?php

namespace App\Controller;

use App\Model\GameManager;

use Exception;

// Chargement des classes
require_once('model/GameManager.php');

class FrontController
{
    private $postManager;
    private $commentManager;

    function __construct()
    {
        $this->gameManager = new GameManager();
    }

    public function homeView(){
        require('view/frontEnd/homeView.php');
    }

    public function gameAddView(){
        require('view/frontEnd/gameAddView.php');
    }
}
