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
            "SELECT image 
            FROM " . self::TABLE . " 
            ORDER BY date_time
            LIMIT 6"
        );
        $query -> execute();
        return $query -> fetchAll();
    }

    public function insertSearch(array $search): array
    {
        if (!empty($search['search']) && !empty($search['category'])) {
            $query = $this->pdo->prepare(
                "SELECT *, event.id
            FROM " . self::TABLE . " 
            LEFT JOIN event_category ON event_category.event_id = event.id
            LEFT JOIN category ON category.id = event_category.category_id
            WHERE category.id LIKE :category
            AND title LIKE :title;"
            );

            $searchs = '%' . $search['search'] . '%';

            $query->bindValue(':title', $searchs, \PDO::PARAM_STR);

            $query->bindValue(':category', $search['category'], \PDO::PARAM_STR);
            $query->execute();

            return $query->fetchAll();
        }

        if (empty($search['search'])) {
            $query = $this->pdo->prepare(
                "SELECT *, event.id
            FROM " . self::TABLE . " 
            LEFT JOIN event_category ON event_category.event_id = event.id
            LEFT JOIN category ON category.id = event_category.category_id
            WHERE category.id LIKE :category;"
            );

            $query->bindValue(':category', $search['category'], \PDO::PARAM_STR);
            $query->execute();

            return $query->fetchAll();
        }

        $query = $this->pdo->prepare(
            "SELECT *, event.id
            FROM " . self::TABLE . " 
            LEFT JOIN event_category ON event_category.event_id = event.id
            LEFT JOIN category ON category.id = event_category.category_id
            WHERE title LIKE :title
            OR category LIKE :category;"
        );

        $searchs = '%' . $search['search'] . '%';

        $query->bindValue(':title', $searchs, \PDO::PARAM_STR);
        $query->bindValue(':category', $searchs, \PDO::PARAM_STR);
        $query->execute();

        return $query->fetchAll();
    }
}
