<?php

namespace App\Controller;

use App\Model\ProgrammingManager;
use App\Model\CategoriesManager;

class ProgrammingController extends AbstractController
{
    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $programmingManager = new ProgrammingManager();
            $events = $programmingManager->insertSearch($_POST);

            $categories = new CategoriesManager();
            $listCategory = $categories->selectAll();

            return $this->twig->render('Home/index.html.twig', [
                'events' => $events,
                'categories' => $listCategory
            ]);
        }

        return $this->twig->render("Home/index.html.twig");
    }
}
