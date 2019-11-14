<?php

namespace App\Controller;

use App\Model\UsersManager;

class UsersController extends AbstractController
{
    public function list()
    {
        $usersManager = new UsersManager();
        $users = $usersManager->selectUsers();

        return $this->twig->render("Admin/Users/list.html.twig", [
            "users" => $users,
        ]);
    }

    public function add(): string
    {
        $lastNameError = null;
        $firstNameError = null;
        $emailError = null;
        $passwordError = null;
        $roleError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            // nom
            if (empty($_POST['lastname']) || !isset($_POST['lastname'])) {
                $lastNameError = "Merci de saisir un nom";
                $isValid = false;
            }
            // prénom
            if (empty($_POST['firstname']) || !isset($_POST['firstname'])) {
                $firstNameError = "Merci de saisir un prénom";
                $isValid = false;
            }
            // mail
            if (empty($_POST['email']) || !isset($_POST['email'])) {
                $emailError = "Merci de saisir un email";
                $isValid = false;
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $emailError = "Le format du mail n\'est pas bon";
                $isValid = false;
            }
            // password
            if (empty($_POST['password']) || !isset($_POST['password'])) {
                $passwordError = "Merci de saisir un mot de passe";
                $isValid = false;
            }
            // role
            if (empty($_POST['role']) || !isset($_POST['role'])) {
                $roleError = "Merci de sélectionner un role";
                $isValid = false;
            }
            // if it's ok
            if ($isValid) {
                $usersManager = new UsersManager();
                if ($usersManager->insertUser($_POST)) {
                    header("Location:/users/list");
                }
            }
        }

        return $this->twig->render("Admin/Users/add.html.twig", [
            "lastNameError" => $lastNameError,
            "firstNameError" => $firstNameError,
            "emailError" => $emailError,
            "passwordError" => $passwordError,
            "roleError" => $roleError,
        ]);
    }

    public function delete(int $id): void
    {
        $usersManager = new UsersManager();
        $usersManager->deleteUsers($id);
        header("Location:/users/list");
    }
}
