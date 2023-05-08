<?php

namespace App\Controller;

use App\Model\CreateUserManager;

class CreateUserController extends AbstractController
{
    public function add(): ?string
    {
        $message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $createuser = array_map('trim', $_POST);

            $createUserManager = new createUserManager();
            $createUserManager->createUser($createuser);

            $message = "Votre inscription a été enregistrée avec succès!";

            header("Location:/?message=" . $message);
        }

        return $this->twig->render('Home/index.html.twig', ['message' => $message]);
    }
}
