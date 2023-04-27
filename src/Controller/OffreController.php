<?php

namespace App\Controller;

use App\Model\OffreManager;
use App\Model\NoteManager;

class OffreController extends AbstractController
{
    /*private ?NoteManager $noteManager;
      private ?OffreManager $offreManager;
      private array $categorie;
      private array $area;
      private array $availability;
      private array $notesAverage;

    public function __construct()
    {
        $this->noteManager = new NoteManager();
        $this->offreManager = new OffreManager();
        $this->categorie = $offreManager->selectCategorie();
        $this->area = $offreManager->selectArea();
        $this->availability = $offreManager->selectAvailability();
        $this->notesAverage = $noteManager->noteAverage();
    }*/

    public function index(): string
    {
        $offreManager = new OffreManager();
        $categorie = $offreManager->selectCategorie();
        $area = $offreManager->selectArea();
        $availability = $offreManager->selectAvailability();
        $offres = $offreManager->selectOffre();
        $noteManager = new NoteManager();
        $notesAverage = $noteManager->noteAverage();

        return $this->twig->render('Offre/offre.html.twig', ['categories' => $categorie, 'offres' => $offres,
        'areas' => $area, 'availabilities' => $availability ,'notesAverage' => $notesAverage]);
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
            $noteManager = new NoteManager();
            $notesAverage = $noteManager->noteAverage();

            return $this->twig->render('Offre/offre.html.twig', ['categories' => $categorie, 'offres' => $offre,
            'areas' => $area, 'availabilities' => $availability, 'notesAverage' => $notesAverage]);
        }
    }
}
