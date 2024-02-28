<?php

// src/Model/PostModel.php
namespace Mrho\Model;

class PostModel {
    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    public function getAllPosts($limit = 10, $offset = 0) {
        $sql = "SELECT * FROM posts ORDER BY publish_date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPostById($id) {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function createPost($title, $content, $authorId) {
        try {
            $this->db->beginTransaction();
            
            $sql = "INSERT INTO posts (title, content, author_id, publish_date) VALUES (:title, :content, :authorId, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':authorId', $authorId, \PDO::PARAM_INT);
            $result = $stmt->execute();
            
            $this->db->commit();
            return $result;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updatePost($id, $title, $content) {
        $sql = "UPDATE posts SET title = :title, content = :content, publish_date = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        return $stmt->execute();
    }

    public function deletePost($id) {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getPostsCount() {
        $sql = "SELECT COUNT(*) FROM posts";
        $stmt = $this->db->query($sql);
        return $stmt->fetchColumn();
    }
}
