<?php

namespace App\Model;

class RoleManager extends AbstractManager
{
    const TABLE = 'role';
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
