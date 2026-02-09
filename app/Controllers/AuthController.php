<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Core\Session;

class AuthController
{
    private $authService;
    private $session;

    public function __construct(AuthService $authService, Session $session)
    {
        $this->authService = $authService;
        $this->session = $session;
    }

    // Méthode pour afficher la page de connexion
    public function showLogin()
    {
        // Si déjà connecté, rediriger vers la page de notes
        if ($this->authService->isLoggedIn()) {
            $this->redirectWithMessage('/notes', 'info', 'Vous etes déjà connecté !');
        }

        // Préparer les données pour la vue
        // Récupérer les messages flash et données
        $data = [
            'errors' => $this->session->flash('errors') ?? [],
            'old' => $this->session->flash('old') ?? [],
            'success' => $this->session->flash('success'),
            'error' => $this->session->flash('error')
        ];

        require __DIR__ . '/../../views/auth/login.php';
    }

    // Traiter la connexion
    public function login()
    {
        
    }

    // Méthode pour afficher la page d'enregistrement
    public function showRegister()
    {
        require __DIR__ . '/../../views/auth/register.php';
    }
}