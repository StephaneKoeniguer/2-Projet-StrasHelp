<?php

namespace App\Controller;

use App\Model\DeposerOffreManager;
use App\Model\CategorieManager;

/**
 * @SuppressWarnings(PHPMD)
 */
class DeposerOffreController extends AbstractController
{
    public function index(): string
    {
        $categorieManager = new CategorieManager();
        $categories = $categorieManager->selectAll();
        return $this->twig->render('depot/deposerOffre.html.twig', ['categories' => $categories]);
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deposerOffre = array_map('trim', $_POST);

            $deposerOffreManager = new DeposerOffreManager();
            $deposerOffreManager->insert($deposerOffre);

            header('Location:/');
        }

        return $this->twig->render('MesOffres/Mesoffres.html.twig');
    }

    public function show(): string
    {
        $deposerOffreManager = new DeposerOffreManager();
        $showOffres = $deposerOffreManager->fetchAll();


        return $this->twig->render('MesOffres/Mesoffres.html.twig', ['offres' => $showOffres]);
    }


    public function edit(int $id): void
    {
        $deposerOffreManager = new DeposerOffreManager();
        $offre = $deposerOffreManager->selectOneById($id);
        if (!empty($_POST)) {
            $deposerOffre = array_map('trim', $_POST);
            $deposerOffreManager->update($id, $deposerOffre);
        }

        header('location:/mesoffres');
    }

    public function redit($id): ?string
    {
        $deposerOffreManager = new DeposerOffreManager();
        $offre = $deposerOffreManager->selectOneById($id);
        return $this->twig->render('depot/deposerOffreUpdate.html.twig', ['offre' => $offre]);
    }



    public function delete(): void
    {
        $id = array_map('trim', ($_GET['id']));
        $id = intval($id);
        $deposerOffreManager = new DeposerOffreManager();
        $deposerOffreManager->delete($id);
        header('Location:/mesoffres');
    }
}
