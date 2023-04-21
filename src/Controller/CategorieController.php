<?php

namespace App\Controller;

use App\Model\CategorieManager;

class CategorieController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('categorie/categorie.html.twig');
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorie = array_map('trim', $_POST);

            $categorieManager = new CategorieManager();
            $categorieManager->insert($categorie);

            return $this->twig->render('categorie/categorie.html.twig');
        }

        return $this->twig->render('categorie/categorie.html.twig');
    }
}
