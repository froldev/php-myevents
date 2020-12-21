<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\ProgrammingManager;
use App\Model\CategoriesManager;

class OlympicController extends AbstractController
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
        $events = $programmingManager->selectAllEventNotPast();
        $carousel = $programmingManager->carouselView();

        return $this->twig->render('Olympic/index.html.twig', [
            "events" => $events,
            "categories" => $listCategory,
            "carousels" => $carousel,
            "partners" => $this->getPartners()
        ]);
    }

    public function information()
    {
        return $this->twig->render('Olympic/info.html.twig', [
            'partners' => $this->getPartners(),
        ]);
    }

    public function contact()
    {
        return $this->twig->render('Olympic/contact.html.twig', [
            'partners' => $this->getPartners(),
        ]);
    }

    public function history()
    {
        return $this->twig->render('Olympic/history.html.twig', [
            'partners' => $this->getPartners(),
        ]);
    }
}
