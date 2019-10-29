<?php

namespace App\Model;

class EventsManager extends AbstractManager
{
    const TABLE = "event";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertEvent(array $event)
    {
        $request = $this->pdo->prepare("INSERT INTO ".self::TABLE." (title, date_time, description, price, 
        image) VALUES 
        (:title, :date_time, :description, :price, :image)");

        $request->bindValue(":title", $event["title"], \PDO::PARAM_STR);
        $request->bindValue(":date_time", $event["date_time"], \PDO::PARAM_STR);
        $request->bindValue(":description", $event["description"], \PDO::PARAM_STR);
        $request->bindValue(":price", $event["price"], \PDO::PARAM_INT);
        $request->bindValue(":image", $event["image"], \PDO::PARAM_INT);

        return $request->execute();
    }

    public function deleteEvent(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM ".self::TABLE." WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }
}
