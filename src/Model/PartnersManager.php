<?php

namespace App\Model;

class PartnersManager extends AbstractManager
{
    const TABLE = 'partner';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectPartner(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE. " ORDER BY position");
        return $request->fetchAll();
    }

    public function deletePartners(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function insertPartner(array $partner): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (name, link) VALUES (:partner, :link)");
        $request->bindValue(":partner", ucwords(strtolower($partner["partner"])), \PDO::PARAM_STR);
        $request->bindValue(":link", strtolower($partner["linkPartner"]), \PDO::PARAM_STR);
        return $request->execute();
    }

    public function updatePartners(array $partner): bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET name=:partner, link=:linkPartner WHERE id=:id");
        $request->bindValue(":id", $partner["id"], \PDO::PARAM_INT);
        $request->bindValue(":partner", ucwords(strtolower($partner["partner"])), \PDO::PARAM_STR);
        $request->bindValue(":linkPartner", strtolower($partner["linkPartner"]), \PDO::PARAM_STR);
        return $request->execute();
    }
}
