<?php

namespace App\Controller;

class DeposerOffreController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('depot/deposerOffre.html.twig');
    }
}
