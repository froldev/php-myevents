<?php

namespace App\Controller;

class EventsController extends AbstractController
{
    public function add(): string
    {
        return $this->twig->render("Events/add.html.twig");
    }
}
