<?php
// src/Controller/PostController.php

namespace Mrho\Blog\Controller;

use Mrho\Model\PostModel;
use Mrho\Model\CommentModel;

class PostController {
    private $postModel;
    private $commentModel;

    public function __construct(PostModel $postModel, CommentModel $commentModel) {
        $this->postModel = $postModel;
        $this->commentModel = $commentModel;
    }

    public function index($page = 1) {
        $limit = 12;
        $offset = ($page - 1) * $limit;
        $posts = $this->postModel->getAllPosts($limit, $offset); // Récupération des posts
        $totalPosts = $this->postModel->getPostsCount();
        $totalPages = ceil($totalPosts / $limit);
    
        // Calcul des pages précédente et suivante pour la pagination
        $previousPage = max(1, $page - 1);
        $nextPage = min($totalPages, $page + 1);
    
        // Ici, vous passez $posts, ainsi que toute autre variable nécessaire, à la vue
        require 'src/View/posts/index.php';
    }
    

    public function view($id) {
        session_start();
        $post = $this->postModel->getPostById($id);
        $comments = $this->commentModel->getCommentsByPostId($id);

        require 'src/View/posts/view.php';
    }

    public function createForm() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        require 'src/View/posts/create.php';
    }

    public function create() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : null;
        $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : null;
        $authorId = $_SESSION['user_id']; // Assumption: User ID is stored in the session

        if ($title && $content) {
            if ($this->postModel->createPost($title, $content, $authorId)) {
                header('Location: /');
                exit;
            } else {
                $error = 'Impossible de créer l\'article.';
                // Assurez-vous que votre vue de création peut afficher $error
                require 'src/View/posts/create.php';
            }
        } else {
            $error = 'Les champs titre et contenu sont requis.';
            require 'src/View/posts/create.php';
        }
    }
}
