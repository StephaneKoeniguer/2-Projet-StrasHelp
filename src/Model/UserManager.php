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

    /**
     * Get type compte for dashboard
     */
    public function selectTypeCompte(): array
    {
        $query = 'SELECT
        (SELECT count(id) FROM association) as nombreAsso,
        (SELECT count(id) FROM particulier) as nombrePart';

        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * Get table particulier for dashboard
     */
    public function selectParticulier(): array
    {
        return $this->pdo->query('SELECT * FROM particulier')->fetchAll();
    }

    /**
     * Get table association for dashboard
     */
    public function selectAssociation(): array
    {
        return $this->pdo->query('SELECT * FROM association')->fetchAll();
    }
}
