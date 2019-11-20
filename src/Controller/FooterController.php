<?php

namespace App\Controller;

use App\Model\PartnersManager;

class FooterController extends AbstractController
{
    public function partner()
    {
        $partnersManager = new PartnersManager();
        $partners = $partnersManager->selectAll();

        return $this->twig->render('Programming/layout.html.twig', ["partners" =>$partners]);
    }
}
