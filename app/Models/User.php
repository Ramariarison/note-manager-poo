<?php

namespace App\Models;

class User
{
    private ?int $id = null;
    private string $username;
    private string $email;
    private string $password;
    private string $createdAt;
    private string $updatedAt;
    
    public function __construct(
        string $username,
        string $email,
        string $plainPassword
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($plainPassword);
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    // Getters
    public function getId(): ?int { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getCreatedAt(): string { return $this->createdAt; }
    public function getUpdatedAt(): string { return $this->updatedAt; }
    
    // Setters
    public function setId(?int $id): void { $this->id = $id; }
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
    public function verifyPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }
    
    // Convertir en tableau (pour JSON ou sessions)
    public function toArray(): array
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