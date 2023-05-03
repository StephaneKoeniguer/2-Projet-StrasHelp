<?php

 namespace App\Model;

 use PDO;

/**
 * @SuppressWarnings(PHPMD)
 */
class CategorieManager extends AbstractManager
{
    public const TABLE = 'categorie';

    //public function insert(array $categorie);

    public function selectCategorie(): array
    {
        $query = 'SELECT * FROM categorie';
        return $statement = $this->pdo->query($query)->fetchAll();
    }

    public function insert(array $categorie): void
    {
        $statement = $this->pdo->prepare("INSERT INTO categorie (description)  VALUES (:description)");
        $statement->bindValue('description', $categorie['categorie'], PDO::PARAM_STR);
        $statement->execute();
    }
}
