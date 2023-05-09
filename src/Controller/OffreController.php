<?php

namespace App\Controller;

use App\Model\OffreManager;
use App\Model\NoteManager;
use App\Model\CategorieManager;

class OffreController extends AbstractController
{
    private OffreManager $offreManager;

    /**
     * Display offre page
     */
    public function index(): string
    {
        $this->initialize();
        $offres = $this->offreManager->selectOffre();

        return $this->twig->render('Offre/offre.html.twig', ['offres' => $offres]);
    }


    /**
     * Initiliaze twig global variable for display
     */
    private function initialize(): void
    {
        $noteManager = new NoteManager();
        $this->offreManager = new OffreManager();
        $categorieManager = new CategorieManager();
        $categorie = $categorieManager->selectCategorie();
        $area = $this->offreManager->selectArea();
        $availability = $this->offreManager->selectAvailability();
        $notesAverage = $noteManager->noteAverage();
        $_SESSION['categories'] = $categorie;
        $_SESSION['areas'] = $area;
        $_SESSION['availabilities'] = $availability;
        $_SESSION['notesAverage'] = $notesAverage;
    }

    /**
     * Validate Search offer
     */
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

    /**
     * Search offer filter
     */
    public function search(): string
    {
        $offreManager = new offreManager();
        $data = array_map('trim', $_POST);

        if (!$this->validate($data)) {
            return $this->index();
        } else {
            foreach ($data as $key => $value) {
                if ('Veuillez Choisir' == $value) {
                    unset($data[$key]);
                }
            }

            $offre = $offreManager->searchOffre($data);
            $this->initialize();
            return $this->twig->render('Offre/offre.html.twig', ['offres' => $offre]);
        }
    }
}
