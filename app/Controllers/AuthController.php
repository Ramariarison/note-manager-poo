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
        // Vérifier bien que c'est une méthode post
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        // Récupérer les données
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Appeler le service d'authentification
        $result = $this->authService->login($email, $password);

        if ($result['success']) {
            // Succés alors on redirige l'utilisateur vers la page de notes
            $this->session->flash('success', $result['message']);
            $this->redirect('/notes');
        }

        // échec : sauvegarder les erreurs et réafficher le formulaire
        $this->session->flash('errors', $result['errors']);
        $this->session->flash('old', ['email' => $email]);
        $this->redirect('/loginPage');
    }

    // Méthode pour afficher la page d'enregistrement
    public function showRegister()
    {
        // Si déjà connecté, rediriger vers la page de notes
        if ($this->authService->isLoggedIn()) {
            $this->redirectWithMessage('/notes', 'info', 'Vous etes déjà inscrit et connecté !');
        }

        // Préparer les données pour la vue
        // Récupérer les messages flash et données
        $data = [
            'errors' => $this->session->flash('errors') ?? [],
            'old' => $this->session->flash('old') ?? [],
            'success' => $this->session->flash('success'),
            'error' => $this->session->flash('error')
        ];

        require __DIR__ . '/../../views/auth/register.php';
    }

    // Traitement de l'inscription d'un utilisateur
    public function register()
    {
        // Vérifier que c'est bien une requete POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/showRegister');
        }

        // Préparer les données
        $data = [
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'password_confirm' => $_POST['password_confirm'] ?? ''
        ];

        // Appel du service d'inscription
        $result = $this->authService->register($data);

        if ($result['success']) {
            // Redirection vers la page de notes
            $this->session->flash('success', $result['message']);
            $this->redirect('/notes');
        }

        // Échec, sauvegarder les erreurs et données pour réafficher
        $this->session->flash('errors', $result['errors']);
        $this->session->flash('old', $data);
        $this->redirect('/showRegister');
    }
}