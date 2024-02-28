<?
// src/Controller/UserController.php
namespace Mrho\Blog\Controller;

use Mrho\Model\UserModel;

class UserController {
    private $userModel;

    public function __construct(UserModel $userModel) {
        $this->userModel = $userModel;
    }

    public function loginForm() {
        require 'src/View/user/login.php';
    }

    public function login() {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if ($email && $password) {
            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                header('Location: /admin');
                exit;
            }
        }

        // Handle login failure
        $error = 'Invalid credentials';
        require 'src/View/user/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }

    // Methods for user management (create, update, delete)...
}
