<?php

namespace App\Service;

use App\Service\UserValidator;
use App\Repository\UserRepository;
use App\Service\EmailService;

class UserManager
{
    private $userValidator;
    private $userRepository;
    private $emailService;

    public function __construct(
        UserValidator $userValidator,
        UserRepository $userRepository,
        EmailService $emailService
    ) {
        $this->userValidator = $userValidator;
        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
    }

    public function registerUser(string $email, string $password)
    {
        // 1. Validace uživatele
        $this->userValidator->validateEmail($email);

        // 2. Uložení uživatele do databáze
        $this->userRepository->saveUser($email, $password);

        // 3. Odeslání e-mailu o registraci
        $this->emailService->sendRegistrationEmail($email);
    }
}
