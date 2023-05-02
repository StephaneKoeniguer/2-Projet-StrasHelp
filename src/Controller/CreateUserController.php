<?php

namespace App\Controller;

use App\Model\CreateUserManager;

class CreateUserController extends AbstractController
{
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $createuser = array_map('trim', $_POST);

            $createUserManager = new createUserManager();
            $createUserManager->createUser($createuser);

            return $this->twig->render('Home/index.html.twig');
        }

        return $this->twig->render('Home/index.html.twig');
    }
}
