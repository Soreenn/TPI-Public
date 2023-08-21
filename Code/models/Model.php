<?php

namespace Models;

use Source\Constant;

class Model
{
    protected static \PDO $pdo;
    protected string $table;

    public function __construct()
    {
        try{
            static::$pdo = new \PDO(
            Constant::DB_driver . ':host=' . Constant::DB_host . ';dbname=' . Constant::DB_name . ';port=' . Constant::DB_port . ';charset' . Constant::DB_charset, 
            Constant::DB_username, Constant::DB_password, [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (\PDOException $e){
            echo $e->getMessage();
            die();
        }
    }

    public function all(): array{
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table}");

        return $statement->fetchAll();
    }

    protected function getPDO(): \PDO
    {
        return static::$pdo;
    }
}