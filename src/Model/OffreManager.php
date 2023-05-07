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

        foreach ($data as $key => $value) {
            if ('categorie' == $key) {
                $key =  $key . '.' . 'description';
            } elseif ('disponibilites' == $key) {
                $key = 'availability';
            }

            $query .= $key . ' = "' . $value . '"';

            $index = 0;
            if ($index < count($data) - 1) {
                   $query .= ' AND ';
                   $index++;
            }
        }
        return $this->pdo->query($query)->fetchAll();
    }
}
