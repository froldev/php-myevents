<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\UsersManager;
use App\Model\EventsManager;

class AdminController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function login(): string
    {
        $errorMail = $errorMdp = $errorConnexion = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $isValid = true;

            if (empty($_POST['email']) || !isset($_POST['email'])) {
                $errorMail = "Vous devez compléter l'email";
                $isValid = false;
            }

            if (empty($_POST['password']) || !isset($_POST['password'])) {
                $errorMdp = "Vous devez compléter le mot de passe";
                $isValid = false;
            }

            if ($isValid) {
                $usersManager = new UsersManager();
                $user = $usersManager->selectPassword($_POST['email']);

                if (password_verify($_POST['password'], $user["password"])) {
                    $_SESSION['name'] = $user["firstname"];
                    $_SESSION['role'] = $user["role_id"];

                    if ($_SESSION['role'] <= 2) {
                        header('Location:/events/list');
                    }
                    $errorConnexion = "Vous n'avez pas les accès à cet espace d'administration";
                    return $this->twig->render('Admin/login.html.twig', [
                        'errorConnexion' => $errorConnexion,
                    ]);
                }
                $errorConnexion = "Erreur de connexion";
                return $this->twig->render('Admin/login.html.twig', [
                    'errorConnexion' => $errorConnexion,
                ]);
            }

            return $this->twig->render('Admin/login.html.twig', [
                'errorMail' => $errorMail,
                'errorMdp' => $errorMdp,
            ]);
        }

        return $this->twig->render('Admin/login.html.twig');
    }

    public function logout(): void
    {
        session_destroy();
        header('Location:/');
    }
}
