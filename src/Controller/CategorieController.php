<?php

namespace App\Controller;

use App\Model\CategorieManager;
use App\Controller\DashboardController;

class CategorieController extends AbstractController
{
    /**
     * Select categorie
     */
    public function index(): array
    {
        $categorieManager = new CategorieManager();
        return $categorieManager->selectCategorie();
    }

    /**
     * Select offre per catégorie
     */
    public function countOffrePerCategorie(): array
    {
        $categorieManager = new CategorieManager();
        return $categorieManager->offrePerCategorie();
    }

    /**
     * Insert new catégorie
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorie = array_map('trim', $_POST);
            $categorie = array_filter($categorie);

            if (!empty($categorie)) {
                $categorieManager = new CategorieManager();
                $categorieManager->insert($categorie);
                header('location:/dashboard');
            }
            header('location:/dashboard');
        }
    }
}
