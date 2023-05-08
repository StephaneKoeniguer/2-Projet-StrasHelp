<?php

namespace App\Controller;

use App\Model\UserManager;

class SecurityController extends AbstractController
{
    /**
     * Check user and password
     */
    public function login()
    {
        if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
            $userManager = new UserManager();
            $isLogin = $userManager->selectOneByAccount($_POST['login'], $_POST['password']);
            if ($isLogin) {
                $_SESSION['login'] = $isLogin['login'];
                $_SESSION['isLogin'] = true;
                $_SESSION['user_id'] = $isLogin['id'];
                header('location:/');
            } else {
                header('Location: /login');
            }
        }
        return $this->twig->render('user/login.html.twig');
    }


    /**
     * Disconnect user
     */
    public function logout()
    {
        $_SESSION['login'] = '';
        $_SESSION['isLogin'] = '';
        $_SESSION['user_id'] = '';
        header('Location:/');
    }

    public function forbidden()
    {
        return $this->twig->render('user/forbidden.html.twig');
    }
}
