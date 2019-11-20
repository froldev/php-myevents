<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\PartnersManager;
use App\Model\ProgrammingManager;
use App\Model\CategoriesManager;

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $categories = new CategoriesManager();
        $listCategory = $categories->selectAll();

        $programmingManager = new ProgrammingManager();
        $events = $programmingManager->selectAll();
        $carousel = $programmingManager->carouselView();

        if (isset($_POST['lastname'])) {
            $_SESSION['lastname'] = $_POST['lastname'];
        }

        return $this->twig->render('Home/index.html.twig', [
            "events" => $events,
            "categories" => $listCategory,
            "carousels" => $carousel,
            "session" => $_SESSION,
            "partners" => $this->getPartners()
        ]);
    }
}
