<?php

require_once __DIR__ . '/../vendor/autoload.php';


use Mrho\Config\Database;
use Mrho\Blog\Controller\PostController;
use Mrho\Blog\Controller\UserController;
use Mrho\Model\PostModel;
use Mrho\Model\CommentModel;
use Mrho\Model\UserModel;

// Configuration de la base de données et instanciation des modèles
$db = Database::connect();

$postModel = new PostModel($db);
$commentModel = new CommentModel($db);
$userModel = new UserModel($db);

// Instanciation des contrôleurs avec les namespaces complets
$PostController = new PostController($postModel, $commentModel);
$userController = new UserController($userModel);


// Un système de routage simple
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case '/':
        $postController->index();
        break;
    case '/login':
        if ($method == 'GET') $userController->loginForm();
        else $userController->login();
        break;
    case '/logout':
        $userController->logout();
        break;
    default:
        // Gestion des posts et commentaires
        if (preg_match("/\/post\/view\/(\d+)/", $request, $matches)) {
            $postId = $matches[1];
            $postController->view($postId);
        }
        // Ajouter d'autres routes ici
        break;
}
