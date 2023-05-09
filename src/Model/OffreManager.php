<?php

namespace App\Model;

use PDO;

class OffreManager extends AbstractManager
{
    public function selectOffre(): array
    {
        return $this->pdo->query('SELECT * FROM offre')->fetchAll();
    }

    public function selectArea(): array
    {
        return $this->pdo->query('SELECT area FROM offre GROUP BY area')->fetchAll();
    }

    public function selectAvailability(): array
    {
        return $this->pdo->query('SELECT availability FROM offre GROUP BY availability')->fetchAll();
    }


    /**
     * Search offer dynamic construct sql query
     */
    public function searchOffre($data): array
    {
        $query = "SELECT *, offre.description FROM offre INNER JOIN categorie on categorie.id = offre.categorie_id
        WHERE ";

        $index = 0;
        foreach ($data as $key => $value) {
            if ('categorie' == $key) {
                $key =  $key . '.' . 'description';
            } elseif ('disponibilites' == $key) {
                $key = 'availability';
            }

            $query .= $key . ' = "' . $value . '"';

            if ($index < count($data) - 1) {
                   $query .= ' AND ';
                   $index++;
            }
        }



        return $this->pdo->query($query)->fetchAll();
    }

    /**
     * Select offre / catégorie / note for dashboard
     */
    public function selectAllOffres(): array
    {
        $query = 'SELECT offre.title, offre.description as description, offre.availability, offre.area, 
        categorie.description as categorie, offre.id,
        note.offre_id, round(avg(note),1) as note
        FROM offre 
        INNER JOIN categorie ON categorie.id = offre.categorie_id
        LEFT JOIN note ON note.offre_id = offre.id
        GROUP BY offre.id';
        return $this->pdo->query($query)->fetchAll();
    }


    /**
     * delete offer from Dashboard
     */
    public function deleteOffre($id): void
    {
        $query = 'DELETE FROM offre WHERE id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * search offer from Dashboard
     */
    public function searchDashboard($filter): array
    {
        $query = 'SELECT offre.title, offre.description as description, offre.availability, offre.area, 
        categorie.description as categorie, offre.id,
        note.offre_id, round(avg(note),1) as note
        FROM offre
        LEFT JOIN note ON note.offre_id = offre.id
        INNER JOIN categorie ON categorie.id = offre.categorie_id
        WHERE offre.description LIKE :filter
        GROUP BY offre.id';

        $statement = $this->pdo->prepare($query);
        $statement->bindValue('filter', '%' . $filter . '%', \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
