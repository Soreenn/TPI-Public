<?php

namespace Models;

class UserReplyPost extends Model
{
    protected string $table = 'users_reply_posts';

    public function insertNewPostReply(int $userId, int $postId): array{
        $statement = $this->getPDO()->query("INSERT INTO {$this->table} (User_id, Post_id) VALUES ('$userId', '$postId');");

        return $statement->fetchAll();
    }

    public function getUserIdByPostId(int $postId){
        $statement = $this->getPDO()->query("SELECT * FROM {$this->table} WHERE Post_id = $postId");

        return $statement->fetchAll();
    }
}