<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;
use App\Core\Router;
use App\Services\AuthService;
use App\Repositories\UserRepository;
use App\Controllers\AuthController;
use App\Controllers\HomeController;

// Création des objets nécessaires
$session = new Session();
$userRepository = new UserRepository();
$authService = new AuthService($userRepository, $session); 

// Créer le contrôleur avec injection de dépendances si nécessaire
$homeController = new HomeController();
$authController = new AuthController($authService, $session);

// Initialiser le routeur
$router = new Router();

// Routes
$router->get('/', [$homeController, 'index']);
$router->get('/loginPage', [$authController, 'showLogin']);
$router->get('/registerPage', [$authController, 'showRegister']);
$router->post('/register', [$authController, 'register']);
$router->post('/login', [$authController, 'login']);

$router->dispatch();
