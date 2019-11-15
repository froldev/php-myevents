<?php

namespace App\Controller;

use App\Model\RoleManager;
use App\Model\UsersManager;

class UsersController extends AbstractController
{
    public function list()
    {
        $usersManager = new UsersManager();
        $users = $usersManager->selectUsersAndRole();

        $rolesManager = new RoleManager();
        $roles = $rolesManager->selectAll();

        return $this->twig->render("Admin/Users/list.html.twig", [
            "users" => $users,
            "roles" => $roles,
        ]);
    }

    public function add(): string
    {
        $rolesManager = new RoleManager();
        $roles = $rolesManager->selectAll();

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
            "lastNameError"     => $lastNameError,
            "firstNameError"    => $firstNameError,
            "emailError"        => $emailError,
            "passwordError"     => $passwordError,
            "roleError"         => $roleError,
            "roles"             => $roles,
        ]);
    }

    public function delete(int $id): void
    {
        $usersManager = new UsersManager();
        $users = $usersManager->selectOneById($id);

        if (strtolower($users['role_id']) != 0) {
            $usersManager->deleteUsers($id);
        }
        header("Location:/users/list");
    }

    public function edit(int $id): string
    {
        $usersManager = new UsersManager();
        $user = $usersManager->selectOneById($id);

        $rolesManager = new RoleManager();
        $roles = $rolesManager->selectAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user['id'] = $id;
            $user['lastname'] = $_POST['lastname'];
            $user['firstname'] = $_POST['firstname'];
            $user['email'] = $_POST['email'];
            $user['password'] = $_POST['password'];
            $user['role'] = $_POST['role'];
            if ($usersManager->updateUser($user)) {
                header("Location:/users/list");
            }
        }
        return $this->twig->render('Admin/Users/edit.html.twig', [
            'user'  => $user,
            'roles' => $roles,
        ]);
    }
}
