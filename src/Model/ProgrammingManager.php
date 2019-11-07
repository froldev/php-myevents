<?php

namespace App\Model;

class ProgrammingManager extends AbstractManager
{
    const TABLE = "event";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertSearch(string $search)
    {
        $query = $this->pdo->prepare(
            "SELECT *
            FROM " . self::TABLE . " 
            LEFT JOIN event_category ON event_category.event_id = event.id
            LEFT JOIN category ON category.id = event_category.category_id
            WHERE title LIKE :title
            OR category LIKE :category;"
        );
        $searchs = '%' . $search . '%';

        $query->bindValue(':title', $searchs, \PDO::PARAM_STR);
        $query->bindValue(':category', $searchs, \PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll();
    }
}
