<?php

namespace App\Service;

class UserValidator
{
    public function validateEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Invalid email");
        }
    }
}
