<?php

namespace App\Controller;

use App\Model\CreateUserManager;

class CreateUserController extends AbstractController
{
    public function controle($values)
    {
        foreach ($values as $value) {
            if ($values['type'] === 'particulier' && empty($value["date"])) {
                return false;
            }
            if ($value === '') {
                return true;
            }
        }
        return 'valide';
    }

    public function add(): ?string
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $createUser = array_map('trim', $_POST);
            $errors = $this->controle($createUser);
            if ($errors) {
                $message = "Veuillez remplir tous les champs requis.";
                header('Location:/?type=danger&message=' . $message);
            }
            $createUserManager = new createUserManager();
            $createUserManager->createUser($createUser);
            $createUserManager->createLogin($createUser);

            $message = "Votre inscription a été enregistrée avec succès!";
            header("Location:/?type=success&message=" . $message);
        }

        return $this->twig->render('Home/index.html.twig', ['message' => $message]);
    }
}
