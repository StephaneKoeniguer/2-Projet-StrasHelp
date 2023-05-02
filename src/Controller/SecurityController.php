<?php

namespace App\Controller;

use App\Model\UserManager;

class SecurityController extends AbstractController
{
    public function login()
    {
        if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $isLogin = $userManager->selectOneByAccount($_POST ['login'], $_POST['password']);
            if ($isLogin) {
                $_SESSION['login'] = $isLogin['login'];
                $_SESSION['isLogin'] = true;
                header('Home:/super-admin.html.twig');
            } else {
                header('component:/_popUpLogin');
            }
        }
        return $this->twig->render('component/_popUpLogin.html.twig');
    }

    public function logout()
    {
        $_SESSION['login'] = '';
        $_SESSION['isLogin'] = '';
        header('Location:/');
    }

    public function forbidden()
    {
        return $this->twig->render('user/forbidden.html.twig');
    }
}
