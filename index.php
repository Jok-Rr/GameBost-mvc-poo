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
        }

        if ($_GET['action'] == 'gameAddTraitment') {
            $backcontroller->gameAdd();
        }
    } else {

        $frontcontroller->homeView();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
