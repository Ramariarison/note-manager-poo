<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        require __DIR__ . '/../../views/pages/accueil.php';
    }
}