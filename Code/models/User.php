<?php

namespace Models;

class User extends Model
{
    protected string $table = 'users';

    public function getSpecificUserByEmail(string $email): array{
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE email LIKE '$email'");

        return $statement->fetchAll();
    }

    public function getSpecificUserByUsername(string $username): array{
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE username LIKE '" . addslashes($username) . "'");

        return $statement->fetchAll();
    }

    public function GetSpecificUserByToken(string $token): array{
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE token LIKE '$token'");

        return $statement->fetchAll();
    }

    public function insertNewUser(string $email, string $username, string $picture, string $password, int $confirmed, int $administrator, string $token, int $blocked, string $creationdate): array{
        $statement = $this->getPDO()->query("INSERT INTO {$this->table} (email, username, picture, password, confirmed, administrator, token, blocked, creationdate) VALUES ('$email', '" . addslashes($username) . "', '$picture', '$password', '$confirmed', '$administrator', '$token', '$blocked', '$creationdate');");

        return $statement->fetchAll();
    }

    public function GetSpecificUserById(int $id){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE id = $id");

        return $statement->fetchAll();
    }

    public function verifyEmail($username){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET confirmed = 1 WHERE username = '" . addslashes($username) . "'");

        return $statement->fetchAll();
    }
    
    public function changePassword($id, $password){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET password = '$password' WHERE id = $id");

        return $statement->fetchAll();
    }

    public function changeUsername($id, $username){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET username = '$username' WHERE id = $id");

        return $statement->fetchAll();
    }

    public function blockUser($id){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET blocked = 1 WHERE id = $id");

        return $statement->fetchAll();
    }
}