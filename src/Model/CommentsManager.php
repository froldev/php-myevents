<?php

namespace App\Model;

use DateTime;

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

    public function insertComments($comments) : bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. "
        (firstname, lastname, email, object, message, date_time)
         VALUES (:firstname, :lastname, :email, :object, :message, :date_time)");
        $request->bindValue(":firstname", $comments["firstname"], \PDO::PARAM_STR);
        $request->bindValue(":lastname", $comments["lastname"], \PDO::PARAM_STR);
        $request->bindValue(":email", $comments["user_email"], \PDO::PARAM_STR);
        $request->bindValue(":object", $comments["object"], \PDO::PARAM_STR);
        $request->bindValue(":message", $comments["user_message"], \PDO::PARAM_STR);
        $request->bindValue(":date_time", (new DateTime("now"))->format("Y-m-d H:i:s"));
        return $request->execute();

    }
}
