<?php


namespace App\Controller;

use App\Model\AbstractManager;

class OlympicController extends AbstractController
{
    public function info()
    {
        return $this->twig->render('Olympic/info.html.twig');
    }

    public function contact()
    {
        return $this->twig->render('Olympic/contact.html.twig');
    }
}
