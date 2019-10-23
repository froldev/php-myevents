<?php

namespace App\Controller;

use App\Model\CategoriesManager;

class CategoriesController extends AbstractController
{
    public function list(): string
    {
        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll();

        return $this->twig->render("Categories/list.html.twig", [
                "categories" => $categories,
            ]);
    }
}
