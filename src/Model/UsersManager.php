<?php

namespace App\Model;

class UsersManager extends AbstractManager
{
    const TABLE = 'users';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectUsers(): array
    {
        $request = $this->pdo->query("SELECT * FROM " .self::TABLE. " ORDER BY lastname");
        return $request->fetchAll();
    }

    public function deleteUsers(int $id): void
    {
        $request = $this->pdo->prepare("DELETE FROM " .self::TABLE. " WHERE id=:id");
        $request->bindValue(":id", $id, \PDO::PARAM_INT);
        $request->execute();
    }

    public function insertUser(array $user): bool
    {
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (email, password, role, lastname, firstname) 
        VALUES (:email, :password, :role, :lastname, :firstname)");
        $request->bindValue(":email", strtolower($user["email"]), \PDO::PARAM_STR);
        $request->bindValue(":password", $user["password"], \PDO::PARAM_STR);
        $request->bindValue(":role", ucwords(strtolower($user["role"])), \PDO::PARAM_STR);
        $request->bindValue(":lastname", strtoupper($user["lastname"]), \PDO::PARAM_STR);
        $request->bindValue(":firstname", ucwords(strtolower($user["firstname"])), \PDO::PARAM_STR);
        return $request->execute();
    }
}
