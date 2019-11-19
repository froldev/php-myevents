<?php

namespace App\Controller;

use App\Model\PartnersManager;

class PartnersController extends AbstractController
{
    public function list(): string
    {
        $partnersManager = new PartnersManager();
        $partners = $partnersManager->selectPartner();

        return $this->twig->render("Admin/Partners/list.html.twig", [
            "partners" => $partners,
        ]);
    }

    public function add(): string
    {
        $partnerError = null;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $isValid = true;
            if (empty($_POST['partner']) || !isset($_POST['partner'])) {
                $partnerError = "Merci de saisir un nouveau Partenaire";
                $isValid = false;
            }
            if (empty($_POST['linkPartner']) || !isset($_POST['linkPartner'])) {
                $partnerError = "Merci de saisir une url vers la page du nouveau Partenaire";
                $isValid = false;
            }
            // if it's ok
            if ($isValid) {
                $partnersManager = new PartnersManager();
                if ($partnersManager->insertPartner($_POST)) {
                    header("Location:/partners/list");
                }
            }
        }

        return $this->twig->render("Admin/Partners/add.html.twig", [
            "partnerError" => $partnerError,
        ]);
    }

    public function delete(int $id): void
    {
        $partnersManager = new PartnersManager();
        $partnersManager->deletePartners($id);
        header("Location:/partners/list");
    }

    public function edit(int $id): string
    {
        $partnersManager = new PartnersManager();
        $partner = $partnersManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partner['partner'] = $_POST['partner'];
            $partner['linkPartner'] = $_POST['linkPartner'];
            if ($partnersManager->updatePartners($partner)) {
                header("Location:/partners/list");
            }
        }
        return $this->twig->render('Admin/Partners/edit.html.twig', [
            'partner' => $partner,
        ]);
    }
}
