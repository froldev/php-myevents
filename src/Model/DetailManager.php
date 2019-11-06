<?php


namespace App\Model;

use App\Controller\AbstractController;

class DetailManager extends AbstractManager
{
    const TABLE = "event";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
