<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Core\Session;

class HomeController
{
    private $authService;
    private $session;

    public function __construct(AuthService $authService, Session $session)
    {
        $this->authService = $authService;
        $this->session = $session;
    }

    public function index()
    {
        // Si déjà connecté, rediriger vers la page de notes
        if ($this->authService->isLoggedIn()) {
            $this->redirectWithMessage('/notes', 'info', 'Vous etes déjà connecté !');
        }

        require __DIR__ . '/../../views/pages/accueil.php';
    }

    // Méthodes utilitaires pour les redirections
    public function redirect(string $path)
    {
        // Ajout du chemin de base si nécessaire
        $fullpath = '/crashProject/public' . $path;
        header('Location: ' . $fullpath);
        exit;
    }

    public function redirectWithMessage(string $path, string $type, string $message)
    {
        $this->session->flash($type, $message);
        $this->redirect($path);
    }
}