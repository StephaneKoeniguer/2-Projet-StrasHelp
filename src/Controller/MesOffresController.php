<?php

namespace App\Controller;

class MesOffresController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('MesOffres/Mesoffres.html.twig');
    }
}
