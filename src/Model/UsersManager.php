<?php

namespace App\Model;

class UsersManager extends AbstractManager
{
    const TABLE = 'users';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectUsersAndRole(): array
    {
        $request = $this->pdo->query("SELECT * 
        FROM " .self::TABLE. " u 
        JOIN role r ON u.role_id = r.id 
        ORDER BY u.lastname");
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
        $request = $this->pdo->prepare("INSERT INTO " .self::TABLE. " (email, password, role_id, lastname, firstname) 
        VALUES (:email, :password, :role, :lastname, :firstname)");
        $request->bindValue(":email", strtolower($user["email"]), \PDO::PARAM_STR);
        $request->bindValue(":password", $user["password"], \PDO::PARAM_STR);
        $request->bindValue(":role", ucwords(strtolower($user["role"])), \PDO::PARAM_STR);
        $request->bindValue(":lastname", strtoupper($user["lastname"]), \PDO::PARAM_STR);
        $request->bindValue(":firstname", ucwords(strtolower($user["firstname"])), \PDO::PARAM_STR);
        return $request->execute();
    }

    public function updateUser(array $user): bool
    {

        $request = $this->pdo->prepare("UPDATE " .self::TABLE. " SET email=:email, password=:password, 
        role_id=:role, lastname=:lastname, firstname=:firstname WHERE id=:id");
        $request->bindValue(":email", strtolower($user["email"]), \PDO::PARAM_STR);
        $request->bindValue(":password", $user["password"], \PDO::PARAM_STR);
        $request->bindValue(":role", ucwords(strtolower($user["role"])), \PDO::PARAM_STR);
        $request->bindValue(":lastname", strtoupper($user["lastname"]), \PDO::PARAM_STR);
        $request->bindValue(":firstname", ucwords(strtolower($user["firstname"])), \PDO::PARAM_STR);
        $request->bindValue(":id", $user["id"], \PDO::PARAM_INT);
        return $request->execute();
    }
}
