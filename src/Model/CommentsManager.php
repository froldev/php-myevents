<?php

namespace App\Model;

class CommentsManager extends AbstractManager
{
    const TABLE = "comment";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAnswerIsNull(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE. " WHERE answer_id IS NULL ORDER BY date_time");
        return $request->fetchAll();
    }

    public function selectAnswerIsNotNull(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE. " WHERE answer_id IS NOT NULL ORDER BY date_time");
        return $request->fetchAll();
    }
}
