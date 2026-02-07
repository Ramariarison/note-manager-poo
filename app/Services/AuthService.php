<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Core\Session;

class AuthService
{
    private UserRepository $useRepository;
    private Session $session;

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