<?php

namespace App\Model;

class MentionsManager extends AbstractManager
{
    const TABLE = 'mentions';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectMentions(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE);
        return $request->fetch();
    }

    public function updateMentions(array $mentions): bool
    {
        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET name=:propriety, mentions=:mentions WHERE id=:id");
        $request->bindValue(":id", $mentions["id"], \PDO::PARAM_INT);
        $request->bindValue(":propriety", $mentions["propriety"], \PDO::PARAM_STR);
        $request->bindValue(":mentions", $mentions["mentions"], \PDO::PARAM_STR);
        return $request->execute();
    }
}
