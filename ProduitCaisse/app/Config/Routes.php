<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Home;
use App\Controllers\AchatController;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->post('/achat', 'Home::achat');
$routes->get('/caisse', 'CaisseController::index');
$routes->post('/caisse/choixCaisse', 'CaisseController::choixCaisse');
$routes->get('/achat', 'Home::achat');
$routes->post('/achat/ajouter', 'AchatController::ajouter');
$routes->get('/achat/cloturer', 'AchatController::cloturer');
