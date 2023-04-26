<?php

namespace App\Controller;

use App\Model\DeposerOffreManager;

class DeposerOffreController extends AbstractController
{
    public function index(): string
    {
        $deposerOffreManager = new DeposerOffreManager();
        $categorie = $deposerOffreManager->selectCategorie();
        return $this->twig->render('depot/deposerOffre.html.twig', ['categories' => $categorie]);
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deposerOffre = array_map('trim', $_POST);

            $deposerOffreManager = new DeposerOffreManager();
            $deposerOffreManager->insert($deposerOffre);

            return $this->twig->render('Home/index.html.twig');
        }

        return $this->twig->render('depot/deposerOffre.html.twig');
    }
}
