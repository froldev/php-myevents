<?php

namespace App\Model;

class NavbarManager extends AbstractManager
{
    const TABLE = 'navbar';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectNavbar(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE);
        return $request->fetchAll();
    }

    public function updateNavbar(array $navbar): bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET name=:title, position=:position WHERE id=:id");
        $request->bindValue(":id", $navbar["id"], \PDO::PARAM_INT);
        $request->bindValue(":title", $navbar["title"], \PDO::PARAM_STR);
        $request->bindValue(":position", $navbar["position"], \PDO::PARAM_STR);
        return $request->execute();
    }
}
