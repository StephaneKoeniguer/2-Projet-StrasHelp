<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    // Display home page
    public function index($message = null): string
    {
        if ($message) {
            return $this->twig->render('Home/index.html.twig', ['message' => $message ]);
        }

        return $this->twig->render('Home/index.html.twig');
    }
}
