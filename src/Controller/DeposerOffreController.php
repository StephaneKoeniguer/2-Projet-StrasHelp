<?php

namespace App\Controller;

use App\Model\DeposerOffreManager;
use App\Model\CategorieManager;

class DeposerOffreController extends AbstractController
{
    public function index(): string
    {
        $categorieManager = new CategorieManager();
        $categories = $categorieManager->selectAll();
        return $this->twig->render('depot/deposerOffre.html.twig', ['categories' => $categories]);
    }

    public function controle($value): ?string
    {
        $message = '';
        $value = trim($value);
        if (empty($value)) {
            return $message . "erreur";
        }
        return $value;
    }

    public function add(): ?string
    {
        $message = '';

        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
            $message = "Veuillez vous connecter afin de déposer une offre.";
            header('Location: /?type=danger&message=' . $message);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $deposerOffre = array_map('trim', $_POST);


            foreach ($deposerOffre as $key => $value) {
                $deposerOffre[$key] = $this->controle($value);
                if (strpos($deposerOffre[$key], 'erreur') !== false) {
                    $message = "Veuillez remplir tous les champs requis.";
                    header('Location:/?type=danger&message=' . $message);
                    return $this->twig->render('depot/deposerOffre.html.twig');
                }
            }

            $deposerOffreManager = new DeposerOffreManager();
            $deposerOffreManager->insert($deposerOffre);
            $message = "Votre offre est déposée";
            header('Location:/?type=success&message=' . $message);
            return $this->twig->render('Home/index.html.twig');
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


            foreach ($deposerOffre as $key => $value) {
                $deposerOffre[$key] = $this->controle($value);
                if (strpos($deposerOffre[$key], 'erreur') !== false) {
                    $message = "Veuillez remplir tous les champs requis.";
                    header('Location:/?type=danger&message=' . $message);
                    return $this->twig->render('depot/deposerOffreUpdate.html.twig');
                }
            }

            $message = "Votre offre est mise à jour.";

            $deposerOffreManager = new DeposerOffreManager();
            $deposerOffre = array_map('trim', $_POST);
            $deposerOffreManager->update($id, $deposerOffre);
            header('Location:/?type=success&message=' . $message);
            return $this->twig->render('Home/index.html.twig');
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
        $message = ' ';
        $id = intval(trim($_GET['id']));
        $deposerOffreManager = new DeposerOffreManager();
        $deposerOffreManager->delete($id);
        $message = "Votre offre est supprimée.";
        header('Location:/?type=success&message=' . $message);
    }
}
