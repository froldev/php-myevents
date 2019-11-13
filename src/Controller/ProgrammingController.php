<?php

namespace App\Controller;

use App\Model\ProgrammingManager;

class ProgrammingController extends AbstractController
{
    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $programmingManager = new ProgrammingManager();
            $events = $programmingManager->insertSearch($_POST['search']);
            return $this->twig->render('Home/index.html.twig', [
                'events' => $events
            ]);
        }

        return $this->twig->render("Home/index.html.twig");
    }
}
