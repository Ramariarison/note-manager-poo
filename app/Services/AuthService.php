<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Core\Session;

class AuthService
{
    private $userRepository;
    private $session;

    public function __construct(UserRepository $userRepository, Session $session)
    {
        $this->userRepository = $userRepository;
        $this->session = $session;
    }

    public function register(array $data): array
    {
        // Validation
        $errors = $this->validateRegistration($data);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // Logique pour vérifier l'unicité de l'email et de l'username
        if ($this->userRepository->findByEmail($data['email'])) {
            return ['success' => false, 'errors' => ['email' => 'Cet email est déjà utilisé']];
        }

        if ($this->userRepository->findByUsername($data['username'])) {
            return ['success' => false, 'errors' => ['username' => 'Ce nom d\'utilisateur est déjà utilisé']];
        }

        // La partie pour créer l'utilisateur
        try {
            $user = new User(
                trim($data['username']),
                trim($data['email']),
                $data['password']
            );

            // Sauvegarder en base de données
            if ($this->userRepository->create($user)) {
                // Connecter automatiquement
                $this->session->set('user', $user->toArray());
                $this->session->set('is_logged_in', true);

                return [
                    'success' => true,
                    'message' => 'Inscription réussie ! Bienvenue ' . $user->getUsername(),
                    'user' => $user->toArray()
                ];
            }

        } catch (\Throwable $th) {
            return ['success' => false, 'errors' => ['general' => 'erreur technique: ' . $th->getMessage()]];
        }

        return ['success' => false, 'errors' => ['general' => 'Erreur lors de l\'inscription']];
    }

    // Connexion - Authentifier un utilisateur
    public function login(string $email, string $password)
    {
        // Validation basique
        if (empty($username) || empty($password)) {
            return ['success' => false, 'errors' => ['general' => 'Email et mot de passe requis']];
        }

        // Trouver l'utilisateur
        $user = $this->userRepository->findByEmail(trim($email));

        if (!$user) {
            return ['success' => false, 'errors' => ['general' => 'Identifiants incorrects']];
        }

        // Vérifier password
        if (!$user->verifyPassword($password)) {
            return ['success' => false, 'errors' => ['general' => 'Identifiants incorrects']];
        }

        // Création de la session
        $this->session->set('user', $user->toArray());
        $this->session->set('is_logged_in', true);

        return [
            'success' => true,
            'message' => 'Connexion réussie ! Bienvenue ' . $user->getUsername(),
            'user' => $user->toArray()
        ];
    }

    // Déconnexion
    public function logout(): void
    {
        $this->session->destroy();
    }

    // Vérification si un utilisateur est connecté
    public function isLoggedIn(): bool
    {
        return $this->session->get('is_logged_in') === true;
    }

    // Méthode pour récupérer les données de l'utilisateur courant
    public function getCurrentUser(): ?array
    {
        if (!$this->isLoggedIn()) {
            return null;
        }
        
        return $this->session->get('user');
    }

    // Méthode pour récupérer l'id de l'utilisateur courant
    public function getCurrentUserId(): ?int
    {
        $user = $this->getCurrentUser();
        return $user['id'] ?? null;
    }

    // Validation des données venant du controller qui n'est pas encore créé pour le moment
    private function validateRegistration(array $data): array
    {
        $errors = [];

        // Pour l'username
        if (empty($data['username'])) {
            $errors['username'] = 'Le nom d\'utilisateur est requis';
        } elseif (strlen($data['username']) < 3) {
            $errors['username'] = '3 caractères minimum';
        } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $data['username'])) {
            $errors['username'] = 'Caractères autorisés: lettres, chiffres et underscore';
        }

        // Pour l'email
        if (empty($data['email'])) {
            $errors['email'] = 'L\'email est requis';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email invalide';
        }

        // Pour le password
        if (empty($data['password'])) {
            $errors['password'] = 'Le mot de passe est requis';
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = '6 caractères minimum';
        } elseif ($data['password'] !== $data['password_confirm']) {
            $errors['password'] = 'Les mots de passe de correspondent pas';
        }

        return $errors;
    }
}