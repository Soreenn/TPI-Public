<?php

namespace Models;

class UserSubscribeSubject extends Model
{
    protected string $table = 'users_subscribe_subjects';

    public function insertNewSubscription(int $userId, int $subjectId): array{
        $statement = $this->getPDO()->query("INSERT INTO {$this->table} (User_id, Subject_id) VALUES ('$userId', '$subjectId');");

        return $statement->fetchAll();
    }

    public function getSubjectsIdByUserId(int $userId){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE User_id = $userId");

        return $statement->fetchAll();
    }

    public function getSubjectsIdByUserIdAndSubjectId(int $userId, int $subjectId){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE User_id = $userId AND Subject_id = $subjectId");

        return $statement->fetchAll();
    }
}