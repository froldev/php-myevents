<?php

namespace App\Model;

use App\Controller\AbstractController;

class DetailManager extends AbstractManager
{
    const TABLE = "event";

    public function selectOneByIdJoin(int $id)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM $this->table 
            LEFT JOIN event_category ON event_category.event_id = event.id
            LEFT JOIN category ON category.id = event_category.category_id
            WHERE event.id=:id            
            ");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
