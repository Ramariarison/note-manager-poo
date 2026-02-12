<?php

namespace App\Controllers;

use App\Services\AuthService;

class NoteController
{
    private $authService;

    public function __construct($authService)
    {
        $this->authService = $authService;
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

    public function redirect($path)
    {
        $fullpath = '/crashProject/public' . $path;
        header('Location: ' . $fullpath);
        exit;
    }
}