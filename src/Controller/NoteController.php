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
        //already a note
        $userNote = $noteManager->selectByIdNote($userId, $offreId);
        //offre belongs user
        $userOffre =  $noteManager->selectByIdOffre($userId, $offreId);

        if ($userOffre == false) {
            if ($userNote == false) {
                return false;
            } elseif (in_array($userId, $userNote)) {
                return true;
            }
        } else {
            return true;
        }
    }

     /**
     * Call insert new note
     */
    public function add(): string
    {

        $noteManager = new NoteManager();
        $offreManager = new OffreManager();
        $date = new \DateTime();

        $note = array_map('trim', $_GET);
        $note['date'] = $date->format('Y/m/d');
        $note['user_id'] = $_SESSION['user_id'];
        $message = '';
        $alert = '';

        if (!empty($_SESSION['user_id'])) {
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
        } else {
            $alert = 'warning';
            $message = 'Merci de vous connecter ou de créer un compte';
            $offre = $offreManager->selectOffre();
            return $this->twig->render(
                'Offre/offre.html.twig',
                ['offres' => $offre, 'message' => $message, 'alert' => $alert]
            );
        }
    }
}
