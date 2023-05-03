<?php

namespace App\Model;

use PDO;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    //Get email and password.
    public function selectOneByAccount(string $login, string $password): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE .
            " WHERE login=:login AND password=:password");
        $statement->bindValue('login', $login, \PDO::PARAM_STR);
        $statement->bindValue('password', md5($password), \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
