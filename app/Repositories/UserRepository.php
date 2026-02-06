<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\User;
use PDO;

class UserRepository
{
    private PDO $connexion;

    public function __construct()
    {
        $this->connexion = Database::getInstance()->getConnexion();
    }

    // Créer un utilisateur
    public function createUser(User $user): bool
    {
        $sql = "INSERT INTO users (username, email, password) VALUES 
        (:username, :email, :password)";

        $stmt = $this->connexion->prepare($sql);

        return $stmt->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword() // Déjà hashé par le modèle User
        ]);
    }

    // Trouver un utilisateur par id
    public function find(int $id): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch();
        return $data ? $this->hydrate($data) : null;
    }

    // Trouver un utilisateur par email ( utile pour le login )
    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['email' => $email]);

        $data = $stmt->fetch();
        return $data ? $this->hydrate($data) : null;
    }

    // Trouver un utilisateur par username ( pour vérifier l'unicité )
    public function findByUsername(string $username): ?User
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['username' => $username]);

        $data = $stmt->fetch();
        return $data ? $this->hydrate($data) : null;
    }

    // Méthode privée pour convertir un tableau BD en Objet User
    private function hydrate(array $data): User
    {
        $user = new User(
            $data['username'],
            $data['email'],
            '' // On settera le mot de passe hashé après
        );

        $user->setId($data['id']);
        $user->setHashedPassword($data['password']); // set le hash directement
        // les dates pour createdAt et updateAt sont gérées par mysql
        
        return $user;
    }
}