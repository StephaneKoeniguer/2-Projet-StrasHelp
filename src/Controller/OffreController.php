<?php

namespace App\Controller;

use App\Model\OffreManager;
use App\Model\NoteManager;

class OffreController extends AbstractController
{
    public function index(): string
    {
        $this->initialize();
        $offreManager = new OffreManager();
        $offres = $offreManager->selectOffre();
        return $this->twig->render('Offre/offre.html.twig', ['offres' => $offres]);
    }


    /**
     * Initiliaze twig global variable fot display
     */
    private function initialize(): void
    {
        $noteManager = new NoteManager();
        $offreManager = new OffreManager();
        $categorie = $offreManager->selectCategorie();
        $area = $offreManager->selectArea();
        $availability = $offreManager->selectAvailability();
        $notesAverage = $noteManager->noteAverage();
        $_SESSION['categories'] = $categorie;
        $_SESSION['areas'] = $area;
        $_SESSION['availabilities'] = $availability;
        $_SESSION['notesAverage'] = $notesAverage;
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

    /**
     * Search offer filter
     */
    public function search(): string
    {
        $data = array_map('trim', $_POST);
        $offreManager = new offreManager();

        if (!$this->validate($data)) {
            return $this->index();
        } else {
            $offre = $offreManager->searchOffre($data);
            return $this->twig->render('Offre/offre.html.twig', ['offres' => $offre]);
        }
    }
}
