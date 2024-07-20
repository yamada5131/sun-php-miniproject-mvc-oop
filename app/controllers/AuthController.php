<?php

use JetBrains\PhpStorm\NoReturn;

require_once(ROOT_DIR.'/app/models/User.php');

class AuthController
{
    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
        $this->startSession();
    }

    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showLoginForm(): void
    {
        require_once(ROOT_DIR.'/app/views/auth/login.php');
    }

    #[NoReturn] public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            $this->setFlashMessage('error_message', 'Invalid request method.');
            $this->redirect('/index.php?mod=auth&&act=login-form');
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $rememberMe = isset($_POST['remember_me']);

        if (empty($username) || empty($password)) {
            $this->redirectLoginFormWithErrorMessage(
                'Username and password are required.'
            );
        }

        $user = $this->userModel->findUserByUsername($username);
        if (!$user || !password_verify($password, $user[0]['password'])) {
            $this->redirectLoginFormWithErrorMessage(
                'Invalid username or password.'
            );
        }

        $this->setFlashMessage('user_id', $user[0]['id']);
        $this->setFlashMessage('username', $user[0]['username']);
        $this->setFlashMessage('success_message', 'Login successful!');

        if ($rememberMe) {
            $this->setRememberMeCookies($user[0]['id'], $user[0]['username']);
        }

        $this->redirect('/index.php?mod=product');
    }

    private function setFlashMessage(string $key, string $message): void
    {
        $_SESSION[$key] = $message;
    }

    #[NoReturn] private function redirect(string $url): void
    {
        header("Location: ".$url);
        exit;
    }

    #[NoReturn] private function redirectLoginFormWithErrorMessage(string $message): void
    {
        $this->setFlashMessage('error_message', $message);
        $this->redirect('/index.php?mod=auth&act=login-form');
    }

    private function setRememberMeCookies(string $userId, string $username): void
    {
        setcookie('user_id', $userId, time() + 3600 * 24 * 30, '/');
        setcookie('username', $username, time() + 3600 * 24 * 30, '/');
    }

    #[NoReturn] public function logout(): void
    {
        session_destroy();
        setcookie('user_id', '', time() - 3600, "/");
        setcookie('username', '', time() - 3600, "/");
        $this->redirect("/index.php?mod=auth&&act=login-form");
    }
}
