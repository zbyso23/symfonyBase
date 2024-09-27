<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\UserManager;

class UserController extends AbstractController
{
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function register(): Response
    {
        // Simulujeme registraci uživatele
        $email = 'user@example.com';
        $password = 'securepassword';

        $this->userManager->registerUser($email, $password);

        return new Response('<html><body>User registered successfully!</body></html>');
    }
}
