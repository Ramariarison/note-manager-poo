<?php

namespace App\Models;

class Note
{
    private $id;
    private $userId;
    private $title;
    private $content;
    private $importanceLevel;
    private $isImportant = false;
    private $createdAt;
    private $updatedAt;
    
    public function __construct(
        int $userId,
        string $title,
        string $content,
        string $importanceLevel,
        bool $isImportant = false
    ) {
        $this->userId = $userId;
        $this->setTitle($title);
        $this->setContent($content);
        $this->setImportanceLevel($importanceLevel);
        $this->setIsImportant($isImportant);
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    // GETTERS
    public function getId()
    { 
        return $this->id; 
    }
    
    public function getUserId()
    { 
        return $this->userId; 
    }
    
    public function getTitle()
    { 
        return $this->title; 
    }
    
    public function getContent()
    { 
        return $this->content; 
    }
    
    public function getImportanceLevel()
    { 
        return $this->importanceLevel; 
    }
    
    public function getIsImportant()
    { 
        return $this->isImportant; 
    }
    
    public function getCreatedAt()
    { 
        return $this->createdAt; 
    }
    
    public function getUpdatedAt()
    { 
        return $this->updatedAt; 
    }
    
    // SETTERS
    public function setId(int $id): void 
    { 
        $this->id = $id; 
    }
    
    public function setUserId(int $userId): void 
    { 
        $this->userId = $userId; 
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function setTitle(string $title): void 
    {
        $this->title = $title;
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function setContent(string $content): void 
    {
        $this->content = $content;
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function setImportanceLevel(string $importanceLevel): void 
    {
        $this->importanceLevel = $importanceLevel;
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function setIsImportant(bool $isImportant): void 
    {
        $this->isImportant = $isImportant;
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    public function toggleImportance(): void
    {
        // Inverser l'état d'importance
        $this->isImportant = !$this->isImportant;
        $this->updatedAt = date('Y-m-d H:i:s');
    }
    
    // Conversion en Array
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'title' => $this->title,
            'content' => $this->content,
            'importanceLevel' => $this->importanceLevel,
            'is_important' => $this->isImportant,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
            'category_color' => $this->getCategoryColor()  // Couleur pour l'interface
        ];
    }
    
    // Retourne une couleur associée à la catégorie (pour l'interface)
    public function getCategoryColor(): string
    {
        $colors = [
            'low' => '#b8e986', // Vert
            'normal' => '#4a90e2', // Bleu
            'high' => '#f5a623', // Orange
            'critical' => '#d0021b' // Rouge
        ];
        
        return $colors[$this->importanceLevel] ?? '#4a90e2'; // Bleu par défaut
    }
}