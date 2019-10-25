<?php

namespace App\Controller;

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
                var_dump("coucou");
                $eventsManager = new EventsManager();

                if ($eventsManager->insertEvent($_POST)) {
                    header("Location:/event/list");
                }
            }
        }
        return $this->twig->render("Events/add.html.twig", [
            "titleError" => $titleError,
            "dateTimeError" => $dateTimeError,
            "descriptionError" => $descriptionError,
            "priceError" => $priceError,
        ]);
    }
}
