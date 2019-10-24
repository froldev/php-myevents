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

    public function add()
    {
        $categoryError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST['category']) || !isset($_POST['category'])) {
                $categoryError = "Merci de saisir une nouvelle catégorie";
                $isValid = false;
            }
            if ($isValid) {
                $categoriesManager = new CategoriesManager();
                if ($categoriesManager->insertCategories($_POST)) {
                    header("Location:/categories/list");
                }
            }
        }

        return $this->twig->render("Categories/add.html.twig", [
            "categoryError" => $categoryError,
        ]);
    }
}
