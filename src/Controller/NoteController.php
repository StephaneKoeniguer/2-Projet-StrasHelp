<?php

namespace App\Controller;

use App\Model\NoteManager;
use App\Model\OffreManager;

/**
 * @SuppressWarnings(PHPMD)
 */
class NoteController extends AbstractController
{
    /**
     * Validate if user is authorized
     */
    public function validate(int $userId, int $offreId): bool
    {
        $noteManager = new NoteManager();

        $userAutorise = $noteManager->selectById($userId, $offreId);
        if ($userAutorise == false) {
            return false;
        } elseif (in_array($userId, $userAutorise)) {
            return true;
        }
    }

     /**
     * Call insert new note
     */
    public function add(): string
    {
        $_SESSION['user_id'] = 4;    //A affecter dans la fonction login
        $noteManager = new NoteManager();
        $offreManager = new OffreManager();
        $date = new \DateTime();

        $note = array_map('trim', $_GET);
        $note['date'] = $date->format('Y/m/d');
        $note['user_id'] = $_SESSION['user_id'];
        $message = '';
        $alert = '';

        if (isset($note) && !empty($note) && $this->validate($note['user_id'], $note['offre_id']) == false) {
            $noteManager->insert($note);
            $alert = 'primary';
            $message = 'Votre note à bien été prise en compte';
            $offre = $offreManager->selectOffre();
            return $this->twig->render(
                'Offre/offre.html.twig',
                ['offres' => $offre, 'message' => $message, 'alert' => $alert]
            );
        } else {
            $alert = 'danger';
            $message = 'Vous avez déja attribué une note à cette offre';
            $offre = $offreManager->selectOffre();
            return $this->twig->render(
                'Offre/offre.html.twig',
                ['offres' => $offre, 'message' => $message, 'alert' => $alert]
            );
        }
    }
}
