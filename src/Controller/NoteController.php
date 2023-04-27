<?php

namespace App\Controller;

use App\Model\NoteManager;

/**
 * @SuppressWarnings(PHPMD)
 */
class NoteController extends AbstractController
{
    private ?NoteManager $noteManager;
    private ?\DateTime $date;

    public function __CONSTRUCT()
    {
        $this->noteManager = new NoteManager();
        $this->date = new \DateTime();
    }

    public function validate(int $userId, int $offreId): bool
    {
        $userAutorise = $this->noteManager->selectById($userId, $offreId);

            if ($userAutorise == true || in_array($userId, $userAutorise)) {
                return true;
            } else {
                return false;
            }
    }


    public function add(): void
    {
        $_SESSION['user_id'] = 1;    //A affecter dans la fonction login

        $note = array_map('trim', $_GET);
        $note['date'] = $this->date->format('Y/m/d');
        $note['user_id'] = $_SESSION['user_id'];

        if (isset($note) && !empty($note) && !$this->validate($note['user_id'], $note['offre_id'])) {
            $this->noteManager->insert($note);
            //$this->twig->render('component/_alert.html.twig');
            echo 'ok';
            die();
        } else {
            //$this->twig->render('component/_alert.html.twig');
            echo 'error';
            var_dump($note);
            die();
        }
    }
}
