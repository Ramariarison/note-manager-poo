<?php

namespace App\Models;

class User
{
    private $id = null;
    private $username;
    private $email;
    private $password;
    private $createdAt;
    private $updatedAt;
    
    public function __construct($username, $email, $plainPassword) {
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($plainPassword);
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    // Getters
    public function getId() { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getCreatedAt(): string { return $this->createdAt; }
    public function getUpdatedAt(): string { return $this->updatedAt; }
    
    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setUsername(string $username): void { 
        $this->username = $username; 
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    public function setEmail(string $email): void { 
        $this->email = $email; 
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    // Gestion du mot de passe
    public function setPassword(string $plainPassword): void {
        $this->password = password_hash($plainPassword, PASSWORD_DEFAULT);
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function setHashedPassword(string $hashedPassword): void {
        $this->password = $hashedPassword;
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    // Vérification de mot de passe
    public function verifyPassword(string $plainPassword)
    {
        return password_verify($plainPassword, $this->password);
    }
    
    // Convertir en tableau (pour JSON ou sessions)
    public function toArray()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt
        ];
    }
}