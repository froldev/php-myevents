<?php

namespace App\Model;

class CategoriesManager extends AbstractManager
{
    const TABLE = "category";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertCategories(array $category)
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (category) VALUES (:category)");
        $request->bindValue(":category", ucfirst(strtolower($category["category"])), \PDO::PARAM_STR);
        return $request->execute();
    }

    public function deleteCategories(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
