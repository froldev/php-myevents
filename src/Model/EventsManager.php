<?php

namespace App\Model;

use mysql_xdevapi\Table;
use mysql_xdevapi\TableSelect;
use DateTime;

class EventsManager extends AbstractManager
{
    const TABLE = "event";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insertEvent(array $event): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (title, date_time, description, price,
        image, video, link)
        VALUES (:title, :date_time, :description, :price, :image, :video, :link)
        ");
        $request->bindValue(":title", $event["title"], \PDO::PARAM_STR);
        $request->bindValue(":date_time", $event["date_time"], \PDO::PARAM_STR);
        $request->bindValue(":description", $event["description"], \PDO::PARAM_STR);
        $request->bindValue(":price", $event["price"], \PDO::PARAM_INT);
        $request->bindValue(":image", $event["image"], \PDO::PARAM_STR);
        $request->bindValue(":video", $event["video"], \PDO::PARAM_STR);
        $request->bindValue(":link", $event["link"], \PDO::PARAM_STR);

        if ($request->execute()) {
            $lastId = $this->pdo->lastInsertId();

            $request = $this->pdo->prepare("INSERT INTO event_category  (category_id, event_id)
            VALUES (:category, " . $lastId . ")");

            $request->bindValue(":category", $event["category"], \PDO::PARAM_STR);
        }

        return $request->execute();
    }

    public function deleteEvent(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM ".self::TABLE." WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function updateEvents(array $event, int $id) : bool
    {
        $date = new DateTime($event['date_time']);
        $time = $date->format('Y-m-d H:i:s');

        $request = $this->pdo->prepare("UPDATE " . self::TABLE . "
            left JOIN event_category ON event.id = event_category.event_id
            SET title = :title, date_time = :date_time, 
            price = :price, description = :description, image = :image, video = :video, link = :link,
            category_id = :category
            WHERE " . self::TABLE . ".id=:id");
        $request->bindValue(':id', $id, \PDO::PARAM_INT);
        $request->bindValue(':title', $event['title'], \PDO::PARAM_STR);
        $request->bindValue(':date_time', $time, \PDO::PARAM_STR);
        $request->bindValue(':description', $event['description'], \PDO::PARAM_STR);
        $request->bindValue(':price', $event['price'], \PDO::PARAM_INT);
        $request->bindValue(':image', $event['image'], \PDO::PARAM_STR);
        $request->bindValue(':video', $event['video'], \PDO::PARAM_STR);
        $request->bindValue(':link', $event['link'], \PDO::PARAM_STR);
        $request->bindValue(':category', $event['category'], \PDO::PARAM_INT);

        return $request->execute();
    }

    public function deleteLastEvents(): void
    {
        $request = $this->pdo->prepare("DELETE FROM ".self::TABLE." WHERE date_time < now()");
        $request->execute();
    }
}
