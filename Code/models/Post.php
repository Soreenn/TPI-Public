<?php

namespace Models;

class Post extends Model
{
    protected string $table = 'posts';
    protected string $strSeparator = '\''; 

    public function insertNewPost(string $description, string $creationDate, string $media, int $blocked, int $Subject_id, string $replyingto): array{
        $statement = $this->getPDO()->query("INSERT INTO {$this->table} (description, creationDate, media, blocked, Subject_id, replyingto) VALUES ('" . addslashes($description) . "', '$creationDate', '" . addslashes($media) . "', '$blocked', '$Subject_id', '" . addslashes($replyingto) . "');");

        return $statement->fetchAll();
    }

    public function getSpecificPostBySubjectId(int $subjectId){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE Subject_id = $subjectId");

        return $statement->fetchAll();
    }

    public function getMostRecentPostBySubjectId(int $subjectId){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE Subject_id = $subjectId AND blocked = 0 ORDER BY id DESC");

        return $statement->fetchAll();
    }

    public function getSpecificPostById(int $id){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE id = $id ORDER BY id DESC");

        return $statement->fetchAll();
    }

    public function blockPost($id){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET blocked = 1 WHERE id = $id");

        return $statement->fetchAll();
    }
}