<?php

namespace App\Model;

class ProgrammingManager extends AbstractManager
{
    const TABLE = "event";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function carouselView()
    {
        $query = $this->pdo->prepare(
            "SELECT id, title, date_time, picture 
            FROM " . self::TABLE . " 
            WHERE date_time > now()
            ORDER BY date_time
            LIMIT 6;
            "
        );
        $query -> execute();
        return $query -> fetchAll();
    }

    public function searchEventsByText(array $search): array
    {
        $query = $this->pdo->prepare(
            "SELECT *, event.id
            FROM " . self::TABLE . " 
            LEFT JOIN event_category ON event_category.event_id = event.id
            LEFT JOIN category ON category.id = event_category.category_id
            WHERE date_time > now()
            AND title LIKE :title
            OR category LIKE :category;"
        );

        $searchs = '%' . $search['search'] . '%';

        $query->bindValue(':title', $searchs, \PDO::PARAM_STR);
        $query->bindValue(':category', $searchs, \PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll();
    }

    public function searchEventsByCategory(array $search): array
    {
        $query = $this->pdo->prepare(
            "SELECT *, event.id
        FROM " . self::TABLE . " 
        LEFT JOIN event_category ON event_category.event_id = event.id
        LEFT JOIN category ON category.id = event_category.category_id
        WHERE category.id LIKE :category
        AND date_time > now();"
        );

        $query->bindValue(':category', $search['category'], \PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll();
    }
}
