<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\OlympicManager;

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
        $programmingManager = new OlympicManager();
        $events = $programmingManager->selectAll();

        return $this->twig->render('Olympic/index.html.twig', ["events" => $events]);
    }

    public function info()
    {
        return $this->twig-> render('Olympic/info.html.twig');
    }
}
