<?php

namespace App\Model;

class ProgrammingManager extends AbstractManager
{
    const TABLE = "event";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
