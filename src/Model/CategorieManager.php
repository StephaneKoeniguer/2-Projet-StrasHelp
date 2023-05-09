<?php

 namespace App\Model;

 use PDO;

class CategorieManager extends AbstractManager
{
    public const TABLE = 'categorie';

    /**
     * function select all categories
     */
    public function selectCategorie(): array
    {
        $query = 'SELECT * FROM categorie';
        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * function count offres per catéagorie (dashboard)
     */
    public function offrePerCategorie(): array
    {
        $query = 'SELECT count(offre.id) as nombre, categorie.description FROM offre RIGHT JOIN categorie ON 
        categorie.id = offre.categorie_id GROUP BY categorie.id';
        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * function insert a new catégorie
     */
    public function insert(array $categorie): void
    {
        $statement = $this->pdo->prepare("INSERT INTO categorie (description)  VALUES (:description)");
        $statement->bindValue('description', $categorie['categorie'], PDO::PARAM_STR);
        $statement->execute();
    }
}
