<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Session;
use App\Core\Router;
use App\Services\AuthService;
use App\Services\NoteService;
use App\Repositories\UserRepository;
use App\Repositories\NoteRepository;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\NoteController;

// Création des objets nécessaires
$session = new Session();
$userRepository = new UserRepository();
$noteRepository = new NoteRepository();
$authService = new AuthService($userRepository, $session);
$noteService = new NoteService($noteRepository, $session);

// Créer le contrôleur avec injection de dépendances si nécessaire
$homeController = new HomeController($authService, $session);
$authController = new AuthController($authService, $session);
$noteController = new NoteController($session, $authService, $noteService);

// Initialiser le routeur
$router = new Router();

// Routes
$router->get('/', [$homeController, 'index']);
$router->get('/loginPage', [$authController, 'showLogin']);
$router->get('/registerPage', [$authController, 'showRegister']);
$router->post('/register', [$authController, 'register']);
$router->post('/login', [$authController, 'login']);
$router->post('/notes/store', [$noteController, 'addNote']);
$router->post('/notes/update', [$noteController, 'editNote']);
$router->post('/notes/delete', [$noteController, 'delete']);

$router->get('/notes', [$noteController, 'index']);

$router->dispatch();
