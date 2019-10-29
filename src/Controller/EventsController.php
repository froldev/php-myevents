<?php

namespace App\Controller;

use App\Model\CategoriesManager;
use App\Model\EventsManager;

class EventsController extends AbstractController
{
    public function add()
    {
        $titleError = $dateTimeError = $descriptionError = $priceError = $imageError = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST["title"]) || !isset($_POST["title"])) {
                $titleError = "Indiquez un nom d'évènement";
                $isValid = false;
            }
            if (empty($_POST["date_time"]) || !isset($_POST["date_time"])) {
                $dateTimeError = "Indiquez une date";
                $isValid = false;
            }
            if (empty($_POST["description"]) || !isset($_POST["description"])) {
                $descriptionError = "Décrivez l'évènement";
                $isValid = false;
            }
            if (empty($_POST["price"]) || !isset($_POST["price"])) {
                $priceError = "Indiquez un prix";
                $isValid = false;
            }
            if (empty($_POST["image"]) || !isset($_POST["image"])) {
                $imageError = "Ajouter une image";
                $isValid = false;
            }

            if ($isValid) {
                $eventsManager = new EventsManager();

                if ($eventsManager->insertEvent($_POST)) {
                    header("Location:/event/list");
                }
            }
        }
        return $this->twig->render("Events/_add.html.twig", [
            "titleError" => $titleError,
            "dateTimeError" => $dateTimeError,
            "descriptionError" => $descriptionError,
            "priceError" => $priceError,
        ]);
    }

    public function list(): string
    {
        $eventsManager = new EventsManager();
        $events = $eventsManager->selectAll();

        return $this->twig->render("Events/_list.html.twig", [
            "events" => $events,
        ]);
    }

    public function delete(int $id): void
    {
        $eventsManager = new EventsManager();
        $eventsManager->deleteEvent($id);
        header("Location:/events/list");
    }



}
