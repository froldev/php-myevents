<?php

namespace App\Controller;

use App\Model\DetailManager;

class DetailController extends AbstractController
{
    public function event(int $id)
    {
        $detailManager = new DetailManager();
        $detail = $detailManager->selectOneById($id);
        return $this->twig->render('Detail/event.html.twig', ['details' => $detail]);
    }
}
