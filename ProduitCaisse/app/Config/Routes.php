<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->post('/achat', 'Home::achat');
$routes->get('/caisse', 'CaisseController::index');
$routes->post('/caisse/choixCaisse', 'CaisseController::choixCaisse');