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
        $message = '';

        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
            $message = "Veuillez vous connecter afin de déposer une offre.";
            header('Location: /?message=' . $message);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deposerOffre = array_map('trim', $_POST);

            $message = "Votre offre est déposée";

            if (
                empty(trim($deposerOffre['title'])) ||
                empty(trim($deposerOffre['area'])) ||
                empty(trim($deposerOffre['availability'])) ||
                empty(trim($deposerOffre['phone'])) ||
                empty(trim($deposerOffre['description'])) ||
                empty(trim($deposerOffre['categorie_id'])) ||
                !isset($deposerOffre['title']) ||
                !isset($deposerOffre['area']) ||
                !isset($deposerOffre['availability']) ||
                !isset($deposerOffre['phone']) ||
                !isset($deposerOffre['description']) ||
                !isset($deposerOffre['categorie_id'])
            ) {
                $message = "Veuillez remplir tous les champs requis.";
                header('Location:/?message=' . $message);
                return $this->twig->render('depot/deposerOffre.html.twig');
            } else {
                $deposerOffreManager = new DeposerOffreManager();
                $deposerOffreManager->insert($deposerOffre);
                header('Location:/?message=' . $message);
                return $this->twig->render('Home/index.html.twig');
            }
        }

        return $this->twig->render('MesOffres/Mesoffres.html.twig');
    }



    public function show(): string
    {
        $deposerOffreManager = new DeposerOffreManager();
        $showOffres = $deposerOffreManager->fetchAll();


        return $this->twig->render('MesOffres/Mesoffres.html.twig', ['offres' => $showOffres]);
    }

    public function edit(int $id): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deposerOffre = array_map('trim', $_POST);

            $message = "Votre offre est  mise a jour";

            if (
                    empty(trim($deposerOffre['title'])) ||
                    empty(trim($deposerOffre['area'])) ||
                    empty(trim($deposerOffre['availability'])) ||
                    empty(trim($deposerOffre['phone'])) ||
                    empty(trim($deposerOffre['description'])) ||
                    empty(trim($deposerOffre['categorie_id'])) ||
                    !isset($deposerOffre['title']) ||
                    !isset($deposerOffre['area']) ||
                    !isset($deposerOffre['availability']) ||
                    !isset($deposerOffre['phone']) ||
                    !isset($deposerOffre['description']) ||
                    !isset($deposerOffre['categorie_id'])
            ) {
                $message = "Veuillez remplir tous les champs requis.";
                header('Location: /?message=' . $message);
                return $this->twig->render('depot/deposerOffreUpdate.html.twig');
            } else {
                $deposerOffreManager = new DeposerOffreManager();
                $offre = $deposerOffreManager->selectOneById($id);
                $deposerOffre = array_map('trim', $_POST);
                $deposerOffreManager->update($id, $deposerOffre);
                header('Location:/?message=' . $message);
                return $this->twig->render('Home/index.html.twig');
            }
        }

        return $this->twig->render('MesOffres/Mesoffres.html.twig');
    }

    public function redit($id): ?string
    {
        $deposerOffreManager = new DeposerOffreManager();
        $offre = $deposerOffreManager->selectOneById($id);
        $categorieManager = new CategorieManager();
        $categories = $categorieManager->selectAll();
        return $this->twig->render('depot/deposerOffreUpdate.html.twig', [
            'offre' => $offre,
            'categories' => $categories
        ]);
    }

    public function delete(): void
    {
        $id = intval(trim($_GET['id']));
        $deposerOffreManager = new DeposerOffreManager();
        $deposerOffreManager->delete($id);
        header('Location:/mesoffres');
    }
}
