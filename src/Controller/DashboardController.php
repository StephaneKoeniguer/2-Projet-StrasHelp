<?php

namespace App\Controller;

use App\Controller\CategorieController;
use App\Model\UserManager;
use App\Model\OffreManager;
use App\Model\NoteManager;

class DashboardController extends AbstractController
{
    private array $offrePerCategorie;
    private array $typeCompte;
    private array $offres;
    private array $notes;
    private array $particulier;
    private array $association;

    /**
     * Initialize for display
     */
    private function initialize(): void
    {
        $categorieController = new CategorieController();
        $this->offrePerCategorie = $categorieController->countOffrePerCategorie();
        $userManager = new Usermanager();
        $this->typeCompte = $userManager->selectTypeCompte();
        $this->particulier = $userManager->selectParticulier();
        $this->association = $userManager->selectAssociation();
        $offreManager = new OffreManager();
        $this->offres = $offreManager->selectAllOffres();
        $noteManager = new NoteManager();
        $this->notes = $noteManager->noteAverage();
    }

    /**
     * Index page
     */
    public function index(): string
    {
        $this->initialize();

        return $this->twig->render(
            'Home/superAdmin.html.twig',
            ['nbOffres' => $this->offrePerCategorie, 'typeComptes' => $this->typeCompte,
            'offres' => $this->offres, 'notes' => $this->notes, 'particuliers' => $this->particulier,
            'associations' => $this->association]
        );
    }

    /**
     * Delete offre
     */
    public function delete($id)
    {
        $offreManager = new OffreManager();
        $offreManager->deleteOffre($id);

        header('location:/dashboard');
    }

    /**
     * Search offre
     */
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $filter = array_map('trim', $_POST);
            $filter = implode(' ', $filter);

            if (!empty($filter)) {
                $this->initialize();
                $offreManager = new OffreManager();
                $offreSearch = $offreManager->searchDashboard($filter);
                return $this->twig->render(
                    'Home/superAdmin.html.twig',
                    ['offres' => $offreSearch, 'typeComptes' => $this->typeCompte,
                    'nbOffres' => $this->offrePerCategorie, 'particuliers' => $this->particulier,
                    'associations' => $this->association]
                );
            } else {
                header('location: /dashboard');
            }

            header('location: /dashboard');
        }
    }
}
