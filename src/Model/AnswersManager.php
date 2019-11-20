<?php

namespace App\Model;

use DateTime;

class AnswersManager extends AbstractManager
{
    const TABLE = "answer";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertAnswer($id, $answer): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. "
        (message, date_time)
         VALUES (:message, :date)");
        $request->bindValue(":message", $answer["response"], \PDO::PARAM_STR);
        $request->bindValue(":date", (new DateTime("now"))->format("Y-m-d H:i:s"));
        $request->execute();

        // indiquer l'id de la table answer dans la table comment
        $lastId = $this->pdo->lastInsertId();
        $request = $this->pdo->prepare("UPDATE ".CommentsManager::TABLE."
            SET answer_id = :answer_id
            WHERE id=:id");
        $request->bindValue(":answer_id", $lastId, \PDO::PARAM_INT);
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        return $request->execute();
    }
}
