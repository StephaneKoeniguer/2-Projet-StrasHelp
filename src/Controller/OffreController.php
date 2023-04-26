<?php

namespace App\Controller;

use App\Model\OffreManager;

class OffreController extends AbstractController
{
    public function index(): string
    {
        $offreManager = new offreManager();
        $categorie = $offreManager->selectCategorie();
        $area = $offreManager->selectArea();
        $availability = $offreManager->selectAvailability();
        $offres = $offreManager->selectOffre();

        return $this->twig->render('Offre/offre.html.twig', ['categories' => $categorie, 'offres' => $offres,
        'areas' => $area, 'availabilities' => $availability]);
    }

    private function validate(array $data): bool
    {
        if (
            $data['categorie'] == 'Veuillez Choisir' && $data['area'] == 'Veuillez Choisir' &&
            $data['disponibilites'] == 'Veuillez Choisir'
        ) {
            return false;
        } else {
            return true;
        }
    }

    public function search(): string
    {
        $data = array_map('trim', $_POST);
        $offreManager = new offreManager();

        if (!$this->validate($data)) {
            return $this->index();
        } else {
            $offre = $offreManager->searchOffre($data);
            $categorie = $offreManager->selectCategorie();
            $area = $offreManager->selectArea();
            $availability = $offreManager->selectAvailability();
            return $this->twig->render('Offre/offre.html.twig', ['categories' => $categorie, 'offres' => $offre,
            'areas' => $area, 'availabilities' => $availability]);
        }
    }
}
