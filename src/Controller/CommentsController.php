<?php

namespace App\Controller;

use App\Model\CommentsManager;

class CommentsController extends AbstractController
{
    public function list(): string
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectAll();

        return $this->twig->render('Comments/_list.html.twig', [
            'comments' => $comments,
        ]);
    }

    public function display(int $id): string
    {
        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectOneById($id);

        return $this->twig->render('Comments/_display.html.twig', [
            'comments' => $comments,
        ]);
    }

    public function send(): string
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isValid = true;
            $userLastNameError = null;
            $userFirstNameError = null;
            $userEmailError = null;
            $userObjectError = null;
            $userMessageError = null;

            if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
                $userLastNameError = "Merci de renseigner votre nom";
                $isValid = false;
            }

            if (!isset($_POST['firstname']) || empty($_POST['firstname'])) {
                $userFirstNameError = "Merci de renseigner votre prénom";
                $isValid = false;
            }

            if (!isset($_POST['user_email']) || empty($_POST['user_email'])) {
                $userEmailError = "Merci d'entrer votre email";
                $isValid = false;
            } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
                $userEmailError = "Merci de renseigner un email valide";
                $isValid = false;
            }

            if (!isset($_POST['object']) || empty($_POST['object'])) {
                $userObjectError = "Merci de préciser l'objet de votre message";
                $isValid = false;
            }

            if (!isset($_POST['user_message']) || empty($_POST['user_message'])) {
                $userMessageError = "Merci d'entrer votre message";
                $isValid = false;
            }

            if ($isValid) {
                $commentsManager = new CommentsManager();
                if ($commentsManager->insertComments($_POST)) {
                    header("Location:/olympic/contact");
                }
            }

            return $this->twig->render("Olympic/contact.html.twig", [
                "lastNameError" => $userLastNameError,
                "firstNameError" => $userFirstNameError,
                "userEmailError" => $userEmailError,
                "objectError" => $userObjectError,
                "userMessageError" => $userMessageError,
            ]);
        }
    }
}
