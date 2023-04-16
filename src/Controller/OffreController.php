<?php

namespace App\Controller;

class OffreController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Offre/offre.html.twig');
    }
}
