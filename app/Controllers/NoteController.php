<?php

namespace App\Controllers;

class NoteController
{
    public function index()
    {
        require __DIR__ . '/../../views/notes/note-interface.php';
    }
}