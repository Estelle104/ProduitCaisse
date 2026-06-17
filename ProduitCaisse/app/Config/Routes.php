<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\AchatController;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');                    // Home gère la vue login
$routes->post('/login/check', 'ClientController::checkLogin');

$routes->group('client', ['filter' => 'auth'], function($routes) {
    $routes->post('achat', 'Home::achat');
    $routes->get('caisse', 'CaisseController::index');
    $routes->post('caisse/choixCaisse', 'CaisseController::choixCaisse');
    $routes->post('achat', 'Home::achat');
    $routes->get('achat', 'Home::achat');
    $routes->post('achat/ajouter', 'AchatController::ajouter');
    $routes->get('achat/cloturer', 'AchatController::cloturer');
});

$routes->get('/logout', function() {
    session()->destroy();
    return redirect()->to('/login');
});