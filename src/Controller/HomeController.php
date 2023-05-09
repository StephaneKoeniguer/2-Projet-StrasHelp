<?php

namespace App\Controller;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index($message = null, $type = null): string
    {
        if ($message) {
            return $this->twig->render('Home/index.html.twig', ['message' => $message , 'type' => $type]);
        }

        return $this->twig->render('Home/index.html.twig');
    }
}
