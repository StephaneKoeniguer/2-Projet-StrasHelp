<?php

namespace App\Controller;

use App\Model\CreateUserManager;

class CreateUserController extends AbstractController
{
    /**
     * Create a new user
     */
    public function add(): ?string
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $createuser = array_map('trim', $_POST);

            $createUserManager = new createUserManager();
            $createUserManager->createUser($createuser);

            $message = "Votre inscription a été enregistrée avec succès!";

            // return $this->twig->render('Home/index.html.twig', ['message' => $message]);

            header("Location:/?message=" . $message);
        }

        return $this->twig->render('Home/index.html.twig', ['message' => $message]);
    }
}
