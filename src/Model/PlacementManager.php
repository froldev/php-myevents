<?php

namespace App\Model;

class PlacementManager extends AbstractManager
{
    const TABLE = 'placement';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectPlacement(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE);
        return $request->fetchAll();
    }

    public function deletePlacement(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function insertPlacement(array $placement): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (placement) VALUES (:placement)");
        $request->bindValue(":placement", ucwords(strtolower($placement["placement"])), \PDO::PARAM_STR);
        return $request->execute();
    }

    public function updatePlacement(array $placement): bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET name=:placement WHERE id=:id");
        $request->bindValue(":id", $placement["id"], \PDO::PARAM_INT);
        $request->bindValue(":placement", ucwords(strtolower($placement["placement"])), \PDO::PARAM_STR);
        return $request->execute();
    }
}
