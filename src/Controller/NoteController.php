<?php

namespace App\Controller;

use App\Model\NoteManager;

class NoteController extends AbstractController
{
    public function validate(int $userId, int $offreId): bool
    {
        $noteManager = new NoteManager();
        $requete = $noteManager->selectById($userId, $offreId);
        foreach ($requete as $key => $rowtable) {
            if (in_array($_SESSION['id'], $rowtable)) {
                return true;
            }
        }
        return false;
    }


    public function add(): void
    {
        $_SESSION['id'] = 2;   //A affecter dans la fonction login
        $note['offre_id'] = 4; //A récupérer du lien page offre
        $note['note'] = 5;     // A récupérer du lien page offre

        //$note = array_map('trim', $_GET);
        $date = new \DateTime();
        $noteManager = new NoteManager();
        $note['date'] = $date->format('Y/m/d');
        $note['user_id'] = $_SESSION['id'];

        if (isset($note) && !empty($note) && !$this->validate($note['user_id'], $note['offre_id'])) {
            $noteManager->insert($note);
            //$this->twig->render('component/_alert.html.twig');
            echo 'bouh';
            die();
        } else {
            //$this->twig->render('component/_alert.html.twig');
            echo 'error';
            var_dump($note);
        }
    }
}
