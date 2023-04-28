<?php

namespace App\Model;

use PDO;

class DeposerOffreManager extends AbstractManager
{
    public function insert(array $deposerOffre)
    {
        $statement = $this->pdo->prepare("SELECT id FROM categorie WHERE description = :description");
        $statement->bindValue('description', $deposerOffre['categorie_id'], PDO::PARAM_STR);
        $statement->execute();
        $categorieId = $statement->fetch()['id'];
        $statement = $this->pdo->prepare("
            INSERT INTO offre (title, area, availability, phone, description, categorie_id)
            VALUES (:title, :area, :availability, :phone, :description, :categorie_id);
            FROM categorie;
            WHERE categorie.id = :categorie_id
        ");
        $statement->bindValue('title', $deposerOffre['title'], PDO::PARAM_STR);
        $statement->bindValue('area', $deposerOffre['area'], PDO::PARAM_STR);
        $statement->bindValue('availability', $deposerOffre['availability'], PDO::PARAM_STR);
        $statement->bindValue('phone', $deposerOffre['phone'], PDO::PARAM_STR);
        $statement->bindValue('description', $deposerOffre['description'], PDO::PARAM_STR);
        $statement->bindValue('categorie_id', $categorieId, PDO::PARAM_INT);
        $statement->execute();
    }

    public function selectCategorie(): array
    {
        $query = 'SELECT * FROM categorie';
        $statement = $this->pdo->query($query)->fetchAll();
        return $statement;
    }

    public function delete(int $id): void
    {
        $query = 'DELETE FROM offre WHERE id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
