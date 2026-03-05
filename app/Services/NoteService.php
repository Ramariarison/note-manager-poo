<?php

namespace App\Services;

use App\Core\Session;
use App\Models\Note;
use App\Repository\NoteRepository;

class NoteService
{
    private $noteRepository;
    private $session;

    public function __construct(NoteRepository $noteRepository, Session $session)
    {
        $this->noteRepository = $noteRepository;
        $this->session = $session;
    }

    public function addNote($data)
    {
        $errors = $this->validateNote($data);

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        try {
            $note = new Note([
                $this->getCurrentUserId(),
                trim($data['title']),
                trim($data['content']),
                $data['importance_level']
            ]);

            $this->noteRepository->createNote($note);
        } catch (\throwable $th) {
            return ['success' => false, 'errors' => ['general' => 'erreur technique: ' . $th->getMessage()]];
        }

        return ['success' => false, 'errors' => ['general' => 'Erreur lors de l\'inscription']];
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