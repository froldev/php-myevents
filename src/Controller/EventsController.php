<?php

namespace App\Controller;

use App\Model\AbstractManager;
use App\Model\CategoriesManager;
use App\Model\DetailManager;
use App\Model\NavbarManager;
use App\Model\MentionsManager;
use App\Model\PartnersManager;
use App\Model\PlacementManager;
use App\Model\ProgrammingManager;
use App\Model\SocietyManager;

class EventsController extends AbstractController
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

        return $this->twig->render('Events/index.html.twig', [
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
        return $this->twig->render('Events/information.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"   => "1",
        ]);
    }

    public function history()
    {
        return $this->twig->render('Events/history.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"   => "2",
        ]);
    }

    public function contact()
    {
        return $this->twig->render('Events/contact.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"   => "3",
        ]);
    }

    public function mentions()
    {
        $mentions = new MentionsManager();
        $mention = $mentions->selectMentions();

        return $this->twig->render('Events/mentions.html.twig', [
            "society"   => $this->getSociety(),
            "navbars"   => $this->getNavbar(),
            "current"   => "-1",
            "mention"   => $mention,
        ]);
    }

    public function search()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $programmingManager = new ProgrammingManager();
            if(!empty($_POST['search'])) {
                $events = $programmingManager->searchEventsByText($_POST);
            } elseif (!empty($_POST['category']) && $_POST['category'] > 0) {
                $events = $programmingManager->searchEventsByCategory($_POST);
            } else {
                $events = $programmingManager->selectAllEventNotPast();
            }

            return json_encode($events);
        }
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

        return $this->twig->render('Events/event.html.twig', [
            "society" => $society,
            "navbars"       => $navbars,
            'details' => $detail,
            'placements' => $listPlacement,
        ]);
    }
}
