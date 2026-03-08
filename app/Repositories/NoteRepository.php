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

    public function getNotesByUserId($userId)
    {
        $sql = "SELECT * FROM notes WHERE user_id = :user_id ORDER BY FIELD(importance_level, 'Critical', 'High', 'Medium', 'Low')";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'user_id' => $userId
        ]);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    public function findNoteById($id)
    {
        $sql = "SELECT * FROM notes WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch();
    }

    public function update($noteId, $changes)
    {
        $fields = [];
        $params = [];

        foreach ($changes as $key => $value)
        {
            $fields[] = "$key = :$key";
            $params[$key] = $value;
        }

        $params['noteId'] = $noteId;

        $sql = "UPDATE notes SET " . implode(', ', $fields) . " WHERE id = :noteId";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute($params);
    }

    public function deleteNoteById($id)
    {
        $sql = "DELETE FROM notes WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

         return $stmt->execute([
            'id' => $id
        ]);
    }
}