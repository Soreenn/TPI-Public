<?php

namespace Models;

class Subject extends Model
{
    protected string $table = 'subjects';

    public function insertNewSubject(string $description, string $creationDate, string $media, string $title, int $blocked, int $archived, string $categoryId, int $userId, string $update): array{
        $statement = $this->getPDO()->query("INSERT INTO {$this->table} (description, creationDate, media, title, blocked, archived, Category_id, User_id, `update`) VALUES ('" . addslashes($description) . "', '$creationDate', '" . addslashes($media) . "', '" . addslashes($title) . "', '$blocked', '$archived', '$categoryId', '$userId', '$update');");
        return $statement->fetchAll();
    }

    public function GetSpecificSubjectById(string $id){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE id = $id");

        return $statement->fetchAll();
    }

    public function GetSubjectByCategoryId(string $id){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE Category_id = $id AND blocked = 0");

        return $statement->fetchAll();
    }

    public function GetUserVisibleSubjects(){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE blocked = 0 AND archived = 0 ORDER BY `update` DESC");

        return $statement->fetchAll();
    }

    public function BlockSubject($subjectId){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET blocked = 1 WHERE id = $subjectId");

        return $statement->fetchAll();
    }

    public function ArchiveSubject($subjectId){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET archived = 1 WHERE id = $subjectId");

        return $statement->fetchAll();
    }

    public function updateTimestamp($date, $subjectId){
        $statement = $this->getPDO()->query("UPDATE {$this->table} SET `updated` = '$date' WHERE id = $subjectId");

        return $statement->fetchAll();
    }
}