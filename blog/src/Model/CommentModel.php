<?php

// src/Model/CommentModel.php
namespace Mrho\Model;

class CommentModel {
    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function getCommentsByPostId($postId) {
        $sql = "SELECT * FROM comments WHERE post_id = :postId ORDER BY comment_date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createComment($postId, $authorId, $comment) {
        $sql = "INSERT INTO comments (post_id, author_id, comment, comment_date) VALUES (:postId, :authorId, :comment, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $stmt->bindValue(':authorId', $authorId, \PDO::PARAM_INT);
        $stmt->bindValue(':comment', $comment);
        return $stmt->execute();
    }

    public function deleteComment($id) {
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
