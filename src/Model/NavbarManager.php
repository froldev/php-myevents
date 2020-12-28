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
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE. " WHERE visibility=1");
        return $request->fetchAll();
    }

    public function updateNavbar(array $navbar): bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET name=:title, visibility=:visibility WHERE id=:id");
        $request->bindValue(":id", $navbar["id"], \PDO::PARAM_INT);
        $request->bindValue(":title", $navbar["title"], \PDO::PARAM_STR);
        $request->bindValue(":visibility", $navbar["visibility"], \PDO::PARAM_STR);
        return $request->execute();
    }
}
