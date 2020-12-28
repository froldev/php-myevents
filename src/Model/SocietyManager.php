<?php

namespace App\Model;

class SocietyManager extends AbstractManager
{
    const TABLE = 'society';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectSociety(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE);
        return $request->fetch();
    }

    public function deleteSociety(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function updateSociety(array $society): bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET name=:society, picture=:picture WHERE id=:id");
        $request->bindValue(":id", $society["id"], \PDO::PARAM_INT);
        $request->bindValue(":society", $society["society"], \PDO::PARAM_STR);
        $request->bindValue(":picture", $society["picture"], \PDO::PARAM_STR);
        return $request->execute();
    }
}
