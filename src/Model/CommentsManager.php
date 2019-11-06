<?php

namespace App\Model;

class CommentsManager extends AbstractManager
{
    const TABLE = "comment";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
