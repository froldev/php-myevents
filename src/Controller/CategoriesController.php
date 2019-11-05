<?php

namespace App\Controller;

use App\Model\CategoriesManager;

class CategoriesController extends AbstractController
{
    public function list(): string
    {
        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectAll();

        return $this->twig->render("Categories/_list.html.twig", [
            "categories" => $categories,
        ]);
    }

    public function add(): string
    {
        $categoryError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST['category']) || !isset($_POST['category'])) {
                $categoryError = "Merci de saisir une nouvelle catégorie";
                $isValid = false;
            }
            // si tout est ok
            if ($isValid) {
                $categoriesManager = new CategoriesManager();

                if ($categoriesManager->insertCategories($_POST)) {
                        header("Location:/categories/list");
                }
            }
        }

        return $this->twig->render("Categories/_add.html.twig", [
            "categoryError" => $categoryError,
        ]);
    }

    public function delete(int $id): string
    {
        $categoriesManager = new CategoriesManager();
        $categoriesManager->deleteCategories($id);
        header("Location:/categories/list");
    }

    public function edit(int $id): string
    {
        $categoriesManager = new CategoriesManager();
        $category = $categoriesManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category['category'] = $_POST['category'];
            var_dump($_POST);
            if ($categoriesManager->updateCategories($category)) {
                header("Location:/categories/list");
            }
        }

        return $this->twig->render('Categories/_edit.html.twig', [
            "category" => $category
        ]);
    }
}
