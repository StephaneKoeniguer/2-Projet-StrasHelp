<?php

namespace App\Controller;

use App\Model\NoteManager;
use App\Model\OffreManager;

/**
 * @SuppressWarnings(PHPMD)
 */
class NoteController extends AbstractController
{
    private NoteManager $noteManager;

    /**
     * Validate if user is authorized
     */
    private function validate(int $userId, int $offreId): bool
    {
        //already a note
        $userNote = $this->noteManager->selectByIdNote($userId, $offreId);
        //offre belongs user
        $userOffre = $this->noteManager->selectByIdOffre($userId, $offreId);

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
     * Display alert message
     */
    private function displayMessage(string $alert, string $message): string
    {
        $offreManager = new OffreManager();
        $offre = $offreManager->selectOffre();

        return $this->twig->render(
            'Offre/offre.html.twig',
            ['offres' => $offre, 'message' => $message, 'alert' => $alert]
        );
    }

     /**
     * Call to insert new note
     */
    public function add(): string
    {
        $this->noteManager = new NoteManager();
        $date = new \DateTime();

        $note = array_map('trim', $_GET);
        $note['date'] = $date->format('Y/m/d');
        $message = '';
        $alert = '';

        if (isset($_SESSION['user_id'])) {
            $note['user_id'] = $_SESSION['user_id'];
        } else {
            $_SESSION['user_id'] = '';
        }

        if (!empty($_SESSION['user_id'])) {
            if (isset($note) && !empty($note) && $this->validate($note['user_id'], $note['offre_id']) == false) {
                $this->noteManager->insert($note);
                $alert = 'primary';
                $message = 'Votre note à bien été prise en compte';
                return $this->displayMessage($alert, $message);
            } else {
                $alert = 'danger';
                $message = 'Vous avez déja attribué une note à cette offre';
                return $this->displayMessage($alert, $message);
            }
        } else {
            $alert = 'warning';
            $message = 'Merci de vous connecter ou de créer un compte';
            return $this->displayMessage($alert, $message);
        }
    }
}
