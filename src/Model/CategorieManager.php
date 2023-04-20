<?php

 namespace App\Model;

 use PDO;

class CategorieManager extends AbstractManager
{
    public const TABLE = 'item';

    /**
     * Insert new item in database
     */
    public function insert(array $categorie): void
    {
        $statement = $this->pdo->prepare("INSERT INTO categorie (description)  VALUES (:description)");
        $statement->bindValue('description', $categorie['categorie'], PDO::PARAM_STR);

        $statement->execute();
    }
}
