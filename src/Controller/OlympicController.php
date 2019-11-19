<?php

namespace App\Controller;

use App\Model\AbstractManager;

class OlympicController extends AbstractController
{
    public function information()
    {
        return $this->twig->render('Olympic/info.html.twig');
    }

    public function contact()
    {
        return $this->twig->render('Olympic/contact.html.twig');
    }

    public function history()
    {
        return $this->twig->render('Olympic/history.html.twig');
    }
}
