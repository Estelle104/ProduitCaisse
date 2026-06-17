<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->post('/achat', 'Home::achat');
$routes->get('/achat', 'Home::achat');
