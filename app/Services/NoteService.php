<?php

namespace App\Services;

use App\Core\Session;
use App\Models\Note;
use App\Repositories\NoteRepository;

class NoteService
{
    private $noteRepository;
    private $session;

    public function __construct(NoteRepository $noteRepository, Session $session)
    {
        $this->noteRepository = $noteRepository;
        $this->session = $session;
    }

    public function getUserNotes()
    {
        $userId = $this->getCurrentUserId();

        return $this->noteRepository->getNotesByUserId($userId);
    }

    public function getNote($noteId)
    {
        return $this->noteRepository->findNoteById($noteId);
    }

    public function addNote($data)
    {
        $errors = $this->validateNote($data);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        try {
            $note = new Note(
                $this->getCurrentUserId(),
                trim($data['title']),
                trim($data['content']),
                $data['importance_level']
            );

            $this->noteRepository->createNote($note);

            return [
                'success' => true,
                'message' => 'Note ajoutée avec succés'
            ];

        } catch (\Throwable $th) {
            return ['success' => false, 'errors' => ['general' => 'erreur technique: ' . $th->getMessage()]];
        }

        return ['success' => false, 'errors' => ['general' => 'Erreur lors de l\'inscription']];
    }

    public function updateNote($noteId, $changes)
    {
        return $this->noteRepository->update($noteId, $changes);
    }

    public function deleteNote($id)
    {
        return $this->noteRepository->deleteNoteById($id);
    }

    public function pinNote($id)
    {
        $user_id = $this->getCurrentUserId();

        return $this->noteRepository->pinNoteById($id, $user_id);
    }

    public function unpinNote($id)
    {
        $user_id = $this->getCurrentUserId();

        return $this->noteRepository->unpinNoteById($id, $user_id);
    }

    public function getCurrentUser()
    {
        return $this->session->get('user');
    }

    public function getCurrentUserId()
    {
        $user = $this->getCurrentUser();
        return $user['id'] ?? null;
    }

    public function validateNote(array $data)
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'Le titre du note est requis';
        }

        if (empty($data['content'])) {
            $errors['content'] = 'Le contenu du note est requis';
        }

        return $errors;
    }
}