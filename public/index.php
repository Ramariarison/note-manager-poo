<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;
use App\Core\Router;

$session = new Session();

$router = new Router();

$router->get('/', 'HomeController@index');

$router->dispatch();