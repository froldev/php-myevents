<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\CategoriesManager;
use App\Model\DetailManager;
use App\Model\PlacementManager;
use App\Model\ProgrammingManager;

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

    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $programmingManager = new ProgrammingManager();
            $events = $programmingManager->insertSearch($_POST);
            $carousel = $programmingManager->carouselView();

            $categories = new CategoriesManager();
            $listCategory = $categories->selectAll();

            return $this->twig->render('Olympic/index.html.twig', [
                'events' => $events,
                'categories' => $listCategory,
                'carousels' => $carousel
            ]);
        }

        return $this->twig->render("Olympic/index.html.twig");
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

    public function partner()
    {
        $partnersManager = new PartnersManager();
        $partners = $partnersManager->selectAll();

        return $this->twig->render('Programming/layout.html.twig', [
            "partners" =>   $this->getPartners(),
        ]);
    }

    public function event(int $id)
    {
        $detailManager = new DetailManager();
        $detail = $detailManager->selectOneByIdJoin($id);

        $placements = new PlacementManager();
        $listPlacement = $placements->selectAll();

        return $this->twig->render('Olympic/event.html.twig', [
            'details' => $detail,
            'placements' => $listPlacement,
        ]);
    }
}
