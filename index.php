<?php
require('controller/FrontController.php');
require('controller/BackController.php');

use App\Controller\FrontController;
use App\Controller\BackController;

$frontcontroller = new FrontController();
$backcontroller = new BackController();

try {
    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'gameAddView') {
            $frontcontroller->gameAddView();
        } else if ($_GET['action'] == 'gameAddTraitment') {
            $backcontroller->gameAdd();
        }

        if ($_GET['action'] == 'playerAddView') {
            $frontcontroller->playerAddView();
        } else if ($_GET['action'] == 'playerAddTraitment') {
            $backcontroller->playerAdd();
        }

        if ($_GET['action'] == 'contestAddView') {
            $frontcontroller->contestAddView();
        } else if ($_GET['action'] == 'contestAddTraitment') {
            $backcontroller->contestAdd();
        } else if ($_GET['action'] == 'contestAddTraitment') {
            $backcontroller->contestAdd();
        }

        if ($_GET['action'] == 'contestSingleView') {
            $frontcontroller->contestSingleView();
        } else if ($_GET['action'] == 'contestAddPlayer') {
            $backcontroller->contestAddPlayer();
        } else if ($_GET['action'] == 'contestDeletePlayer') {
            $backcontroller->contestDeletePlayer();
        }else if ($_GET['action'] == 'contestDelete') {
            $backcontroller->contestDelete();
        } else if ($_GET['action'] == 'contestAddWinner') {
            $backcontroller->contestAddWinner();
        }
    } else {

        $frontcontroller->homeView();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
