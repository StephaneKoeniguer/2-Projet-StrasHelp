<?php

namespace App\Model;

use PDO;

/**
 * @SuppressWarnings(PHPMD)
 */
class OffreManager extends AbstractManager
{
    public function selectCategorie(): array
    {
        $query = 'SELECT categorie.description FROM offre RIGHT JOIN categorie on categorie.id = offre.categorie_id';
        return $statement = $this->pdo->query($query)->fetchAll();
    }

    public function selectOffre(): array
    {
        return $statement = $this->pdo->query('SELECT * FROM offre')->fetchAll();
    }

    public function selectArea(): array
    {
        return $statement = $this->pdo->query('SELECT area FROM offre GROUP BY area')->fetchAll();
    }

    public function selectAvailability(): array
    {
        return $statement = $this->pdo->query('SELECT availability FROM offre GROUP BY availability')->fetchAll();
    }

    public function searchOffre($data): array
    {
        /*
        if($data['area']) {
            where .= '';
        }

        if($data['disponibilites']) {
            where .= ' AND ';
        }

        if($data['categorie']) {
            where .= ' AND ';
        }*/

        $query = "SELECT * FROM offre INNER JOIN categorie on categorie.id = offre.categorie_id
        WHERE availability='" . $data['disponibilites'] . "'AND area='" . $data['area'] .
        "'AND categorie.description='" . $data['categorie'] . "'";

        return $statement = $this->pdo->query($query)->fetchAll();
    }
}
