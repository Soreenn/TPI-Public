<?php

namespace Models;

class Category extends Model
{
    protected string $table = 'categories';

    public function getSpecificCategoryByName(string $name): array{
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE name = '$name'");
        return $statement->fetchAll();
    }
    
    public function insertNewCategory(string $name, string $icone): array{
        $statement = $this->getPDO()->query("INSERT INTO {$this->table} (name, icone) VALUES ('$name', '$icone');");

        return $statement->fetchAll();
    }
}