<?php

namespace App\Controller;

use App\Model\CommentsManager;
use App\Model\AnswersManager;

class CommentsController extends AbstractController
{
    public function list(): string
    {
        $this->verifySession();

        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectAnswerIsNull();

        return $this->twig->render('Admin/Comments/list.html.twig', [
            'comments' => $comments,
        ]);
    }

    public function display(int $id): string
    {
        $this->verifySession();

        $commentsManager = new CommentsManager();
        $comments = $commentsManager->selectOneById($id);

        $responseError = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isValid = true;
            // vérifier si il y a une réponse
            if (!isset($_POST['response']) || empty($_POST['response'])) {
                $responseError = "Merci d'indiquer une réponse avant de valider";
                $isValid = false;
            }
            // si tout est ok
            if ($isValid) {
                $answersManager = new AnswersManager();
                // envoyer le mail et intégrer dans la bdd
                $answer = $answersManager->insertAnswer($id, $_POST);
                if ($answer) {
                    header("Location:/comments/list");
                }
            }
        }
        return $this->twig->render('Admin/Comments/display.html.twig', [
            'comments'       => $comments,
            'responseError'  => $responseError,
        ]);
    }

    public function send(): string
    {
        $this->verifySession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isValid = true;
            $userLastNameError = null;
            $userFirstNameError = null;
            $userEmailError = null;
            $userObjectError = null;
            $userMessageError = null;

            // vérifier si il y a un lastname
            if (!isset($_POST['lastname']) || empty($_POST['lastname'])) {
                $userLastNameError = "Merci de renseigner votre nom";
                $isValid = false;
            }
            // vérifier si il y a un firstname
            if (!isset($_POST['firstname']) || empty($_POST['firstname'])) {
                $userFirstNameError = "Merci de renseigner votre prénom";
                $isValid = false;
            }
            // vérifier si il y a un email
            if (!isset($_POST['user_email']) || empty($_POST['user_email'])) {
                $userEmailError = "Merci d'entrer votre email";
                $isValid = false;
            } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
                $userEmailError = "Merci de renseigner un email valide";
                $isValid = false;
            }
            // vérifier si il y a un objet
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
                    header("Location:/show/contact");
                }
            }

            return $this->twig->render("Show/contact.html.twig", [
                "lastNameError" => $userLastNameError,
                "firstNameError" => $userFirstNameError,
                "userEmailError" => $userEmailError,
                "objectError" => $userObjectError,
                "userMessageError" => $userMessageError,
            ]);
        }
    }
}
