<?php

namespace App\Model;

class CategoriesManager extends AbstractManager
{
    const TABLE = "category";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertCategories(array $category): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (category) VALUES (:category)");
        $request->bindValue(":category", ucfirst(strtolower($category["category"])), \PDO::PARAM_STR);
        return $request->execute();
    }

    public function deleteCategories(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function updateCategories(array $category):bool
    {
        $request = $this->pdo->prepare("UPDATE $this->table SET `category`=:category WHERE id=:id");
        $request->bindValue(":id", $category['id'], \PDO::PARAM_INT);
        $request->bindValue(":category", ucfirst(strtolower($category["category"])), \PDO::PARAM_STR);
        return $request->execute();
    }

    public function selectCategories(): array
    {
        return $this->pdo->query('SELECT * FROM ' . $this->table)->fetchAll();
    }
}
