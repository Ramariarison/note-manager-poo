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

        // Passer l'utilisateur à la vue
        extract([
            'user' => $user
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

    public function redirect($path)
    {
        $fullpath = '/crashProject/public' . $path;
        header('Location: ' . $fullpath);
        exit;
    }
}