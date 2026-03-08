<?php

namespace App\Controllers;

use App\Core\Session;
use App\Services\AuthService;
use App\Services\NoteService;

class NoteController
{
    private $authService;
    private $noteService;
    private $session;

    public function __construct(Session $session, AuthService $authService, NoteService $noteService)
    {
        $this->session = $session;
        $this->authService = $authService;
        $this->noteService = $noteService;
    }

    public function index()
    {
        if (!$this->authService->isLoggedIn()) {
            $this->redirect('/loginPage');
        }

        // Récuperer l'utilisateur connecté
        $user = $this->authService->getCurrentUser();

        // Récuperer les notes et les messages
        $notes = $this->noteService->getUserNotes();

        $success = $this->session->flash('successupdate');

        $error = $this->session->flash('errorupdate');

        $old = $this->session->flash('old');

        // Passer l'utilisateur à la vue
        extract([
            'user' => $user,
            'notes' => $notes,
            'successupdate' => $success,
            'errorupdate' => $error,
            'old' => $old
        ]);

        require __DIR__ . '/../../views/notes/note-interface.php';
    }

    public function addNote()
    {
        // Préparation des données
        $data = [
            'title' => $_POST['title'] ?? '',
            'content' => $_POST['content'] ?? '',
            'importance_level' => $_POST['importance_level']
        ];

        $result = $this->noteService->addNote($data);
        
        if ($result['success']) {
            $this->session->flash('success', $result['message']);
            $this->redirect('/notes');
        } else {
            var_dump($result);
        }
    }

    public function editNote()
    {
        $noteId = $_POST['id'];

        $note = $this->noteService->getNote($noteId);

        $data = [
            'id' => $noteId,
            'title' => trim($_POST['title']),
            'content' => trim($_POST['content']),
            'importance_level' => trim($_POST['importance_level'])
        ];

        $changes = [];

        foreach ($data as $key => $value)
        {
            if (trim($note[$key]) !== $value) {
                $changes[$key] = $value;
            }
        }

        if (!empty($changes)) {

            $this->noteService->updateNote($noteId, $changes);

            $this->session->flash('successupdate', 'Note modifiée avec succés');

        } else {

            $this->session->flash('errorupdate', 'Aucun changement détecté');

            $this->session->flash('old', $data);

        }

        $this->redirect('/notes');
    }

    public function redirect($path)
    {
        $fullpath = '/crashProject/public' . $path;
        header('Location: ' . $fullpath);
        exit;
    }
}