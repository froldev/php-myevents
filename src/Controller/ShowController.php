<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\CategoriesManager;
use App\Model\DetailManager;
use App\Model\NavbarManager;
use App\Model\PartnersManager;
use App\Model\PlacementManager;
use App\Model\ProgrammingManager;
use App\Model\SocietyManager;

class ShowController extends AbstractController
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

        $partnersManager = new PartnersManager();
        $partners = $partnersManager->selectPartner();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $programmingManager = new ProgrammingManager();
            $events = $programmingManager->insertSearch($_POST);
            $carousel = $programmingManager->carouselView();

            $categories = new CategoriesManager();
            $listCategory = $categories->selectAll();

            return $this->twig->render('Show/index.html.twig', [
                "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
                "current"       => "0",
                'events'        => $events,
                'categories'    => $listCategory,
                'carousels'     => $carousel
            ]);
        }

        return $this->twig->render('Show/index.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"       => "0",
            "events"        => $events,
            "categories"    => $listCategory,
            "carousels"     => $carousel,
            "partners"      => $partners,
        ]);
    }

    public function information()
    {
        return $this->twig->render('Show/information.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"   => "1",
        ]);
    }

    public function history()
    {
        return $this->twig->render('Show/history.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"   => "2",
        ]);
    }

    public function contact()
    {
        return $this->twig->render('Show/contact.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"   => "3",
        ]);
    }

    public function event(int $id)
    {
        $societyManager = new SocietyManager();
        $society = $societyManager->selectSociety();

        $navbarManager = new NavbarManager();
        $navbars = $navbarManager->selectNavbar();

        $detailManager = new DetailManager();
        $detail = $detailManager->selectOneByIdJoin($id);

        $placements = new PlacementManager();
        $listPlacement = $placements->selectAll();

        return $this->twig->render('Show/event.html.twig', [
            "society" => $society,
            "navbars"       => $navbars,
            'details' => $detail,
            'placements' => $listPlacement,
        ]);
    }
}
