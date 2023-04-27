<?php

namespace App\Model;

use PDO;

/**
 * @SuppressWarnings(PHPMD)
 */
class NoteManager extends AbstractManager
{
    public const TABLE = 'note';

    /**
     * Insert new note in database
     */
    public function insert(array $note): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`date`,`note`,`user_id`,`offre_id`) 
        VALUES (:date, :note, :user_id, :offre_id)");
        $statement->bindValue('date', $note['date'], PDO::PARAM_STR);
        $statement->bindValue('note', $note['note'], PDO::PARAM_INT);
        $statement->bindValue('user_id', $note['user_id'], PDO::PARAM_INT);
        $statement->bindValue('offre_id', $note['offre_id'], PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Search user note in database
     */
    public function selectById(int $userId, int $offreId): int
    {
        $query = 'SELECT user_id FROM ' . self::TABLE . ' WHERE user_id = ' . $userId . ' AND offre_id = ' . $offreId;
        return $statement = $this->pdo->query($query)->fetch();
    }

    /**
     * Search note average in database
     */
    public function noteAverage(): array
    {
        $query = 'SELECT offre_id, round(avg(note),1) as moyenne FROM ' . self::TABLE .
         ' INNER JOIN offre on offre.id = note.offre_id GROUP BY offre_id';
        return $statement = $this->pdo->query($query)->fetchAll();
    }
}
