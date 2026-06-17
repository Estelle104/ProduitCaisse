<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');                    // Home gère la vue login
$routes->post('/login/check', 'ClientController::checkLogin');

$routes->group('client', ['filter' => 'auth'], function($routes) {
    $routes->post('achat', 'Home::achat');
    $routes->get('caisse', 'CaisseController::index');
    $routes->post('caisse/choixCaisse', 'CaisseController::choixCaisse');
});