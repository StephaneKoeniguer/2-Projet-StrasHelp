<?php

namespace App\Model;

use PDO;

class DeposerOffreManager extends AbstractManager
{
    public const TABLE = 'offre';

    public function insert(array $deposerOffre)
    {
        $statement = $this->pdo->prepare("
            INSERT INTO offre (title, area, availability, phone, description, categorie_id, user_id)
            VALUES (:title, :area, :availability, :phone, :description, :categorie_id, :user_id)
        ");
        $statement->bindValue(':title', $deposerOffre['title'], PDO::PARAM_STR);
        $statement->bindValue(':area', $deposerOffre['area'], PDO::PARAM_STR);
        $statement->bindValue(':availability', $deposerOffre['availability'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $deposerOffre['phone'], PDO::PARAM_STR);
        $statement->bindValue(':description', $deposerOffre['description'], PDO::PARAM_STR);
        $statement->bindValue(':categorie_id', $deposerOffre['categorie_id'], PDO::PARAM_INT);
        $statement->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete(int $id): void
    {
        $query = 'DELETE FROM offre WHERE id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectCategorie(): array
    {
        $query = 'SELECT categorie.description FROM offre RIGHT JOIN categorie ON categorie.id = offre.categorie_id';
        $statement = $this->pdo->query($query);
        return $statement->fetchAll();
    }

    public function fetchAll(): array
    {
        $query = "SELECT title, phone, O.description AS odescription, 
                  C.description AS cdescription, area, user_id, availability, O.id 
                  FROM offre AS O INNER JOIN categorie AS C ON C.id=O.categorie_id 
                  WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();
    }


    public function update(int $id, array $deposerOffre): void
    {
        $query = 'UPDATE offre SET title = :title, area = :area, availability = :availability,
                  phone = :phone, description = :description, categorie_id = :categorie_id
                  WHERE id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':title', $deposerOffre['title'], PDO::PARAM_STR);
        $statement->bindValue(':area', $deposerOffre['area'], PDO::PARAM_STR);
        $statement->bindValue(':availability', $deposerOffre['availability'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $deposerOffre['phone'], PDO::PARAM_STR);
        $statement->bindValue(':description', $deposerOffre['description'], PDO::PARAM_STR);
        $statement->bindValue(':categorie_id', $deposerOffre['categorie_id'], PDO::PARAM_INT);
        $statement->execute();
    }
}
