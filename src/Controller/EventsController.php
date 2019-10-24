<?php

namespace App\Controller;

use App\Model\EventsManager;

class EventsController extends AbstractController
{
    public function add()
    {
        $nameError = $dateError = $descriptionError = $priceError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST["name"]) || !isset($_POST["name"])) {
                $nameError = "Indiquez un nom d'évènement";
                $isValid = false;
            }
            if (empty($_POST["date_event"]) || !isset($_POST["date_event"])) {
                $dateError = "Indiquez une date";
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
            if ($isValid) {
                $eventsManager = new EventsManager();
                $eventsManager->insertEvent($_POST);
            }
        }
        return $this->twig->render("Events/add.html.twig", [
            "nameError" => $nameError,
            "dateError" => $nameError,
            "descriptionError" => $nameError,
            "priceError" => $nameError,
        ]);
    }
}
