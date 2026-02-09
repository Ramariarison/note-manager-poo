<?php

namespace App\Core;

class Session {
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(string $key, mixed $value): void 
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function flash(string $key, $value = null)
    {
        // si on donne une valeur, on stocke
        if ($value !== null) {
            $_SESSION['key'] = $value;
            return;
        }

        // sinon on lit et on supprime
        $value = $_SESSION['key'] ?? null;
        unset($_SESSION[$key]);

        return $value;
    }

    public function destroy(): void
    {
        session_destroy();
    }
}