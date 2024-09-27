<?php

namespace App\Repository;

class UserRepository
{
    public function saveUser(string $email, string $password)
    {
        // Zde simulujeme uložení uživatele do databáze
        echo "User saved to the database.\n";
    }
}
