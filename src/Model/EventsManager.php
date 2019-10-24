<?php

namespace App\Model;

class EventsManager extends AbstractManager
{
    const TABLE = "events";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertEvent(array $event): bool
    {
        $request = $this->pdo->prepare("INSERT INTO".self::table."(name, date, description, price) VALUES 
        (:name, :date_event, :description, :price)");

        $request->bindValue(":name", $event["name"], \PDO::PARAM_STR);
        $request->bindValue(":date", $event["date"], \PDO::PARAM_STR);
        $request->bindValue(":description", $event["description"], \PDO::PARAM_STR);
        $request->bindValue(":price", $event["price"], \PDO::PARAM_STR);

        $request->execute();
    }
}
