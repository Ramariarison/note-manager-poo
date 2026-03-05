<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Note;

class NoteRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function createNote($note)
    {
        $sql = "INSERT INTO notes (user_id, title, content, importance_level) VALUES (:user_id, :title, :content, 
        :importance_level)";

        $stmt = $this->connection->prepare($sql);

        $success = $stmt->execute([
            'user_id' => $note->getUserId(),
            'title' => $note->getTitle(),
            'content' => $note->getContent(),
            'importance_level' => $note->getImportanceLevel()
        ]);

        return $success;
    }
}