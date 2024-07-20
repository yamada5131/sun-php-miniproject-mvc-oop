<?php

define('ROOT_DIR', dirname(__DIR__));

require_once(ROOT_DIR.'/app/models/Database.php');
require_once(ROOT_DIR.'/app/models/Product.php');
require_once(ROOT_DIR.'/app/models/User.php');
require_once(ROOT_DIR.'/app/controllers/ProductController.php');
require_once(ROOT_DIR.'/app/controllers/AuthController.php');

$db = new Database();

$taskModel = new Product($db);
$userModel = new User($db);

$productController = new ProductController($taskModel);
$authController = new AuthController($userModel);

require_once(ROOT_DIR.'/app/middleware/auth.php');
restoreSessionFromCookies();

$module = $_GET['mod'] ?? 'product';
$action = $_GET['act'] ?? 'list';

if ($module !== 'auth' && $module !== 'home') {
    checkAuth();
}

switch ($module) {
    case 'auth':
        handleAuthActions($authController, $action);
        break;
    case 'product':
        handleProductActions($productController, $action);
        break;
    case 'home':
        echo "Welcome to the home page!";
        break;
    default:
        echo "Invalid module.";
        break;
}

function restoreSessionFromCookies(): void
{
    if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
        $_SESSION['user_id'] = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}

function handleAuthActions(AuthController $authController, string $action): void
{
    switch ($action) {
        case 'login-form':
            $authController->showLoginForm();
            break;
        case 'login':
            $authController->login();
            break;
        case 'logout':
            $authController->logout();
            break;
        default:
            echo "Invalid action for auth module.";
            break;
    }
}

function handleProductActions(ProductController $productController, string $action): void
{
    switch ($action) {
        case 'list':
            $productController->index();
            break;
        case 'add':
            $productController->create();
            break;
        case 'store':
            $productController->store();
            break;
        case 'edit':
            $productController->edit();
            break;
        case 'update':
            $productController->update();
            break;
        case 'remove':
            $productController->remove();
            break;
        default:
            echo "Invalid action for product module.";
            break;
    }
}
