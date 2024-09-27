<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\MessageService;

class MessageController extends AbstractController
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(): Response
    {
        // Použití služby pomocí Dependency Injection
        $message = $this->messageService->getMessage();

        return new Response(
            '<html><body><header>' . $message . '</header></body></html>'
        );
    }
}
