<?php

namespace App\Controller;

use App\Model\CategoriesManager;

class CategoriesController extends AbstractController
{
    public function list(): string
    {
        $this->verifySession();

        $categoriesManager = new CategoriesManager();
        $categories = $categoriesManager->selectCategories();

        return $this->twig->render("Admin/Categories/list.html.twig", [
                "categories" => $categories,
            ]);
    }

    public function add(): string
    {
        $this->verifySession();

        $categoryError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST['category']) || !isset($_POST['category'])) {
                $categoryError = "Merci de saisir une nouvelle catégorie";
                $isValid = false;
            }
            // if it's ok
            if ($isValid) {
                $categoriesManager = new CategoriesManager();

                if ($categoriesManager->insertCategories($_POST)) {
                    header("Location:/categories/list");
                }
            }
        }
        return $this->twig->render("Admin/Categories/add.html.twig", [
            "categoryError" => $categoryError,
        ]);
    }

    public function delete(int $id): void
    {
        $this->verifySession();

        $categoriesManager = new CategoriesManager();
        $categoriesManager->deleteCategories($id);
        header("Location:/categories/list");
    }

    public function edit(int $id): string
    {
        $this->verifySession();

        $categoriesManager = new CategoriesManager();
        $category = $categoriesManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category['category'] = $_POST['category'];
            if ($categoriesManager->updateCategories($category)) {
                header("Location:/categories/list");
            }
        }
        return $this->twig->render('Admin/Categories/edit.html.twig', [
            'category' => $category,
        ]);
    }
}
